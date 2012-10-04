<?php
/**
 * $ModDesc
 * 
 * @version		$Id: file.php $Revision
 * @package		modules
 * @subpackage	$Subpackage.
 * @copyright	Copyright (C) Jan 2012 leotheme.com <@emai:leotheme@gmail.com>.All rights reserved.
 * @license		GNU General Public License version 2
 */
 
if (!defined('_CAN_LOAD_FILES_'))
	exit;
class Leotempcp extends Module
{

	var $themeInfo = array();
	var $themePrefix = '';
	function __construct()
	{
		$this->name = 'leotempcp';
		$this->tab = 'Home';
		$this->version = '1.0';
		
		parent::__construct();
		
		$this->displayName = $this->l('Leo Theme Control Panel');
		$this->description = $this->l('change theme color');
		$this->confirmUninstall = $this->l('Are you sure you want to unistall Theme Skins?');
		
			/* merging addition configuration from current theme */
		$theme_dir = _THEME_NAME_;
		if(  file_exists(_PS_ALL_THEMES_DIR_.$theme_dir."/info/info.php") ){
			require( _PS_ALL_THEMES_DIR_.$theme_dir."/info/info.php" );
		}
		
		$this->themeInfo   = $this->getInfo();
		$this->themePrefix  = _THEME_NAME_;
		
	//	echo '<pre>'.print_r($this->themeInfo,1 );die;	
	}

	
	public function install()
	{
		if (!parent::install()
				OR !$this->registerHook('top')
				OR !$this->registerHook('header')
				OR Configuration::updateValue('DISPLAY_THMSKINSBLACK', 1) == false

			)
			return false;
		return true;
	}

	function getContent()
	{
		$this->_html = '<h2>'.$this->displayName.'</h2>';
		if (isset($_POST['submitUpdate']))
		{	
	
			$leoskin = (Tools::getValue('leoskin')); 
			Configuration::updateValue('leoskin', $leoskin);
			$leopntool = (Tools::getValue('leopntool')); 
			Configuration::updateValue('leopntool', $leopntool);
			$leorespon = (Tools::getValue('leorespon')); 
			Configuration::updateValue('leorespon', $leorespon);
			
		 	$templatewidth = (Tools::getValue('templatewidth')); 
			Configuration::updateValue('templatewidth', $templatewidth);
			$leolayout = (Tools::getValue('leolayout')); 
			Configuration::updateValue('leolayout', $leolayout);
			
			LeoThemeInfo::onUpdateConfig();
			$forbidden = array('submitUpdate');
			
			foreach ($_POST AS $key => $value){
				if (!Validate::isCleanHtml($_POST[$key]))
				{
					$this->_html .= $this->displayError($this->l('Invalid html field, javascript is forbidden'));
					$this->_displayForm();
					return $this->_html;
				}
			}
		}

		$this->_displayForm();
		
		return $this->_html;
	}

	private function _displayForm()
	{
		global $cookie;
		
		if( empty($this->themeInfo) ){
			$this->_html .= '	<fieldset style="width: 900px;"><legend><img src="'.$this->_path.'logo.gif" alt="" title="" /> '.$this->displayName.'</legend>'.
				$this->l("The Theme Configuration is not avariable, because may be you forgot set a theme from LeoTheme.Com as default theme of front-office, Please try to check again")
			.'</fieldset';
			
			return ;
		}
		
		$skins = $this->themeInfo["skins"];
		$dskins = Configuration::get('leoskin');
		$dlayout = Configuration::get('leolayout');
		$layouts = array( "-lcr" => $this->l("Content - Right") ,
						  "-rcl" => $this->l("Right - Content"));
		$this->_html .= '<br />
		<form method="post" action="'.$_SERVER['REQUEST_URI'].'" enctype="multipart/form-data">
			<fieldset style="width: 900px;">
				<legend><img src="'.$this->_path.'logo.gif" alt="" title="" /> '.$this->displayName.'</legend>
				<h4>'. $this->l( "Configuration For <i>" . _THEME_NAME_ . "</i> Theme " ) .'</h4>
				<label>'.$this->l('Template Width').'</label>
				<div class="margin-form">
					<input name="templatewidth" value="'.(Tools::getValue('templatewidth', "980px") ).'"/>
					<div class="clear clr"></div><sub>'.$this->l("Set Template Width in number(px) or number(%), for example 980px, 99% ").'</sub>
				</div>
				<label>'.$this->l('Default Skin').'</label>
				<div class="margin-form">
					
					<select name="leoskin">';
						foreach( $skins as $skin ){
							$this->_html .= '<option '.($skin==$dskins?'selected="selected"':"").' value="'.$skin.'">'.$this->l($skin).'</option>';
						}
					$this->_html .=	'</select>
				</div>	
				
				<label>'.$this->l('Layout Direction').'</label>
				<div class="margin-form">
					
					<select name="leolayout">';
						foreach( $layouts as $layout ){
							$this->_html .= '<option '.($layout==$dlayout?'selected="selected"':"").' value="'.$layout.'">'.$this->l($layout).'</option>';
						}
					$this->_html .=	'</select>
				</div>	
				
				<label>'.$this->l('Panel Toool').'</label>	
				<div class="margin-form">
					<input type="radio" name="leopntool" id="leopntool_on" value="1" '.(Tools::getValue('leopntool', Configuration::get('leopntool')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="leopntool_on"> <img src="../img/admin/enabled.gif" /></label>
					<input type="radio" name="leopntool" id="leopntool_off" value="0" '.(!Tools::getValue('leopntool', Configuration::get('leopntool')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="leopntool_off"> <img src="../img/admin/disabled.gif" /></label>
				</div>	
				<label>'.$this->l('Responsive feature').'</label>	
				<div class="margin-form">
					<input type="radio" name="leorespon" id="leorespon_on" value="1" '.(Tools::getValue('leorespon', Configuration::get('leorespon')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="leorespon_on"> <img src="../img/admin/enabled.gif" /></label>
					<input type="radio" name="leorespon" id="leorespon_off" value="0" '.(!Tools::getValue('leorespon', Configuration::get('leorespon')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="leorespon_off"> <img src="../img/admin/disabled.gif" /></label>
				</div>	
				
				';
			$this->_html = LeoThemeInfo::onRenderForm( $this->_html, $this );	
			$this->_html .= '<div class="clear pspace"></div>
				<div class="margin-form clear"><input type="submit" name="submitUpdate" value="'.$this->l('SAVE').'" class="button" /></div>
			</fieldset>
		</form>';
	}

	public function getInfo(){
		
		$theme_dir = _THEME_NAME_;
		$info = simplexml_load_file( _PS_ALL_THEMES_DIR_.$theme_dir.'/config.xml' );
		if( !$info || !isset($info->name)|| !isset($info->positions) ){
			return null;
		}
		$p = (array)$info->positions;
		$output = array("skins"=>"","positions"=>$p["position"],"name"=>(string)$info->name );
		if( isset($info->skins) ){
			$tmp =  (array)$info->skins;
			$output["skins"] = $tmp["skin"];
		}
		
	
		$output = LeoThemeInfo::onGetInfo( $output );
		return $output;
	}
	
	function hooktop($params)
	{			
		global $cookie, $smarty;
		
		if( $this->themeInfo ){
			$skin = Configuration::get('leoskin');
			$layout ='-lcr';
			$paneltool =  Tools::getValue('leopntool', Configuration::get('leopntool'));
			/* if enable user custom setting, the theme will use those configuration*/
			if( $paneltool ){
				$vars = array("skin"=>$skin,"layout"=>"-lcr");
				if( isset($_GET["usercustom"]) && strtolower( $_GET['usercustom'] ) == "apply" ){
					foreach( $vars as $key => $val ){
						if( isset($_GET[$key]) ){  
							$cookie->__set( "leou_".$key, $_GET[$key] );
							$val =  $_GET[$key];
						}
					}
					Tools::redirect( "index.php" );
				}
				if( isset($_GET["leoaction"]) && $_GET["leoaction"] == "reset" ){
					foreach( $vars as $key => $val ){
						$cookie->__set("leou_".$key, Configuration::get("leo"+$key));
					}
					Tools::redirect( "index.php" );	
				} 
				
				foreach( $vars as $key => $val ){
					if( $cookie->__get(  "leou_".$key ) ){
						$$key = $cookie->__get(  "leou_".$key );	
					}else {
						$$key = $val;
					}
				}
			}
			
			$ps = array(		  	
				'LEO_SKIN_DEFAULT' => $skin,
				'this_path' 	   => $this->_path,
				'LEO_PANELTOOL'	   => $paneltool,
				'LEO_THEMEINFO'    => $this->themeInfo,
				'LEO_THEMENAME'	   => _THEME_NAME_,
				'LEO_LAYOUT_DIRECTION' => $layout,
				'HOOK_SLIDESHOW' => ''
			);
			
			$ps = LeoThemeInfo::onProcessHookTop( $ps );
			$smarty->assign( $ps );
			
		
		}
		
		return false;
	}		
	
	function hookHeader(){
		$content_dir = Tools::htmlentitiesutf8('http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__);
		
		$leorespon =  Tools::getValue('leorespon', Configuration::get('leorespon'));
		$output = '';
		if( $leorespon ){
			$output = '<link rel="stylesheet" type="text/css" href="'.$content_dir.'themes/'._THEME_NAME_.'/css/responsive.css" >';
		}
		$output .= ' <style>
			#page .leo-wrapper{ max-width:'.Tools::getValue('templatewidth', Configuration::get('templatewidth',"940px")).'}
			</style>';
		return $output;		
	}
}
