<?php
/**
 * $ModDesc
 * 
 * @version		$Id: helper.php $Revision
 * @package		modules
 * @subpackage	$Subpackage
 * @copyright	Copyright (C) May 2010 LandOfCoder.com <@emai:landofcoder@gmail.com>. All rights reserved.
 * @website 	htt://landofcoder.com
 * @license		GNU General Public License version 2
 */
if (!defined('_CAN_LOAD_FILES_')){
    define('_CAN_LOAD_FILES_',1);
}
if( !class_exists('LofNewProductDataSource', false) ){  
	class LofNewProductDataSource extends LofNewProductDataSourceBase{
	    /**
		 * @var string $__name;
		 *
		 * @access private
		 */
		var $__name = 'product';
                
        /**
		 * override method: get list image from articles.
		 */
		 
		static protected function _getProductIdByDate($beginning, $ending)
		{
			global $cookie, $cart;

			$id_group = $cookie->id_customer ? (int)(Customer::getDefaultGroupId((int)($cookie->id_customer))) : _PS_DEFAULT_CUSTOMER_GROUP_;
			$id_address = $cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')};
			$ids = Address::getCountryAndState($id_address);
			$id_country = (int)($ids['id_country'] ? $ids['id_country'] : Configuration::get('PS_COUNTRY_DEFAULT'));
			return SpecificPrice::getProductIdByDate((int)(Shop::getCurrentShop()), (int)($cookie->id_currency), $id_country, $id_group, $beginning, $ending);
		}
		
        function getListFeatured( $params ){
            global $cookie, $link;
           	$id_lang = intval($cookie->id_lang);
            $category = new Category(1, Configuration::get('PS_LANG_DEFAULT'));
    		$nb = (int)(Configuration::get('HOME_FEATURED_NBR'));
            $isThumb = $params->get( 'auto_renderthumb',1);
            $maxDesc = $params->get( 'des_max_chars',100);
			$limit_items = $params->get( 'limit_items',5);
    		
            //$listFeatured = $category->getProducts((int)(intval($cookie->id_lang)), 1, $limit_items);
			//$listFeatured = Product::getProductsProperties($id_lang, $listFeatured);
            //echo "<pre>"; print_r(sizeof($listFeatured));die;
            $home_sorce = $params->get("home_sorce");
            if($home_sorce == "productids"){
                $product_ids = $params->get("product_ids"); 
                $where = ' AND p.id_product IN ('.$product_ids.')';
                $newProducts = $this->getProductsV14($where,0,$limit_items,"p.id_product");
                //echo "<pre>"; print_r(($newProducts));die;
            }else{
                $newProducts = Product::getNewProducts((int)(intval($cookie->id_lang)), 0, $limit_items);
                $newProducts = Product::getProductsProperties($id_lang, $newProducts);   
            }

			$imgSize["height"] = $params->get("thumb_height",220);
			$imgSize["width"]  = $params->get("thumb_width",330);
			$date = date("Y-m-d H:i:s");
			$today = strtotime($date); 
			
            foreach( $newProducts as &$product ){
				//add data for product
				$itemDate = strtotime($product["date_add"]);
				$newnumdays = round(abs($today-$itemDate)/60/60/24);
				$lofdate = date("d F Y", strtotime($product["date_add"]));
				

				$product["classicon"] = "";
				$product["lof_online_only_icon"] = "";
				$product["lof_sale_icon"] = "";
				$product["lof_new_icon"] = "";
				$product["lof_features"] = "";
				if($product["online_only"]==1){
					$product["lof_online_only_icon"] = "lof-online_only";
				}
				if($product["reduction"]){
					$product["lof_sale_icon"] = "lof-sale";
				}
				//check new product
				//if( $newnumdays < $params->get("timenew",2) && ($params->get("timenew",2) != 0) ){
				//	$product["lof_new_icon"] = "lof-new";
				//}
                $product["lof_new_icon"] = "lof-new";
				//$product["lof_features"] = "lof-feature";
				$product["dateAdd"] = date('d F Y', strtotime($product["date_add"]));
				
                $product['description']=substr(trim(strip_tags($product['description_short'])),0, $maxDesc);
                $product['price']=Tools::displayPrice($product['price']);                 
                $product = $this->parseImages( $product,$params );                
                $product = $this->generateImages( $product, $params );
            }
            
            //echo "<pre>"; print_r(($newProducts));die;
            return $newProducts;
        } 
		
		public function getProFeature(){
        	$sql = 'SELECT DISTINCT p.id_product FROM `'._DB_PREFIX_.'category_product` cp '
             . 'LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product` '
             . 'WHERE cp.`id_category` =1';    
       		return Db::getInstance()->ExecuteS($sql);
    	}
        
		/**
        * Get list in
        */
		function getListByParameters( $params, $ids,$limit=10 ){		
            if(_PS_VERSION_ <="1.4"){				
				$products = self::_getListv13($params, $ids);
			}else{				
				$products = self::_getListv14($params, $ids);
			}
			$isThumb = $params->get( 'auto_renderthumb',1);
            $maxDesc = $params->get( 'des_max_chars',100);
            if( empty($products) ) return array();
            foreach ( $products as &$product ) {    		    	        
    			$product['description']=substr(trim(strip_tags($product['description_short'])),0, $maxDesc);
                $product['price']=Tools::displayPrice($product['price']);
                $product['price_lof_reduction']=Tools::displayPrice($product['price_without_reduction']);                 
                $product = $this->parseImages( $product,$params );
				$product["dateAdd"] = date('d F Y', strtotime($product["date_add"]));
                $product = $this->generateImages( $product, $params );
	        }			
			return $products;			
		}				
		
		
        /**
        * Get list in prestashop v13
        */
		private function _getListv13($params, $ids){
			global $smarty;						
			$homeSorce = $params->get("home_sorce","selectcat");
			if( $homeSorce == "selectcat"){				
				$where = "";
    			$selectCat = $ids;
                $selectCat = !is_array($selectCat) ? $selectCat : implode(",",$selectCat);		
				if($selectCat != ""){
    				$catArray  = explode(",",$selectCat);
    				if(count($catArray) == 1){
    					$where = " AND cp.`id_category` = ".$catArray[0];
    				}else{
    					$where = " AND cp.`id_category` IN (".$selectCat.")";
    				}	
    			}
				$catArray       = explode(",",$selectCat);
				$products       = self::getProductsV13( $where,0,$params->get("limit_items",10),"p.id_product" );					
			}elseif( $homeSorce == 'productids' ){
				$productids = explode(",", trim($params->get("productids","1,2,3,4,5")));
				$ids = array();
				foreach( $productids as $id ){
					$ids = (int)$id;
				}
				$where	  = " AND p.`id_product` IN (".implode(",",$ids).")"; 
				$products = self::getProductsV13( $where,0,$params->get("limit_items",10),"p.id_product" );
			}elseif( $homeSorce == 'selectmanu' ){
				$where = "";
    			$selectCat = $ids;
                $selectCat = !is_array($selectCat) ? $selectCat : implode(",",$selectCat);		
				if($selectCat != ""){
    				$catArray  = explode(",",$selectCat);
    				if(count($catArray) == 1){
    					$where = " AND p.`id_manufacturer` = ".$catArray[0];
    				}else{
    					$where = " AND p.`id_manufacturer` IN (".$selectCat.")";
    				}	
    			}
				$catArray       = explode(",",$selectCat);
				$products       = self::getProductsV13( $where,0,$params->get("limit_items",10),"p.id_product" );
			}else{
				$category = new Category(1);
				$nb 	  = intval($params->get("limit_items",10));//Number of product displayed
				$products = $category->getProducts(intval($smarty->_tpl_vars['cookie']->id_lang), 1, ($nb ? $nb : 10));
			}
            			
			return $products;
		}
		
		/**
		* Get data source: 
		*/
		function getProductsV13($where='', $limiStart=0, $limit=10, $order=''){		
			global $cookie, $link;
			$id_lang = intval($cookie->id_lang);
		
			$sql = '
			SELECT DISTINCT p.id_product, p.*, c.`id_category` as lof_id_cat, c.`id_parent` as lof_id_parent, pa.`id_product_attribute`, pl.`description`, pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, i.`id_image`, il.`legend`, m.`name` AS manufacturer_name, tl.`name` AS tax_name, t.`rate`, cl.`name` AS category_default, DATEDIFF( now(), p.date_add) as newnumdays, DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 AS new,
				(p.`price` * IF(t.`rate`,((100 + (t.`rate`))/100),1) - IF((DATEDIFF(`reduction_from`, CURDATE()) <= 0 AND DATEDIFF(`reduction_to`, CURDATE()) >=0) OR `reduction_from` = `reduction_to`, IF(`reduction_price` > 0, `reduction_price`, (p.`price` * IF(t.`rate`,((100 + (t.`rate`))/100),1) * `reduction_percent` / 100)),0)) AS orderprice 
			FROM `'._DB_PREFIX_.'category_product` cp
			LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product`
            LEFT JOIN `'._DB_PREFIX_.'category` c ON c.`id_category` = cp.`id_category`
			LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND default_on = 1)
			LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.intval($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.intval($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
			LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.intval($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'tax` t ON t.`id_tax` = p.`id_tax`
			LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.intval($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
			WHERE  p.`active` = 1'.$where;		
		
			$sql .= ' ORDER BY '.$order
			.' LIMIT '.$limiStart.','.$limit;
			
            //echo "<pre>"; print_r($sql); die;
			$result = Db::getInstance()->ExecuteS($sql);
			
			return Product::getProductsProperties($id_lang, $result);
		}
		
		
		/**
        * Get list in prestashop v14
        */
		private function _getListv14( $params, $ids , $getByID=0){
            global $cookie;
			if($getByID==1){				
				$where	  = " AND p.`id_product` IN (".implode(",",$ids).")"; 
				$products = self::getProductsV13( $where,0,$params->get("limit_items",10),"p.id_product" );
				return $products;
			}
			$homeSorce = $params->get("home_sorce","selectcat");
            $featuredTab    = $params->get("featured_tab",0);         	
    		if( $homeSorce == "selectcat"){				
    			$where = "";
    			$selectCat = $ids;
                $selectCat = !is_array($selectCat) ? $selectCat : implode(",",$selectCat);	
    			if($selectCat != ""){
    				$catArray  = explode(",",$selectCat);
    				if(count($catArray) == 1){
    					$where = " AND cp.`id_category` = ".$catArray[0];
    				}else{
    					$where = " AND cp.`id_category` IN (".$selectCat.")";
    				}	
    			}
            
	            $catArray       = explode(",",$selectCat);
                $order          = $params->get("order_by","p.date_add");
    			$products       = self::getProductsV14( $where,0,$params->get("limit_items",5),$order );  
                             					
    		}elseif( $homeSorce == 'productids' ){
    			$productids = explode(",", trim($params->get("productids","1,2,3,4,5")));                                
    			$ids = array();
    			foreach( $productids as $id ){                    
    				$ids[]=(int)$id;
    			}                
    			$where	  = " AND p.`id_product` IN (".implode(",",$ids).")";                
    			$products = self::getProductsV14( $where,0,$params->get("limit_items",5),"p.id_product" );
    		}elseif( $homeSorce == 'selectmanu' ){
				$where = "";
    			$selectManu = $ids;
                $selectManu = !is_array($selectManu) ? $selectManu : implode(",",$selectManu);		
				if($selectManu != ""){
    				$catArray  = explode(",",$selectManu);
    				if(count($catArray) == 1){
    					$where = " AND p.`id_manufacturer` = ".$catArray[0];
    				}else{
    					$where = " AND p.`id_manufacturer` IN (".$selectManu.")";
    				}	
    			}
				$order          = $params->get("order_by","p.date_add");
    			$products       = self::getProductsV14( $where,0,$params->get("limit_items",5),$order );
			}else{
    			$category = new Category(1, Configuration::get('PS_LANG_DEFAULT'));
                $nb = (int)(Configuration::get('HOME_FEATURED_NBR'));
    			$products = $category->getProducts((int)($cookie->id_lang), 1, ($nb ? $nb : 10));
    		}
            return $products;	
		}				
		
        /**
        * Get data source: 
        */
    	public static function getProductsV14($where='', $limiStart=0, $limit=10, $order=''){		
    		global $cookie, $link;
        	$id_lang = intval($cookie->id_lang);
    		$sql = '
    		SELECT DISTINCT p.id_product,p.*, pa.`id_product_attribute`, pl.`description`, pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, i.`id_image`, il.`legend`, m.`name` AS manufacturer_name, tl.`name` AS tax_name, t.`rate`, cl.`name` AS category_default, DATEDIFF( now(), p.date_add) as newnumdays, DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 AS new,
    			(p.`price` * IF(t.`rate`,((100 + (t.`rate`))/100),1)) AS orderprice       
    		FROM `'._DB_PREFIX_.'category_product` cp
    		LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product`
            LEFT JOIN `'._DB_PREFIX_.'category` c ON c.`id_category` = cp.`id_category`
    		LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND default_on = 1)
    		LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.(int)($id_lang).')
    		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)($id_lang).')
    		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
    		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)($id_lang).')
    		LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
    		                                           AND tr.`id_country` = '.(int)Country::getDefaultCountryId().'
    	                                           	   AND tr.`id_state` = 0)
    	    LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
    		LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.(int)($id_lang).')
    		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`		
    		WHERE  p.`active` = 1'.$where;			
    		$sql .= ' ORDER BY '.$order
    		.' LIMIT '.$limiStart.','.$limit;   
            
            //echo "<pre>"; print_r($sql); die;
                     
    		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);	
            	
    		return Product::getProductsProperties($id_lang, $result);
    	}
        
        /**
		 * get main image and thumb
		 *
		 * @param poiter $row .
		 * @return void
		 */
		public  function parseImages( $product, $params ){
			global $link;
            
            $isRenderedMainImage = 	$params->get("cre_main_size",0);
            $mainImageSize       =  $params->get("main_img_size",'home');
            
            if( $isRenderedMainImage ) { 
				$product["mainImge"] = $link->getImageLink($product["link_rewrite"], $product["id_image"] );        		
	        } else{
	        	$product["mainImge"] = $link->getImageLink($product["link_rewrite"], $product["id_image"], $mainImageSize ); 
	        }
            $product["thumbImge"] = $product["mainImge"];

            return $product; 
		}                                   			
	}
}
?>