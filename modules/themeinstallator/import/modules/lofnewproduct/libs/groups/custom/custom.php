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
if( !class_exists('LofNewProductCustomDataSource', false) ){  
	class LofNewProductCustomDataSource extends LofNewProductDataSourceBase{
	    /**
		 * @var string $__name;
		 *
		 * @access private
		 */
		var $__name = 'custom';  
        /**
		 * override method: get list image from articles.
		 */
		function getListByParameters( $params, $pparams ){
		    global $smarty,$cookie;  
			$numberOFAr = $params->get("custom-num",5);	
			$list = array();
            $id_lang = $cookie->id_lang;
			$curLang = Language::getLanguage(intval($cookie->id_lang));
			$lofiso_code = $curLang["iso_code"];
            $isThumb = $params->get( 'auto_renderthumb',1);
            $maxTitle = $params->get( 'title_max_chars',10);
            $maxDesc = $params->get( 'des_max_chars',400);
            $maxsubDesc = $params->get( 'sub_max_chars',80);
            $replacer = '...';
            $isStriped = 1;
			for( $i=1;$i<=$numberOFAr;$i++){
                $list[$i-1]["id_product"] = '00_'.$i;
				$list[$i-1]["name"] = $params->get($id_lang."-".$i."-title","");
                //$list[$i-1]["subtitle"] = $params->get($id_lang."-".$i."-subtitle","");
                $list[$i-1]["subtitle"] = self::substring( $list[$i-1]["name"], $maxTitle, $replacer,  $isStriped  );
                $list[$i-1]["lof_features"] = '';
                $list[$i-1]["lof_online_only_icon"] = '';
                $list[$i-1]["lof_sale_icon"] = '';
                $list[$i-1]["lof_new_icon"] = '';
                $list[$i-1]["price_lof_reduction"] = '';
                $list[$i-1]["price_without_reduction"] = '';
                $list[$i-1]["features"] = '';
                $list[$i-1]["quantity"] = 1;
                $list[$i-1]["classicon"] = "lof-".$params->get($id_lang."-".$i."-type","");
				$list[$i-1]["link"]  = $params->get($id_lang."-".$i."-link","");
				$list[$i-1]["price"]  = $params->get($id_lang."-".$i."-price","");
                $list[$i-1]["image1"] = $params->get($id_lang."-".$i."-1-image","");
                $list[$i-1]["image2"] = $params->get($id_lang."-".$i."-2-image","");
                $list[$i-1]["mainImge1"] = $list[$i-1]["image1"];                
                $list[$i-1]["thumbImge1"] = $list[$i-1]["image1"];
                $list[$i-1]["mainImge2"] = $list[$i-1]["image2"];                
                $list[$i-1]["thumbImge2"] = $list[$i-1]["image2"];
                if($list[$i-1]["classicon"] == 'lof-online_only'){
                    $list[$i-1]["lof_online_only_icon"] = 'lof-online_only';
                }elseif($list[$i-1]["classicon"] == 'lof-sale'){
                    $list[$i-1]["lof_sale_icon"] = 'lof-sale';
                }elseif($list[$i-1]["classicon"] == 'lof-new'){
                    $list[$i-1]["lof_new_icon"] = 'lof-new';
                }elseif($list[$i-1]["classicon"] == 'lof-feature'){
                    
                    $list[$i-1]["lof_features"] = 'lof-feature';
                }
                if($list[$i-1]["thumbImge1"]){                    
    				if($params->get("re_thumb",1)){						
    					$list[$i-1] = $this->generateImages( $list[$i-1], $params );                                    
    				}
                }
                if($list[$i-1]["thumbImge2"]){               
    				if($params->get("re_thumb",1)){						
    					$list[$i-1] = $this->generateImages( $list[$i-1], $params );                                    
    				}
                }
				$list[$i-1]["description"]  = $params->get($id_lang."-".$i."-desc","");
                $list[$i-1]["subdescription"] = self::substring( $list[$i-1]["description"], $maxsubDesc, $replacer,  $isStriped  );
                if( ($list[$i-1]["name"]) != ""){
                    $list[$i-1]["name"] = $list[$i-1]["name"];
                }				                                   
			}
			return $list;			
		}
        public static function substring( $producttext, $length = 100, $replacer='...', $isStriped=true ){
            $length = 65;
    		$producttext = strip_tags($producttext);
    		if(strlen($producttext) <= $length){
    			return $producttext;
    		}
    		$producttext = substr($producttext,0,$length);
    		$posSpace = strrpos($producttext,' ');
            $replacer="...";
    		return substr($producttext,0,$posSpace).$replacer;
		}
        
        
	}
}
?>