<?php
/**
 * $ModDesc
 * 
 * @version		$Id: file.php $Revision
 * @package		modules
 * @subpackage	$Subpackage.
 * @copyright	Copyright (C) December 2010 LandOfCoder.com <@emai:landofcoder@gmail.com>.All rights reserved.
 * @license		GNU General Public License version 2
 */
if (!defined('_CAN_LOAD_FILES_')){
	define('_CAN_LOAD_FILES_',1);
}    
/**
 * lofcordion Class
 */	
class lofnewproduct extends Module
{
	/**
	 * @var LofParams $_params;
	 *
	 * @access private;
	 */
	private $_params = '';	
	
	/**
	 * @var array $_postErrors;
	 *
	 * @access private;
	 */
	private $_postErrors = array();		
	
	/**
	 * @var string $__tmpl is stored path of the layout-theme;
	 *
	 * @access private 
	 */	
	
   /**
    * Constructor 
    */
	function __construct()
	{
		$this->name = 'lofnewproduct';
		parent::__construct();			
		$this->tab = 'LandOfCoder';				
		$this->version = '1.0.0';
		$this->displayName = $this->l('Lof New Products Module');
		$this->description = $this->l('Lof New Products Module');
		if( file_exists( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/params.php' ) && !class_exists("LofParams", false) ){
			if( !defined("LOF_LOAD_LIB_PARAMS") ){				
				require( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/params.php' );
				define("LOF_LOAD_LIB_PARAMS",true);
			}
		}		
		$this->_params = new LofParams( $this->name );		   
	}
  
   /**
    * process installing 
    */
	function install(){		
		if (!parent::install())
			return false;
		if(!$this->registerHook('home'))
			return false;
		if(!$this->registerHook('header'))
			return false;	
		return true;
	}
	
    /*
    * Add Position for site
    */
    
    function hooklofPresDemo($params){
        return $this->processHook( $params,"lofPresDemo");
    }
    
    function hooklofnewproduct($params){
        return $this->processHook( $params,"lofnewproduct");
    }
	/*
	 * register hook right comlumn to display slide in right column
	 */
	function hookrightColumn($params)
	{		
		return $this->processHook( $params,"rightColumn");
	}
	
	/*
	 * register hook left comlumn to display slide in left column
	 */
	function hookleftColumn($params)
	{		
		return $this->processHook( $params,"leftColumn");
	}
	
	function hooktop($params){		
		return '</div><div class="clearfix"></div><div>'.$this->processHook( $params,"top");
	}
	
	function hookfooter($params)
	{		
		return $this->processHook( $params,"footer");
	}
	
	function hookcontenttop($params)
	{ 		
		return $this->processHook( $params,"contenttop");
	}
	
	
	function hookHeader($params)
	{
		if(_PS_VERSION_ <="1.4"){							
			$header = '
			<link type="text/css" rel="stylesheet" href="'.($this->_path).'tmpl/assets/style.css'.'" />
			<link type="text/css" rel="stylesheet" href="'.($this->_path).'tmpl/'. $this->getParamValue('module_theme','default').'/assets/style.css'.'" />			
            <script type="text/javascript" src="'.($this->_path).'assets/jscript.js'.'"></script>';			
			return $header;			
		}else{
		    if( !defined("_LOF_NEW_PRODUCT_") ){
                Tools::addJS( ($this->_path).'assets/jscript.js', 'all');
                Tools::addJS( ($this->_path).'assets/jquery.tools.min.js', 'all');
                define('_LOF_NEW_PRODUCT_', 1);         
            }
            Tools::addCSS( ($this->_path).'tmpl/assets/style.css', 'all');
			Tools::addCSS( ($this->_path).'tmpl/'. $this->getParamValue('module_theme','default').'/assets/style.css', 'all');   
		}		
	}
  		
  	
	function hooklofTop($params){
		return $this->processHook( $params,"lofTop");
	}
		
	function hookHome($params)
	{
		return $this->processHook( $params,"home");
	}      
	/**
    * Proccess module by hook
    * $pparams: param of module
    * $pos: position call
    */
	function processHook( $mparams, $pos="home" ){
        global $cookie, $link, $smarty;
		
       	$id_lang = intval($cookie->id_lang);               
		//load param
		$params = $this->_params;
		$site_url = Tools::htmlentitiesutf8('http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__);
		
		if(_PS_VERSION_ <="1.4"){
			// create thumbnail folder	 						
			$thumbPath = _PS_IMG_DIR_.$this->name;
			
			if( !file_exists($thumbPath) ) {
				mkdir( $thumbPath, 0777 );			
			};
			$thumbUrl = $site_url."img/".$this->name;
		}else{			
			// create thumbnail folder	 			
			$thumbPath = _PS_CACHEFS_DIRECTORY_.$this->name;
			if( !file_exists(_PS_CACHEFS_DIRECTORY_) ) {
				mkdir( _PS_CACHEFS_DIRECTORY_, 0777 );  			
			}; 
			if( !file_exists($thumbPath) ) {
				mkdir( $thumbPath, 0777 );			
			};
			$thumbUrl = $site_url."cache/cachefs/".$this->name;			
		}
		
		if( file_exists( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/group_base.php' ) && !class_exists("LofNewProductDataSourceBase", false) ){
			if( !defined("LOF_NEWPRODUCT_LOAD_LIB_GROUP") ) {
				require_once( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/group_base.php' );
				define("LOF_NEWPRODUCT_LOAD_LIB_GROUP",true);
			}
		}
		if( file_exists( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/phpthumb/ThumbLib.inc.php' ) && !class_exists('PhpThumbFactory', false)){						
			if( !defined("LOF_NEWPRODUCT_LOAD_LIB_PHPTHUMB") ) {
				require( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/phpthumb/ThumbLib.inc.php' );	
				define("LOF_NEWPRODUCT_LOAD_LIB_PHPTHUMB",true);
			}			
		}                
        
        $moduleId = rand().time();
        $params->set( 'auto_renderthumb',0);
        //$params->get("cre_main_size",0);
		$molTheme = $this->getParamValue('module_theme','basic');
		$main_width_theme = $params->get("main_width",700);
        $tmp 			= $params->get( 'md_height', 'auto' );
		$moduleHeight   =  ( $tmp=='auto' ) ? 'auto' : (int)$tmp;
		$tmp            = $params->get( 'md_width', 'auto' );
		$moduleWidth    =  ( $tmp=='auto') ? 'auto': (int)$tmp;
		$theme 			= $params->get("module_theme","default");
		$target 	= $params->get( 'target', '_self' );		
		$class 			= $params->get( 'navigator_pos', 0 ) ? '':'lof-snleft';
		$blockid        = $this->id;
		$showButtons 	= $params->get('show_button',1);
		$showTips 	   = $params->get('show_tips',"lof-none");
        $posActive   = $params->get("pos_act",0);
		$duration 	= $params->get('duration',500);
		$interval 	= $params->get('interval',2000);
		$lofeffect 	= $params->get('lofeffect',"");
        $limititem    = $params->get("limit_items",12);
        $showTooltip    = $params->get("show_tooltip",0);
        $showButton    = $params->get("show_button",1);
        $controls_btn_show     = $params->get("controls_btn_show",0);
        
        $showImage    = $params->get("show_image",1);
        $showTitle    = $params->get("show_title",1);
        $showDesc    = $params->get("show_desc",1);
        $showPrice    = $params->get("show_price",1);
        $showPuplic    = $params->get("show_puplic",0);
        $showTipBox    = $params->get("show_box_tips",0);
        $readText    = $params->get("read_text","Readmore");
        //echo $limititem;die;
        $thumbmainWidth   = $params->get('main_width',220);
        $thumbmainHeight   = $params->get('main_height',330);
        $thumbnailWidth   = $params->get('thumb_width',430);
        $thumbnailHeight   = $params->get('thumb_height',200);
        $limitnumrows   = $params->get('limit_rows',2);
        $limitnumcols   = $params->get('limit_cols',3);	
        $autoPlay   = $params->get('auto_play',0);	
        $speed   = $params->get('speed',200);	
        $mergeCat   = $params->get('mer_cat',0);
        $priceSpecial   = $params->get('price_special',0);
        
        
        $featuredTab    = $params->get("featured_tab",1);
        $bestsellerTab    = $params->get("bestseller_tab",0);
        $enableCate    = $params->get("enableCate",1);
        
        $onlineIcon    = $params->get("online_icon",0);
        $featureIcon    = $params->get("feature_icon",0);
        $newIcon    = $params->get("new_icon",0);
        $saleIcon    = $params->get("sale_icon",0);
        
        $newTab    = $params->get("new_tab",1);
        $specialTab    = $params->get("special_tab",0);
		$enablemanu    = $params->get("enablemanu",0);
        $addclass = '';
        $addCssitem = 0;
        $featuredUrlLayouts = "";
        $loflistFeatureds  = "";
        $loflistFeatured = "";	
        $countitemperpage = $limitnumrows * $limitnumcols;        
     
        $selectCat = $params->get("category","");
        $checkversion = _PS_VERSION_;
        $ids  = explode(",",$selectCat);
        $token 				= Tools::getToken(false);
		$source =  	  'product';        
		$path = dirname(__FILE__).'/libs/groups/'.strtolower($source).'/product.php'; 
        
        //echo "test==>".$path. '<br/>';				
		if( !file_exists($path) ){
			return array();	
		}
		
        require_once $path;
		
        $objectName = "LofNew".ucfirst($source)."DataSource";
	 	
        $object = new $objectName();
  		
        $object->setThumbPathInfo($thumbPath,$thumbUrl)
               ->setImagesRendered( array( 'mainImage' => array( (int)$params->get( 'main_width', 220 ), (int)$params->get( 'main_height', 330 )) ) );
        
		//$homeFeature =  $this->getProFeature();
		$listloffeatureds = '';
        $manuUrlLayouts = '';
        $manus = '';
        $listProManu = '';
        
 
        //get feature product
		$pages = array();
		$hlofmissitem = 0;
        if($featuredTab == 1){
            $loflistFeatureds = array();
            $listloffeatureds = $object->getListFeatured( $params );    
            if($listloffeatureds){
				$hlofmissitem = ceil(count($listloffeatureds)/$countitemperpage);
				$pages = @array_chunk($listloffeatureds,$countitemperpage);
				$loflistFeatureds = array();
				$loflistFeatureds[0] = $pages;
			}else{
				$loflistFeatureds[0] = array();
			}
            $featuredUrlLayouts = (dirname(__FILE__)).'/tmpl/_item/newproduct.tpl';
        }
       
        
        $module_width = $moduleWidth>0 ? "{$moduleWidth}" : "";
        if($moduleWidth != "auto"){
        $module_width = intval($module_width);
        }
        $countitemperpage = $limitnumrows * $limitnumcols;
        $totalwidththumb = (($thumbmainWidth+6) * $limitnumcols) + (20*($limitnumcols-1));
        if(($module_width < $totalwidththumb) && $module_width != "auto"){
        $module_width = $totalwidththumb;
        }
        $itemWidth = floor(9990/$limitnumcols)/100;        		
		
		//category
		$params->set($this->name."_home_sorce","selectcat");
        ob_start();
		    require( dirname(__FILE__).'/tmpl/_content.php' );		
    	    $module_content = ob_get_contents();
    	 ob_end_clean(); 
         ob_start();
		    require( dirname(__FILE__).'/initjs.php' );		
    	    $initjs = ob_get_contents();
    	 ob_end_clean();
		 
        $curLang = Language::getLanguage(intval($cookie->id_lang));
		$lofiso_code = $curLang["iso_code"];
        
        
        
		// template asignment variables
		$smarty->assign( array(
                              'moduleId' => $moduleId,
							  'lofiso_code' => $lofiso_code,
                              'module_content' => $module_content,
						      'object'        => $object,
						      'pages'        => $pages,
						      'showDesc'        => $showDesc,
						      'showPrice'        => $showPrice,
						      'showTipBox'        => $showTipBox,
						      'featuredTab'        => $featuredTab,
                              'onlineIcon'        => $onlineIcon,
                              'featureIcon'        => $featureIcon,
                              'newIcon'        => $newIcon,
                              'saleIcon'        => $saleIcon,
							  'hlofmissitem'        => $hlofmissitem,
							  'priceSpecial'        => $priceSpecial,
						      'loflistFeatureds'        => $loflistFeatureds,
						      'listloffeatureds'        => $listloffeatureds,
						      'loflistFeatured'        => $loflistFeatured,
						      'featuredUrlLayouts'        => $featuredUrlLayouts,
						      'addclass'        => $addclass,
						      'showTips'        => $showTips,
						      'addCssitem'        => $addCssitem,
						      'speed'        => $speed,
							  //manu
						      'checkversion'        => $checkversion,
						      'site_url'        => $site_url,
							  'countitemperpage' 		=> $countitemperpage,	
							  'moduleHeight'     => $moduleHeight,
							  'moduleWidth'     => $moduleWidth,
							  'module_width'     => $module_width,
							  'autoPlay'     => $autoPlay,
							  'theme'	        => $theme,
							  'limititem'	        => $limititem,
							  'thumbmainWidth'      => $thumbmainWidth,
							  'thumbmainHeight'      => $thumbmainHeight,
                              'thumbnailWidth'      => $thumbnailWidth,
							  'thumbnailHeight'      => $thumbnailHeight,
							  'limitnumcols'      => $limitnumcols,
							  'mergeCat'      => $mergeCat,
							  'lofeffect'      => $lofeffect,
							  'interval'      => $interval,
							  'duration'      => $duration,
							  'itemWidth'      => $itemWidth,
							  'params'		    => $params,							  	
                              'token' 			=> $token,
                              'posActive' 			=> $posActive,
                              'showImage'		    => $showImage,
                              'readText'		    => $readText,
                              'target'		    => $target,
							  'perItemMinWidth'=>(int)$params->get( 'min_width_expanded', 196 ),
							  'showTooltip'    => $showTooltip,
							  'showButton'		=> $showButton,
                              'controls_btn_show' => $controls_btn_show,
							  'showPuplic'		=> $showPuplic,
							  'showTitle'=>$showTitle
						));
        $smarty->assign( array('homeSize' => Image::getSize('thickbox')));		
		return $this->display(__FILE__, $this->getLayoutPath($theme="default") ); 				
	}
	
    public function getLayoutPath( $theme="default" ){
        $layout = 'tmpl/'.$theme.'/default.tpl';
        if( file_exists(__FILE__."/".$layout) ){
            return $layout;
        }
        return 'tmpl/default.tpl';
    }
    
    public function splitingCols ( $products ){
        return $output; 
    }  
    
     	   	
   /**
    * Get list of sub folder's name 
    */
	public function getFolderList( $path ) {
		$items = array();
		$handle = opendir($path);
		if (! $handle) {
			return $items;
		}
		while (false !== ($file = readdir($handle))) {
			if (is_dir($path . $file))
				$items[$file] = $file;
		}
		unset($items['.'], $items['..'], $items['.svn']);
		
		return $items;
	}
	
   /**
    * Render processing form && process saving data.
    */	
	public function getContent()
	{
		$html = "";
		if (Tools::isSubmit('submit'))
		{
			$this->_postValidation();

			if (!sizeof($this->_postErrors))
			{													
		        $definedConfigs = array(
		          /* general config */
		          'module_theme'      => '',
                  //image group
                  'module_group'      => '',
                  'image_folder'      => '',
                  'image_category'    => '',
                  'image_ordering'    => '',
                  'online_icon'       => '',
                  'feature_icon'      => '',
                  'new_icon'          => '',
                  'sale_icon'         => '',
                  'price_special'     => '',
                                                      
                  //product group
		          'home_sorce'        => '',
                  'product_ids'       => '',
                  
                  'featured_tab'      => '',
		          'show_tips'        => '',
		          'timenew'        => '',
                  'order_by'          => '',  
                  'limit_cols'          => '',  
                  'limit_rows'          => '',  
                  'des_max_chars'     => '',                  
	              'productids'        => '',                  		          		          		                            		        
	              'pos_act'        => '',                  		          		          		                            		        
	              'show_box_tips'        => '',                  		          		          		                            		        
		          'read_text'            => 'readmore',
		          'speed'       => '200',
		          'md_height'     => '',
		          'md_width'      => '',
				  'delCaImg'	      => '',
				  'limit_items'       =>'',
		          /*Main CoinSlider Setting*/
                  'show_tooltip'           => '',
                  'show_button'           => '',
                  'controls_btn_show'     => '',
                  
                  'show_image'            => '',
                  'show_desc'        => '',                                  		                            		          
		          'cre_main_size'     => '',
		          'main_img_size'     => '',
		          'main_height'       => '100',
		          'main_width'        => '150',
                  'thumb_height'       => '',
		          'thumb_width'        => '',
				  'auto_play' =>'',
		          /*Navigator Setting */
		          'show_price'     => '',
		          'show_title'     => '',
		          'show_puplic'=> '',
		          'mer_cat'=> '',
		          /*Effect Setting*/
		          'event'           => '',
		          'layout_style'      => '',
		          'spacing'          => '',
		          'duration'          => '',
		          'lofeffect'            => '',
                  'min_width_expanded'         => '',                  
		          'max_width_expanded'        => '',
		          'target'       =>'',
				  /*Customize Style*/
		          'enable_caption'    => '',
		          'caption_bg'        => '',
                  'caption_opacity'   => '',                  
                  'caption_fontcolor' => '',
                  'caption_linkcolor' => '',
                  'price_color'       => '',
                  'show_price'        => ''   , 
				  'file_path' => ''
		        );
				 for($i=1; $i<=10; $i++){
                    $definedConfigs[$i."-enable"]    = "";
                    if(Tools::getValue($i."-enable")){
                        $definedConfigs[$i."-filetype"]  = "";                                        
                        $definedConfigs[$i."-path"]      = "";
                        $definedConfigs[$i."-link"]      = "";                                                                            
                        $definedConfigs[$i."-timer"]     = "";
                        $definedConfigs[$i."-target"]    = "";
                        $definedConfigs[$i."-imagePos"]  = "";
                        $definedConfigs[$i."-pan"]       = "";
                        $definedConfigs[$i."-desc"]      = "";
                        $definedConfigs[$i."-title"]     = ""; 
                        $definedConfigs[$i."-preview"]   = "";
                        $definedConfigs[$i."-pan"]       = "";
                        $definedConfigs[$i."-imagePos"]  = "";
                        $definedConfigs[$i."-timer"]     = "";
                    }                                                          
                }
				
		        foreach( $definedConfigs as $config => $key ){
	 
		      		Configuration::updateValue($this->name.'_'.$config, Tools::getValue($config), true);
		    	}
                
                //echo "<pre>";print_r(Tools::getValue("home_sorce")); die;
                //$params->set( 'custom_id_parent', $ids );
                if(Tools::getValue('category')){
    		        if(in_array("",Tools::getValue('category'))){
    		          $catList = "";
    		        }else{
    		          $catList = implode(",",Tools::getValue('category'));  
    		        }
                    Configuration::updateValue($this->name.'_category', $catList, true);
                }
				//manu tab
				if(Tools::getValue('manu')){  		        
    		        $catList = implode(",",Tools::getValue('manu'));    		        
                    Configuration::updateValue($this->name.'_manu', $catList, true);
                }
                $linkArray = Tools::getValue('override_links');
                if($linkArray){
                    foreach ($linkArray as $key => $value) {
                        if (is_null($value) || $value == "") {
                            unset ($linkArray[$key]);
                        }
                    }
                    $override_links = implode(",",$linkArray);
                    Configuration::updateValue($this->name.'_override_links', $override_links, true);
                }
				$delText = '';	
		        if(Tools::getValue('delCaImg')){					
					if(_PS_VERSION_ <="1.4"){						
						$cacheFol = _PS_IMG_DIR_.$this->name;												
					}else{			
						$cacheFol = _PS_CACHEFS_DIRECTORY_.$this->name;							
					}					
					if( file_exists( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/group_base.php' ) && !class_exists("LofNewProductDataSourceBase", false) ){
						if( !defined("LOF_LOAD_LIB_GROUP") ) {
							require_once( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/group_base.php' );
							define("LOF_LOAD_LIB_GROUP",true);
						}
					}
					if (LofDataSourceBase::removedir($cacheFol)){
						$delText =  $this->l('. Cache folder has been deleted');
					}else{
						$delText =  $this->l('. Cache folder can\'tdeleted');
					}  
				}
		        $html .= '<div class="conf confirm">'.$this->l('Settings updated').$delText.'</div>';
			}
			else
			{
				foreach ($this->_postErrors AS $err)
				{
					$html .= '<div class="alert error">'.$err.'</div>';
				}
			}
			// reset current values.
			$this->_params = new LofParams( $this->name );	
		}
			
		return $html.$this->_getFormConfig();
	}
	
	/**
	 * Render Configuration From for user making settings.
	 *
	 * @return context
	 */
	private function _getFormConfig(){		
		$html = '';
		 
	    $formats = ImageType::getImagesTypes( 'products' );
	    $themes=$this->getFolderList( dirname(__FILE__)."/tmpl/" );
        $groups=$this->getFolderList( dirname(__FILE__)."/libs/groups/" );

	    ob_start();
	    include_once dirname(__FILE__).'/config/lofnewproduct.php'; 
	    $html .= ob_get_contents();
	    ob_end_clean(); 
		return $html;
	}
    
	/**
     * Process vadiation before saving data 
     */
	private function _postValidation()
	{
		if (!Validate::isCleanHtml(Tools::getValue('module_height')))
			$this->_postErrors[] = $this->l('The module height you entered was not allowed, sorry');
		if (!Validate::isCleanHtml(Tools::getValue('module_width')))
			$this->_postErrors[] = $this->l('The module width you entered was not allowed, sorry');
		if (!Validate::isCleanHtml(Tools::getValue('des_max_chars')) || !is_numeric(Tools::getValue('des_max_chars')))
			$this->_postErrors[] = $this->l('The description max chars you entered was not allowed, sorry');
		
		if (!Validate::isCleanHtml(Tools::getValue('main_height')) || !is_numeric(Tools::getValue('main_height')))
			$this->_postErrors[] = $this->l('The Main Image Height you entered was not allowed, sorry');
		if (!Validate::isCleanHtml(Tools::getValue('main_width')) || !is_numeric(Tools::getValue('main_width')))
			$this->_postErrors[] = $this->l('The Main Image Width you entered was not allowed, sorry');
 
                      							
	}
	
	public function getProFeature(){
		$sql = 'SELECT DISTINCT p.id_product FROM `'._DB_PREFIX_.'category_product` cp '
		 . 'LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product` '
		 . 'WHERE cp.`id_category` =1';    
		return Db::getInstance()->ExecuteS($sql);
	} 	 
        
	
   /**
    * Get value of parameter following to its name.
    * 
	* @return string is value of parameter.
	*/
	public function getParamValue($name, $default=''){
		return $this->_params->get( $name, $default );	
	}	  	  		
} 