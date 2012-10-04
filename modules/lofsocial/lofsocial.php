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
class lofsocial extends Module
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
		$this->name = 'lofsocial';
		parent::__construct();			
		$this->tab = 'LandOfCoder';				
		$this->version = '1.0.0';
		$this->displayName = $this->l('Lof Social Share Module');
		$this->description = $this->l('Lof Social Share Module');
		if( file_exists( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/params.php' ) && !class_exists("LofParams", false) ){
			if( !defined("LOF_SOCIAL_LOAD_LIB_PARAMS") ){				
				require( _PS_ROOT_DIR_.'/modules/'.$this->name.'/libs/params.php' );
				define("LOF_SOCIAL_LOAD_LIB_PARAMS",true);
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
		if(!$this->registerHook('productfooter'))
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
	/*
	 * register hook right comlumn to display slide in right column
	 */
	function hookrightColumn($params)
	{
        if( ($this->_params->get("lofhook", "rightColumn") == "rightColumn") && ($this->_params->get("module_group", "pages") == "pages") ) {
		  return $this->processHook( $params,"rightColumn");
        }
	}
	/*
	 * register hook left comlumn to display slide in left column
	 */
	function hookleftColumn($params)
	{		
        if( ($this->_params->get("lofhook", "leftColumn") == "leftColumn") && ($this->_params->get("module_group", "pages") == "pages") ) {
            return $this->processHook( $params,"leftColumn");
        }
	}
	function hooktop($params)
	{	
        if( ($this->_params->get("lofhook", "top") == "top") && ($this->_params->get("module_group", "pages") == "pages") ) {
		  return '</div><div class="clearfix"></div><div>'.$this->processHook( $params,"top");
        }
	}
	function hookfooter($params)
	{	
	    if( ($this->_params->get("lofhook", "footer") == "footer") && ($this->_params->get("module_group", "pages") == "pages") ) {
		  return $this->processHook( $params,"footer");
        }
	}
	function hookcontenttop($params)
	{ 		
    	return $this->processHook( $params,"contenttop");
	}
	function hookHeader($params)
	{
        $params = $this->_params;
		$theme 			= $params->get( 'module_theme' , 'basic');
		$module_group      = $params->get( 'module_group' , 'product');
		if(_PS_VERSION_ <="1.4"){							
			$header = '<link type="text/css" rel="stylesheet" href="'.($this->_path).'assets/style.css'.'" />';
			return $header;			
		}else{
			Tools::addCSS( ($this->_path).'assets/style.css', 'all');
		}
	}
	function hooklofTop($params){
		return $this->processHook( $params,"lofTop");
	}
	function hookHome($params)
	{
        if( ($this->_params->get("lofhook", "home") == "home") && ($this->_params->get("module_group", "pages") == "pages") ) {
            return $this->processHook( $params,"home");
        }
	}
    function hookproductfooter($params)
	{
	   if( $this->_params->get("module_group", "product") == "product" ) {
            return $this->processHook( $params,"productfooter");
        }
	   
	}
    function hooklofsocial1($params){
		return $this->processHook( $params,"lofsocial1");
	}
    function hooklofsocial2($params){
		return $this->processHook( $params,"lofsocial2");
	}
    function hooklofsocial3($params){
		return $this->processHook( $params,"lofsocial3");
	}
    function hooklofsocial4($params){
		return $this->processHook( $params,"lofsocial4");
	}
    function getListCatId( $parent_id ){
        global $cookie, $link;
		$id_lang = intval($cookie->id_lang);			
		$query = 'SELECT c.`id_category`, c.`id_parent`, cl.`name`, cl.`description`, cl.`link_rewrite`' .
				' FROM `'._DB_PREFIX_.'category` c' .
                ' LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON cl.`id_category` = c.`id_category` '.
				' WHERE c.id_category IN ('.$parent_id.') GROUP BY id_category';
		$result = Db::getInstance()->ExecuteS($query);
		return $result;
   }
	/**
	 * get list of subcategories by id
	 */
    function getListCategories($params, $idds){        
            global $cookie, $link;
			$id_lang = intval($cookie->id_lang);
    		$ids = implode(",", $idds);        
            $cate = array();				
    		$query = 'SELECT c.`id_category`, c.`id_parent`, cl.`name`, cl.`description`, cl.`link_rewrite`' .
    				' FROM `'._DB_PREFIX_.'category` c' .
                    ' LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON cl.`id_category` = c.`id_category` '.
    				' WHERE c.id_category IN ('.$ids.') GROUP BY id_category';
    		$data = Db::getInstance()->ExecuteS($query);
            $ids = array();
    		return $data;
	   }
	/**
    * Proccess module by hook
    * $pparams: param of module
    * $pos: position call
    */
	function processHook( $params , $hname ){
 
    	global $cookie, $smarty;                
		//load param
		$params = $this->_params;
 
       
		$site_url = Tools::htmlentitiesutf8('http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__);
		
        /*
        * Config Param
        */
        $imgFolder = _PS_IMG_DIR_.$this->name;
        
        $moduleId = rand().time();
        $moduleHeight                       =  $params->get("md_height",350);
        $moduleWidth                        =  $params->get("md_width",900);
		$theme 			                    = $params->get("module_theme","basic");
		$productids 			            = $params->get("productids");
		$home_sorce 			            = $params->get("home_sorce","selectcat");
		$module_group                       = $params->get( 'module_group' , 'pages');
		$lofhook                            = $params->get( 'lofhook' , 'home');
        $selectCat                          = $params->get("category","");
        $butstyle                           = $params->get('butstyle','lg-icons');
        $pubkey                             = $params->get('pubkey','');
        $widgettype                         = $params->get('widgettype');
        
        
        ///////////////////////////////////////////////////
        if( $module_group == 'product' ){
     
			if(isset($_GET['id_product'])){
				$content_id = ($_GET['id_product']);
				
			}
            if( $home_sorce == "selectcat" ){
                $query = 'SELECT p.`id_product`' .
            				' FROM `'._DB_PREFIX_.'category_product` cp' .
                            ' LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product` '.
            				' WHERE cp.id_category IN ('.$selectCat.') AND p.`id_product` = ('.$content_id.') GROUP BY id_category';
           		$dataArray = Db::getInstance()->ExecuteS($query);
                if( !is_array($dataArray) || $dataArray == NULL ){ return null; }
            }else{
                $pieces = explode(",", $productids);
                $checkId = in_array($content_id, $pieces);
                if( $checkId == '' ){
                    return null;
                }
            }  
        } 
    if(($widgettype)!=0)
    {
    	$newWidget = "<script type='text/javascript'>var switchTo5x=true;</script>";
    } 
    else
    {
    	/* Old version of shareThis widget 4.x */
    	$newWidget ="";
    }
    echo $newWidget;
    echo '<script type="text/javascript" src="'.($this->_path).'assets/buttons.js'.'"></script>';

    echo '<script type="text/javascript">stLight.options({publisher:'.$pubkey.'});</script>';
    $notext="0";
    if(($butstyle)=='lg-icons')
    {
      $style="_large";
    }
    /* Button Style : Horizontal Count */
    if(($butstyle)=='lg-horizontal')
    {
        $style="_hcount";
    }
    /* Button Style : Vertical Count */
    if(($butstyle)=='lg-vertical')
    {
        $style="_vcount";
    }
    /* Button Style : Classic */
    if(($butstyle)=='sm-classic')
    {
    	return "<span class='st_sharethis' displayText='ShareThis'></span>";
    }
    /* Button Style : Regular Buttons */
    
    if(($butstyle)=='sm-regular')
    {
        $style="";
    }
    /* Button Style : Regular Button No-Text */
    
    if(($butstyle)=='sm-notext')
    {
        $style="";
        $notext="1";
    }
    /* Button Style : Buttons */
    
    if(($butstyle)=='button')
    {
        $style="_buttons";
    }
    $facebook=$params->get('facebook',1);
    if ($facebook==1)
    {
        $facebook="<span class='st_facebook".$style."' displayText='Facebook' title='Facebook'></span>";
        if($notext==1) {$facebook="<span class='st_facebook".$style."' ></span>";}
    }
    else
    {
        $facebook="";
    }
    
    $twitter=$params->get('twitter',1);
    if ($twitter==1)
    {
        $twitter="<span class='st_twitter".$style."' displayText='Tweet' title='Tweet'></span>";
        if($notext==1) {$twitter="<span class='st_twitter".$style."'></span>";}
    }
    else
    {
        $twitter="";
    }
    
    
    $sharethis=$params->get('sharethis',1);
    if ($sharethis==1)
    {
        $sharethis="<span class='st_sharethis".$style."' displayText='ShareThis' title='ShareThis'></span>";
        if($notext==1) {$sharethis="<span class='st_sharethis".$style."'></span>";}
    }
    else
    {
        $sharethis="";
    }
    
    
    $email=$params->get('email',1);
    if ($email==1)
    {
        $email="<span class='st_email".$style."' displayText='Email' title='Email'></span>";
        if($notext==1) {$email="<span class='st_email".$style."'></span>";}
    }
    else
    {
        $email="";
    }
    
    
    $plusone=$params->get('plusone',0);
    if ($plusone==1)
    {
        $plusone="<span class='st_plusone".$style."' displayText='+1' title='Google Plus'></span>";
        if($notext==1) {$plusone="<span class='st_plusone".$style."'></span>";}
    }
    else
    {
        $plusone="";
    }
    
    
    $fblike=$params->get('fblike',0);
    if ($fblike==1)
    {
        $fblike="<span class='st_fblike".$style."' displayText='fblike' title='Facebook Like'></span>";
        if($notext==1) {$fblike="<span class='st_fblike".$style."'></span>";}
    }
    else
    {
        $fblike="";
    }
    
    
    $linkedin=$params->get('linkedin',1);
    if ($linkedin==1)
    {
        $linkedin="<span class='st_linkedin".$style."' displayText='LinkedIn' title='LinkedIn'></span>";
        if($notext==1) {$linkedin="<span class='st_linkedin".$style."'></span>";}
    }
    else
    {
        $linkedin="";
    }
    
    
    
    $yahoo=$params->get('yahoo',1);
    if ($yahoo==1)
    {
        $yahoo="<span class='st_yahoo".$style."' displayText='Yahoo' title='Yahoo'></span>";
        if($notext==1) {$yahoo="<span class='st_yahoo".$style."'></span>";}
    }
    else
    {
    $yahoo="";
    }
    
    
    $gbuzz=$params->get('gbuzz',1);
    if ($gbuzz==1)
    {
        $gbuzz="<span class='st_gbuzz".$style."' displayText='Gbuzz' title='Google Buzz'></span>";
        if($notext==1) {$gbuzz="<span class='st_gbuzz".$style."'></span>";}
    }
    else
    {
        $gbuzz="";
    }
    
    
    $technorati=$params->get('technorati',1);
    if ($technorati==1)
    {
        $technorati="<span class='st_technorati".$style."' displayText='Technorati' title='Technorati'></span>";
        if($notext==1) {$technorati="<span class='st_technorati".$style."'></span>";}
    }
    else
    {
        $technorati="";
    }
    
    $newsvine=$params->get('newsvine',1);
    if ($newsvine==1)
    {
        $newsvine="<span class='st_newsvine".$style."' displayText='NewsVine' title='NewsVine'></span>";
        if($notext==1) {$newsvine="<span class='st_newsvine".$style."'></span>";}
    }
    else
    {
        $newsvine="";
    }
    
    
    $delicio=$params->get('delicio',1);
    if ($delicio==1)
    {
        $delicio="<span class='st_delicio".$style."' displayText='del.icio.us' title='del.icio.us'></span>";
        if($notext==1) {$delicio="<span class='st_delicio".$style."'></span>";}
    }
    else
    {
        $delicio="";
    }
    
    $blogmarks=$params->get('blogmarks',1);
    if ($blogmarks==1)
    {
        $blogmarks="<span class='st_blogmarks".$style."' displayText='BlogMarks' title='BlogMarks'></span>";
        if($notext==1) {$blogmarks="<span class='st_blogmarks".$style."'></span>";}
    }
    else
    {
        $blogmarks="";
    }
    
    $digg=$params->get('digg',1);
    if ($digg==1)
    {
        $digg="<span class='st_digg".$style."' displayText='Digg' title='Digg'></span>";
        if($notext==1) {$digg="<span class='st_digg".$style."'></span>";}
    }
    else
    {
        $digg="";
    }
    
    $reddit=$params->get('reddit',1);
    if ($reddit==1)
    {
        $reddit="<span class='st_reddit".$style."' displayText='Reddit' title='Reddit'></span>";
        if($notext==1) {$reddit="<span class='st_reddit".$style."'></span>";}
    }
    else
    {
        $reddit="";
    }
    
    $data = $linkedin.$facebook.$twitter.$yahoo.$email.$sharethis.$technorati.$newsvine.$blogmarks.$digg.$reddit.$plusone.$fblike;
	
        /*
        * End check status of products
        */
		// template asignment variables
		$smarty->assign( array(
                              'moduleId'            => $moduleId,
                              'productids'          => $productids,
                              'home_sorce'          => $home_sorce,
                              'module_group'        => $module_group,
                              'lofhook'             => $lofhook,
                              'widgettype'          => $widgettype,
                              'pubkey'              => $pubkey,
                              'butstyle'            => $butstyle,
                              'data'                => $data,
                              'facebook'            => $facebook,
                              'twitter'             => $twitter,
                              'sharethis'           => $sharethis,
                              'email'               => $email,
                              'plusone'             => $plusone,
                              'fblike'              => $fblike,
                              'linkedin'            => $linkedin,
                              'yahoo'               => $yahoo,
                              'gbuzz'               => $gbuzz,
                              'technorati'          => $technorati,
                              'newsvine'            => $newsvine,
                              'blogmarks'           => $blogmarks,
                              'digg'                => $digg,
                              'reddit'              => $reddit
                              
                              
                              
						));
                        
        return $this->display(__FILE__, $this->getLayoutPath($theme) );				
	}
    public function getLayoutPath( $theme ){
        $layout = 'tmpl/'.$theme.'/default.tpl';
        if( !file_exists(__FILE__."/".$layout) ){
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
		          'module_theme'          => '',
		          'home_sorce'            => '',
		          'lofhook'               => '',
		          'module_group'          => '',
		          'productids'            => '',
		          'pubkey'                => '',
		          'widgettype'            => '',
		          'butstyle'              => '',
		          'facebook'              => '',
		          'twitter'               => '',
		          'sharethis'             => '',
		          'email'                 => '',
		          'plusone'               => '',
		          'fblike'                => '',
		          'linkedin'              => '',
		          'yahoo'                 => '',
		          'gbuzz'                 => '',
		          'technorati'            => '',
		          'newsvine'              => '',
		          'blogmarks'             => '',
		          'digg'                  => '',
		          'reddit'                => ''
		          
		        );
                $listarticle = Tools::getValue('custom-num');
                $languages = Language::getLanguages();
                
		        foreach( $definedConfigs as $config => $key ){
		      		Configuration::updateValue($this->name.'_'.$config, Tools::getValue($config), true);
		    	}
                if(Tools::getValue('category')){
    		        if(in_array("",Tools::getValue('category'))){
    		          $catList = "";
    		        }else{
    		          $catList = implode(",",Tools::getValue('category'));  
    		        }
                    Configuration::updateValue($this->name.'_category', $catList, true);
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
				$html .= '<div class="conf confirm">'.$this->l('Settings updated').'</div>';
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
	    include_once dirname(__FILE__).'/config/lofsocial.php'; 
	    $html .= ob_get_contents();
	    ob_end_clean(); 
		return $html;
	}
    public function getProFeature(){
        $sql = 'SELECT DISTINCT p.id_product FROM `'._DB_PREFIX_.'category_product` cp '
             . 'LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product` '
             . 'WHERE cp.`id_category` =1';    
       return Db::getInstance()->ExecuteS($sql);
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



 