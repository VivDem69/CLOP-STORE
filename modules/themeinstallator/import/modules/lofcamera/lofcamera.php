<?php

/*
 * 2011 LandOfCoder
 *
 *  @author LandOfCoder 
 *  @copyright  2011 LandOfCoder
 *  @version  Release: $Revision: 1.0 $
 *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

if (!defined('_PS_VERSION_'))
    exit;
require_once(_PS_MODULE_DIR_ . "lofcamera/defined.php");
if (!class_exists('LOFXParams')) {
    require LOF_SIMPLE_SLIDE_ROOT . 'config/params.php';
}

if (!class_exists('PhpThumbFactory')) {
    require LOF_SIMPLE_SLIDE_LIB . 'phpthumb/ThumbLib.inc.php';
}

class lofcamera extends Module {
    /* @var boolean error */

    protected $error = false;
    private $_postErrors = array();
    public $allowedUpload = array("jpg", "bmp", "gif", "png");

    public function __construct() {
        $this->name = 'lofcamera';
        $this->tab = 'Landofcoder';
        $this->version = '1.0.0';
        $this->author = 'LandOfCoder';
        $this->need_instance = 0;
        $this->params = new LOFXParams($this);

        parent::__construct();
        $this->displayName = $this->l('Lof Camera Slideshow');
        $this->description = $this->l('Simply - Useful - smoothly, It is slideshow ');
        $this->confirmUninstall = $this->l('Do you want to uninstall Lof simple slideshow');
    }

    public function install() {
        if (parent::install() == false
                OR !$this->registerHook('header')
                OR !$this->registerHook('home', true)
        )
            return false;
        return true;
    }

    public function uninstall() {

        //clean all module's params from database :
        $this->params->clean();
        if (!parent::uninstall())
            return false;
        return true;
    }

    function hookHeader() {

        $theme_assets = LOF_SIMPLE_SLIDE_URI_THEMES . $this->params->get('template', 'default') . '/assets/';
        if (_PS_VERSION_ <= "1.4") {
            $header .= $this->linkMedia(LOF_SIMPLE_SLIDE_URI_CSS . 'lofsimpleslide.css');
            $header .= $this->linkMedia(LOF_SIMPLE_SLIDE_URI_CSS . 'slide.camera.css');
            $header .= $this->linkMedia(LOF_SIMPLE_SLIDE_URI_CSS . 'slide.camera.js', 'js');
            $header .= $this->linkMedia($theme_assets . 'styles.css');

            return $header;
        } else {
            Tools::addCSS(LOF_SIMPLE_SLIDE_URI_CSS . 'lofsimpleslide.css');
            Tools::addCSS(LOF_SIMPLE_SLIDE_URI_CSS . 'slide.camera.css');
            Tools::addCSS($theme_assets . 'styles.css');
            Tools::addJS(LOF_SIMPLE_SLIDE_URI_JS . 'slide.camera.js');
        }
    }

    function hookhome($params) {
        return $this->processHook($params, 'home');
    }

    function hookTop($params) {
        return $this->processHook($params, 'top');
    }

    function hookleftColumn($params) {
        return $this->processHook($params, 'left');
    }

    function hookrightColumn($params) {
        return $this->processHook($params, 'right');
    }

    function hooklofslide1($params) {
        return $this->processHook($params, "lofslide1");
    }

    function hooklofslide2($params) {
        return $this->processHook($params, "lofslide2");
    }

    function hooklofslide3($params) {
        return $this->processHook($params, "lofslide3");
    }

    function hooklofslide4($params) {
        return $this->processHook($params, "lofslide4");
    }

    function processHook($params = array(), $hook = '') {

        $this->hookname = 'lofcamera_' . $hook;

        ob_start();
        require LOF_SIMPLE_SLIDE_ROOT . 'initjs.php';
        $slideSettings = ob_get_contents();
        ob_clean();

        //render slide configuration :
        //$this->renderSlideConfig();

        global $smarty, $cookie;
        $fieldCreator = new $this->params->fieldsCretor();

        $images = $fieldCreator->getImages(LOF_SIMPLE_SLIDE_IMAGES_PRIMARY);
        $params = $this->params->getValues();

        $container_style = 'width : ' . $params['modWidth'] . ';';

        //create images information :
        foreach ($images as $k => $img) {
            $basename = 'slide' . $cookie->id_lang . '_' . $k . '_';
            $image = array(
                'title' => $this->params->get($basename . 'title'),
                'desc' => $this->params->get($basename . 'desc'),
                'price' => $this->params->get($basename . 'price'),
                'link' => $this->addhttp($this->params->get($basename . 'link')), 
                'name' => $img,
            );
            $images[$k] = $image;
        }

        $smarty->assign(array(
            'images' => $images,
            'image_uri' => LOF_SIMPLE_SLIDE_URI_IMAGES_PRIMARY,
            'thumb_uri' => LOF_SIMPLE_SLIDE_URI_IMAGES_THUMB,
            'lofcameraParams' => $params,
            'hookname' => $this->hookname,
            'container_style' => $container_style
        ));

        return $this->display(__FILE__, $this->getLayoutPath()) . $slideSettings;
    }

    public function getLayoutPath() {
        $theme = $this->params->get('template', 'default');
        $layout = 'themes/' . $theme . '/default.tpl';
        if (!file_exists(__FILE__ . "/" . $layout)) {
            return $layout;
        }
    }

    /**
     * Render processing form && process saving data.
     */
    public function getContent() {

        $html = "";
        if (Tools::isSubmit('submit')) {
            $this->_postValidation();
            if (is_array($this->_postErrors) && !count($this->_postErrors)) {
                $this->params->hook('beforeUpdate', 'firstUpdate');
                $this->params->update();
                $html .= '<div class="conf confirm">' . $this->l('Settings updated') . '</div>';
            }
        }
        if ($this->params->hasError())
            die($this->params->getErrorMsg());

        $this->params->hook('afterDisplayForm', 'moduleInformation');
        return $html . $this->params->displayForm();
    }

    /**
     * Process vadiation before saving data 
     */
    private function _postValidation() {
        
    }

    function firstUpdate() {
        $this->uploadImages();
        $this->updateImagesInfo();
        $this->removeSelectedImages();
    }

    function uploadImages() {

        $files = $_FILES[$this->params->getName('img_uploader')];
        if (is_array($files['name']) && count($files['name']) && $files['name'][0] != '') {

            $imageWidth = $this->params->get('image_width', 600);
            $imageHeight = $this->params->get('image_height', 200);
            $thumbWidth = $this->params->get('thumb_width', 150);
            $thumbHeight = $this->params->get('thumb_height', 100);

            for ($i = 0; $i < count($files['name']); $i++) {
                $file = $files['name'][$i];
                $file_tmp = $files['tmp_name'][$i];

                if (isset($file) && $file != NULL) {
                    $ext = strtolower(substr($file, strrpos($file, '.') + 1));
                    $filename = LOF_SIMPLE_SLIDE_IMAGES_ORIGIN . $file;
                    if (in_array($ext, $this->allowedUpload)) {
                        if (move_uploaded_file($file_tmp, $filename)) {

                            $primayname = LOF_SIMPLE_SLIDE_IMAGES_PRIMARY . $file;
                            //create thumbnail if not exist :                        
                            if (!file_exists($primayname) && file_exists($filename)) {
                                $this->createThumb($filename, $primayname, $imageWidth, $imageHeight);
                            }

                            $thumbname = LOF_SIMPLE_SLIDE_IMAGES_THUMB . $file;
                            //create thumbnail if not exist :                        
                            if (!file_exists($thumbname) && file_exists($filename)) {
                                $this->createThumb($filename, $thumbname, $thumbWidth, $thumbHeight);
                            }

                            //delete origin image :
                            if (file_exists($filename)) {
                                @unlink($filename);
                            }
                        }
                    }
                }
            }
        }
    }

    function updateImagesInfo() {
        $field = new $this->params->fieldsCretor();
        $images = $field->getImages();
        $languages = Language::getLanguages(true);

        foreach ($languages as $lang) {
            foreach ($images as $k => $img) {
                $basename = 'slide' . $lang['id_lang'] . '_' . $k;
                $this->params->save($basename . '_title');
                $this->params->save($basename . '_desc');
                $this->params->save($basename . '_price');
                $this->params->save($basename . '_link');
                $this->params->save($basename . '_image');
            }
        }
    }

    function createThumb($imagePath, $thumbname, $width=100, $height=100) {
        $thumb = PhpThumbFactory::create($imagePath);
        $thumb->adaptiveResize($width, $height);
        $thumb->save($thumbname);
        return true;
    }

    function removeSelectedImages() {
        $images = isset($_POST['remove_images']) ? $_POST['remove_images'] : null;
        if (is_array($images) && count($images)) {
            foreach ($images as $imageName) {
                //remove origin image :
                $filename = LOF_SIMPLE_SLIDE_IMAGES_ORIGIN . $imageName;
                if (file_exists($filename)) {
                    @unlink($filename);
                }

                //remove primay image :
                $imagename = LOF_SIMPLE_SLIDE_IMAGES_PRIMARY . $imageName;
                if (file_exists($imagename)) {
                    @unlink($imagename);
                }

                //remove thumb image :
                $thumbname = LOF_SIMPLE_SLIDE_IMAGES_THUMB . $imageName;
                if (file_exists($thumbname)) {
                    @unlink($thumbname);
                }
            }
        }
    }

    function linkMedia($src, $type='css') {
        if ($type == 'css') {
            return '<link type="text/css" rel="stylesheet" href="' . $src . '" />';
        } else {
            return '<script type="text/javascript" src="' . $src . '"></script>';
        }
    }

    function moduleInformation() {
        $html = '
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, "script", "facebook-jssdk"));</script>
            <div class="module_infor" > 
                <h3>' . $this->l('Information') . '</h3>
                <ul>
                        <li>+ <a target="_blank" href="http://landofcoder.com/prestashop/slider/lof-slideshowpro.html">' . $this->l('Detail Information') . '</li>
                        <li>+ <a target="_blank" href="http://landofcoder.com/supports/forum.html?id=78">' . $this->l('Forum support') . '</a></li>
                        <li>+ <a target="_blank" href="http://www.landofcoder.com/submit-request.html">' . $this->l('Customization/Technical Support Via Email') . '.</a></li>
                        <li>+ <a target="_blank" href="http://landofcoder.com/prestashop/guides/lof-slideshow-pro">' . $this->l('UserGuide ') . '</a></li>
                        <li>+ @Copyright: <a target="_blank" href="http://www.facebook.com/LeoTheme">leotheme.com</a></li>                        
                </ul>
                <div class="social_buttons">
                    <div class="fb-like" data-href="http://www.facebook.com/LeoTheme" data-send="false" data-width="450" data-show-faces="false"></div>
                    <a href="https://twitter.com/leotheme" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @leotheme</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
               </div>
            </div>';
        return $html;
    }

    public function l($string, $specific = false, $id_lang = null) {
        if (self::$_generateConfigXmlMode)
            return $string;

        global $_MODULES, $_MODULE, $cookie;

        if ($id_lang == null)
            $id_lang = (!isset($cookie) OR !is_object($cookie)) ? (int) (Configuration::get('PS_LANG_DEFAULT')) : (int) ($cookie->id_lang);
        $file = _PS_MODULE_DIR_ . $this->name . '/' . Language::getIsoById($id_lang) . '.php';
        if (Tools::file_exists_cache($file) AND include_once($file))
            $_MODULES = !empty($_MODULES) ? array_merge($_MODULES, $_MODULE) : $_MODULE;

        $source = $specific ? $specific : $this->name;
        $string = str_replace('\'', '\\\'', $string);
        $ret = $this->findTranslation($this->name, $string, $source);

        return $ret;
    }

    public static function findTranslation($name, $string, $source) {
        global $_MODULES;

        $cache_key = $name . '|' . $string . '|' . $source;

        if (!isset(self::$l_cache[$cache_key])) {
            if (!is_array($_MODULES))
                return str_replace('"', '&quot;', $string);
            // set array key to lowercase for 1.3 compatibility
            $_MODULES = array_change_key_case($_MODULES);
            $currentKey = '<{' . strtolower($name) . '}' . strtolower(_THEME_NAME_) . '>' . strtolower($source) . '_' . md5($string);
            $defaultKey = '<{' . strtolower($name) . '}prestashop>' . strtolower($source) . '_' . md5($string);

            if (isset($_MODULES[$currentKey]))
                $ret = stripslashes($_MODULES[$currentKey]);
            elseif (isset($_MODULES[Tools::strtolower($currentKey)]))
                $ret = stripslashes($_MODULES[Tools::strtolower($currentKey)]);
            elseif (isset($_MODULES[$defaultKey]))
                $ret = stripslashes($_MODULES[$defaultKey]);
            elseif (isset($_MODULES[Tools::strtolower($defaultKey)]))
                $ret = stripslashes($_MODULES[Tools::strtolower($defaultKey)]);
            else
                $ret = stripslashes($string);

            self::$l_cache[$cache_key] = str_replace('"', '&quot;', $ret);
        }
        return self::$l_cache[$cache_key];
    }

    function addhttp($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url) && $url) {
            $url = "http://" . $url;
        }
        return $url;
    }
	/**
	 * Connect module to a hook
	 *
	 * @param string $hook_name Hook name
	 * @return boolean result
	 */
	public function registerHook($hook_name, $first = false)
	{
		if (!Validate::isHookName($hook_name))
			die(Tools::displayError());
		if (!isset($this->id) OR !is_numeric($this->id))
			return false;

		// Check if already register
		$result = Db::getInstance()->getRow('
		SELECT hm.`id_module` FROM `'._DB_PREFIX_.'hook_module` hm, `'._DB_PREFIX_.'hook` h
		WHERE hm.`id_module` = '.(int)($this->id).'
		AND h.`name` = \''.pSQL($hook_name).'\'
		AND h.`id_hook` = hm.`id_hook`');
		if ($result)
			return true;

		// Get hook id
		$result = Db::getInstance()->getRow('
		SELECT `id_hook`
		FROM `'._DB_PREFIX_.'hook`
		WHERE `name` = \''.pSQL($hook_name).'\'');
		if (!isset($result['id_hook']))
			return false;

		// Get module position in hook
		$result2 = Db::getInstance()->getRow('
		SELECT MAX(`position`) AS position
		FROM `'._DB_PREFIX_.'hook_module`
		WHERE `id_hook` = '.(int)($result['id_hook']));
		if (!$result2)
			return false;

                
                if($first) {
                    $position = 0;
                } else {
                    $position = (int)($result2['position'] + 1);
                }
                
		// Register module in hook
		$return = Db::getInstance()->Execute('
		INSERT INTO `'._DB_PREFIX_.'hook_module` (`id_module`, `id_hook`, `position`)
		VALUES ('.(int)($this->id).', '.(int)($result['id_hook']).', '.$position.')');

		$this->cleanPositions((int)($result['id_hook']));

		return $return;
	}
}
