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
 * loftwitter Class
 */	
class LofTwitter extends Module
{
	/**
	 * @var LofParams $_params;
	 *
	 * @access private;
	 */
	private $_params = '';	
	public $site_url = '';	
	
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
	function __construct(){
		$this->name = 'loftwitter';
		parent::__construct();			
		$this->tab = 'LandOfCoder';				
		$this->version = '1.0.0';
		$this->displayName = $this->l('Lof Twitter Module');
		$this->description = $this->l('Lof Twitter');
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
		if(!$this->registerHook('footer'))
			return false;
		if(!$this->registerHook('header'))
			return false;
		return true;
	}
	
	/*
	 * register hook right comlumn to display slide in right column
	 */
	function hookrightColumn($params){		
		return $this->processHook( $params,"rightColumn");
	}
	
	/*
	 * register hook left comlumn to display slide in left column
	 */
	function hookleftColumn($params){		
		return $this->processHook( $params,"leftColumn");
	}
	
	function hooktop($params){		
		return $this->processHook( $params,"top");
	}
	
	function hookfooter($params){		
		return $this->processHook( $params,"footer");
	}
	
	function hookcontenttop($params){ 		
		return $this->processHook( $params,"contenttop");
	}
  	
	function hooklofTop($params){
		return $this->processHook( $params,"lofTop");
	}
		
	function hookHome($params){
		return $this->processHook( $params,"home");
	}
	function hookloftwitter1($params){
		return $this->processHook( $params,"loftwitter1");
	}
	function hookloftwitter2($params){
		return $this->processHook( $params,"loftwitter2");
	}
	
	function hookHeader($params)
	{ 
		$params = $this->_params;
		$theme 			= $params->get( 'module_theme' , 'default');
		$showMode      = $params->get( 'showMode' , 'scroll');
		$cssjs = "";
		if(_PS_VERSION_ <= "1.4"){
			if( $theme && $theme != -1 ){
				if ( $showMode == "ticker"){
					$cssjs .= "<link href='"._MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/style.css' rel='stylesheet' type='text/css' media='all' />";
					$cssjs .= "<link href='"._MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/li_scroller.css' rel='stylesheet' type='text/css' media='all' />";
					$cssjs .= "<link href='"._MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/black.css' rel='stylesheet' type='text/css' media='all' />";
					$cssjs .= "<link href='"._MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/blue.css' rel='stylesheet' type='text/css' media='all' />";
					$cssjs .= "<link href='"._MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/white.css' rel='stylesheet' type='text/css' media='all' />";
				}
				elseif ( $showMode == "block" ){
					$cssjs .= "<link href='"._MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/block.css' rel='stylesheet' type='text/css' media='all' />";
				}
				else{
					$cssjs .= "<link href='"._MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/style.css' rel='stylesheet' type='text/css' media='all' />";
					$cssjs .= "<link href='"._MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/jScrollPane.css' rel='stylesheet' type='text/css' media='all' />";
				}
			}
			if ( $showMode == "ticker"){
				$cssjs .= "<script type=\"text/javascript\" src=\""._MODULE_DIR_.$this->name."/assets/jquery.li-scroller.1.0.js\"></script>";
			}
			elseif ( $showMode == "block" ){
				$cssjs .= "<script type=\"text/javascript\" src=\""._MODULE_DIR_.$this->name."/assets/jcarousellite.js\"></script>";
			}
			else{
				$cssjs .= "<script type=\"text/javascript\" src=\""._MODULE_DIR_.$this->name."/assets/jScrollPane/jquery.mousewheel.js\"></script>";
				$cssjs .= "<script type=\"text/javascript\" src=\""._MODULE_DIR_.$this->name."/assets/jScrollPane/jScrollPane.js\"></script>";
			}
			$cssjs .= "<script type=\"text/javascript\" src=\""._MODULE_DIR_.$this->name."/assets/jtweetsanywhere.js\"></script>";
			$cssjs .= "<script type=\"text/javascript\" src=\""._MODULE_DIR_.$this->name."/assets/script.js\"></script>";
			$cssjs .= "<script type=\"text/javascript\" src=\"http://platform.twitter.com/anywhere.js?id=ZSO1guB57M6u0lm4cwqA&v=1\"></script>";
            return $cssjs;
		}
		else {
			if( $theme && $theme != -1 ){
				if ( $showMode == "ticker"){
					Tools::addCSS(_MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/style.css", 'all');
					Tools::addCSS(_MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/li_scroller.css", 'all');
					Tools::addCSS(_MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/black.css", 'all');
					Tools::addCSS(_MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/blue.css", 'all');
					Tools::addCSS(_MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/white.css", 'all');
				}
				elseif ( $showMode == "block" ){
					Tools::addCSS(_MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/block.css", 'all');
				}
				else{
					Tools::addCSS(_MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/style.css", 'all');
					Tools::addCSS(_MODULE_DIR_.$this->name."/tmpl/".$theme."/assets/css/jScrollPane.css", 'all');
				}
				
			}
			if ( $showMode == "ticker"){
				Tools::addJS(_MODULE_DIR_.$this->name."/assets/jquery.li-scroller.1.0.js");
			}
			elseif ( $showMode == "block" ){
				Tools::addJS(_MODULE_DIR_.$this->name."/assets/jcarousellite.js");
			}
			else{
				Tools::addJS(_MODULE_DIR_.$this->name."/assets/jScrollPane/jquery.mousewheel.js");
				Tools::addJS(_MODULE_DIR_.$this->name."/assets/jScrollPane/jScrollPane.js");
			}
			Tools::addJS(_MODULE_DIR_.$this->name."/assets/jtweetsanywhere.js");
			Tools::addJS(_MODULE_DIR_.$this->name."/assets/script.js");
			$cssjs = "<script type=\"text/javascript\" src=\"http://platform.twitter.com/anywhere.js?id=18sTEQuTSqkRAXQuFQg&amp;v=1\"></script>\n";
			return $cssjs;
		}        		        
	}
	
	/**
    * Proccess module by hook
    * $pparams: param of module
    * $pos: position call
    */
	function processHook($pparams, $pos="home"){
		global $smarty;                  
		//load param
		
		$params = $this->_params;
		$this->site_url = Tools::htmlentitiesutf8('http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__);
		// get params
		$tmp 			= $params->get( 'module_height', '200' );
		$moduleHeight   =  ( $tmp=='auto' ) ? 'auto' : (int)$tmp.'px';
		$Height   =  ( $tmp=='auto' ) ? 'auto' : (int)$tmp;
		$tmp            = $params->get( 'module_width', '275' );
		$Width    =  ( $tmp=='auto') ? 'auto': (int)$tmp;
		$moduleWidth    =  ( $tmp=='auto') ? 'auto': (int)$tmp.'px';
		$moduleCenter   = ( $tmp=='auto') ? 'auto': ((int)$tmp-200).'px';
		$title 			= $params->get( 'title' , 'Latest Tweets');
		$theme 			= $params->get( 'module_theme' , 'default');
		$showMode      = $params->get( 'showMode' , 'scroll');
		$pathitem       = _PS_ROOT_DIR_.'/modules/'.$this->name.'/tmpl/'.$theme."/_".strtolower($showMode).'.tpl';
		$blockid        = $this->id;
		$prfSlide       = $pos;
        //get prams config JS
        $username      	= $params->get( 'username' , 'landofcoder,habqlandofcoder,TechCrunch');
		$username 		= explode(",",$username);
		$username 		= "'".implode("','",$username)."'";
        $limit_items      = $params->get( 'limit_items' , 2);
        $space      = $params->get( 'space' , 5);
        $layout      = $params->get( 'layout' , 1);
        $hoverPause      = $params->get( 'hoverPause' , 1);
        $visible      = $params->get( 'visible' , 3);
        $auto      = $params->get( 'auto' , 500);
        $speed      = $params->get( 'speed' , 1000);
        $expandHovercards      = $params->get( 'expandHovercards' , 1);
        $showSource      = $params->get( 'showSource' , 1);
        $showFollowButton      = $params->get( 'showFollowButton' , 1);
		// template asignment variables
		$smarty->assign( array(	
						      'modName'         => $this->name,
                              'prfSlide'        => $prfSlide,
							  'blockid' 		=> $blockid,
							  'moduleWidth'     => $moduleWidth,
							  'moduleCenter'    => $moduleCenter,
							  'moduleHeight'	=> $moduleHeight,
							  'params'		    => $params,
							  'site_url'		=> $this->site_url,
							  'title'		    => $title,
							  'theme'           => $params->get( 'module_theme' , 'default')
						));
		// render for content layout of module
		$content = '';
		ob_start();
	       require( dirname(__FILE__).'/initjs.php' );		
	       $content = ob_get_contents();
	    ob_end_clean();		
	    return $this->display(__FILE__, 'tmpl/'.$theme.'/_'.$showMode.'.tpl').$content;					
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
                  'module_theme'  	  => '',	          	                                                              
                  'title'  	  => '',	          	                                                              
                  //
		          'module_width'        => '',                                       
		          'module_height'        => '',                                       
		          'username'        => '',                                       
		          'limit_items'        => '',                                       
		          'space'        => '',                                       
		          'showMode'        => '',                                       
		          'layout'        => '',                                       
		          'hoverPause'        => '',                                       
		          'visible'        => '',                                       
		          'auto'        => '',                                       
		          'speed'        => '',                                       
		          'expandHovercards'        => '',                                       
		          'showSource'        => '',                                       
		          'showFollowButton'        => '',                                       
		        );
		        foreach( $definedConfigs as $config => $key ){
		            if(strlen($this->name.'_'.$config)>=32){
		              echo $this->name.'_'.$config;
		            }else{
		              Configuration::updateValue($this->name.'_'.$config, Tools::getValue($config), true);  
		            } 		      		
		    	}
		        $html .= '<div class="conf confirm">'.$this->l('Settings updated successful').'</div>';
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
		 
	    $themes=$this->getFolderList( dirname(__FILE__)."/tmpl/" );

	    ob_start();
	    include_once dirname(__FILE__).'/config/loftwitter.php'; 
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
		if (!Validate::isCleanHtml(Tools::getValue('limit_items')) || !is_numeric(Tools::getValue('limit_items')))
			$this->_postErrors[] = $this->l('The limit items you entered was not allowed, sorry');	
		if (!Validate::isCleanHtml(Tools::getValue('space')) || !is_numeric(Tools::getValue('space')))
			$this->_postErrors[] = $this->l('The space you entered was not allowed, sorry');
		if (!Validate::isCleanHtml(Tools::getValue('visible')) || !is_numeric(Tools::getValue('visible')))
			$this->_postErrors[] = $this->l('The visible you entered was not allowed, sorry');        
        if (!Validate::isCleanHtml(Tools::getValue('auto')) || !is_numeric(Tools::getValue('auto')))
			$this->_postErrors[] = $this->l('The auto you entered was not allowed, sorry');
        if (!Validate::isCleanHtml(Tools::getValue('speed')) || !is_numeric(Tools::getValue('speed')))
			$this->_postErrors[] = $this->l('The speed you entered was not allowed, sorry');                   							
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