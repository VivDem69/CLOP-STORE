<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class LOFXParams {

    protected $xmlObject = null;
    protected $errors = array();
    public $warning = array();
    public $baseurl = '';
    protected $information = array();
    protected $specialParams = array();
    public $css = array();
    public $js = array();
    public $beforeUpdate = '';
    public $afterUpdate = '';
    public $beforeDisplayForm = '';
    public $afterDisplayForm = '';

    function __construct($module) {
        ini_set('error_reporting', E_ALL);

        $filename = _PS_MODULE_DIR_ . $module->name . '/config/params.xml';

        if (file_exists($filename)) {
            $this->xmlObject = simplexml_load_file($filename);
            global $cookie;

            $this->getInfo();
            $this->module = $module->name;
            $this->moduleObj = $module;
            $this->root_url = __PS_BASE_URI__ . "modules/" . $this->module . "/config/";
            $this->root_dir = _PS_MODULE_DIR_ . $this->module . '/config/';
            $this->languages = Language::getLanguages();
            $this->defaultLang = isset($cookie->id_lang) ? $cookie->id_lang : 1;
            $this->fieldsCretor = 'LOFParamsField';

            $this->limitChars = 32 - strlen($this->module);

            //require defined standard field method :
            if (!class_exists('LOFParamsField')) {
                require_once $this->root_dir . 'params_fields.php';
            }

            $fieldCustom = 'LOFParamsField' . ucfirst($this->module);
            //require defined custom field method :
            if (!class_exists($fieldCustom) && file_exists($this->root_dir . 'custom_fields.php')) {
                require_once $this->root_dir . 'custom_fields.php';
                $this->fieldsCretor = $fieldCustom;
            }
            
            //generate register translation keys :
            $this->generateLang();
            
        } else {
            $this->setError('File ' . $filename . ' does not exist !');
        }
    }

    function getHeader() {
        $css = $this->getFilesFromFolder($this->root_dir . 'css/');
        $js = $this->getFilesFromFolder($this->root_dir . 'js/');
        $output = '';

        //push css files :
        if (count($css)) {
            foreach ($css as $css_filename) {
                $output .= '<link rel="stylesheet" href="' . $this->root_url . '/css/' . $css_filename . '" type="text/css" media="screen" charset="utf-8" />';
            }
        }

        //push javascript files :        
        if (count($js)) {
            foreach ($js as $js_filename) {
                $output .= '<script type="text/javascript" src="' . $this->root_url . '/js/' . $js_filename . '"></script>';
            }
        }

        return $output;
    }

    /**
     * 
     * convert simple xml object to array
     * @return Array 
     */
    function getInfo() {
        $info = array();
        $k = 0;
        foreach ($this->xmlObject->configuration->children() as $object) {
            $block = $this->getArrayAttributes($object);
            $info[$k]['label'] = $block['label'];
            foreach ($object->children() as $objTheme) {
                $theme = $this->getArrayAttributes($objTheme);

                if (count($objTheme->children())) {
                    $options = array();
                    foreach ($objTheme->children() as $objOption) {
                        $options[] = $this->getArrayAttributes($objOption);
                    }
                    $theme['options'] = $options;
                }

                $info[$k]['fields'][] = $theme;
            }
            $k++;
        }
        $this->information = $info;
        return $info;
    }

    /**
     *
     * display params form 
     * @return HTML
     */
    function displayForm() {
        $html = '';
        $fieldsets = $this->getInfo();        

        ob_start();
        require $this->root_dir . "params_lang.php";
        require $this->root_dir . 'form.php';
        $form = ob_get_contents();
        ob_clean();

        $html .= $this->displayErrors();
        $html .= $this->displayWarning();
        $html .= $this->getHeader();
        $html .= $form;

        return $html;
    }

    function displayWarning() {
        $html = '<ul class="warning_report">';
        foreach ($this->warning as $warn) {
            $html .= '<li>' . $warn . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    function getParamsName() {
        $params = array();
        $form = $this->getInfo();
        foreach ($form as $fieldsets) {
            foreach ($fieldsets['fields'] as $field) {
                $params[$field['name']] = $field;
            }
        }
        return $params;
    }

    function get($name, $default='', $lang = null) {
        $fields = $this->getParamsName();
        $xmlDefault = isset($fields[$name]['default']) ? $fields[$name]['default'] : '';
        $default = $xmlDefault ? $xmlDefault : $default;
        $name = $this->getName($name);

        if ($lang) {
            $name = $name . $lang;
        }

        return Configuration::get($name) != '' ? htmlentities(Configuration::get($name), ENT_COMPAT, 'UTF-8') : $default;
    }

    function save($name) {
        $name = $this->getName($name);

        if (in_array($name, $this->specialParams)) {
            $value = $_POST[$name];
        } else {
            $value = Tools::getValue($name);
        }
        //for multiple params :
        if (is_array($value)) {
            $value = implode(',', $value);
        }
        Configuration::updateValue($name, $value, true);
    }

    function saveTranslatable($name) {
        foreach ($this->languages as $lang) {
            $langName = $name . $lang['id_lang'];
            $this->save($langName);
        }
    }

    function updateWithSubfix($name, $subfixs=array()) {
        if (count($subfixs)) {
            foreach ($subfixs as $subname) {
                $langName = $name . '_' . $subname;
                $this->save($langName);
            }
        }
    }

    function checkName($name) {
        if (strlen($name) > 32) {
            $this->warning[] = $name . ' is too long name.';
        }
        return $name;
    }

    /**
     * ********** UPDATE CONFIGURATION ****************
     */
    function update() {

        // ============= Hook before update =================
        $this->callHook($this->beforeUpdate);

        //$this->debug($this->getParamsName());
        foreach ($this->getParamsName() as $config => $field) {

            if (isset($field['translate']) && $field['translate']) {
                $this->saveTranslatable($config);
            } else {
                $this->save($config);
            }
        }
        $this->callHook($this->afterUpdate);
    }

    //convert attributes to array :
    function getArrayAttributes($object) {
        $res = array();
        foreach ($object->attributes() as $key => $val) {
            $res[(string) $key] = (string) $val;
        }
        return $res;
    }

    function setError($error) {
        $this->errors[] = $error;
    }

    function hasError() {
        return count($this->errors);
    }

    function getErrorMsg() {
        return implode('<br />', $this->errors);
    }

    function displayErrors() {
        $html = '';
        if ($this->hasError()) {
            $html .= '<ul class="lofparams_errors">';
            foreach ($this->errors as $error) {
                $html .= '<li>' . $error . '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    function callHook($name) {
        if ($name != '' && method_exists($this->moduleObj, $name)) {
            return $this->moduleObj->{$name}();
        }
    }

    function getName($name, $check = false) {
        $nameOrigin = str_replace($this->module . '_', '', $name);
        $name = $this->module . '_' . $nameOrigin;
        if ($check) {
            if (strlen($name) > 32) {
                $this->errors[] = $nameOrigin . ' is too long name, You must named it less than ' . $this->limitChars . ' character.';
                return false;
            } else {
                return $name;
            }
        }

        return $name;
    }

    public function hook($position, $name) {
        $this->$position = $name;
    }

    /**
     * Clean all module params from database 
     */
    function clean() {
        if ($this->module != '' && is_string($this->module) && class_exists($this->module)) {
            $query = 'SELECT name FROM ' . _DB_PREFIX_ . 'configuration WHERE name like "%' . $this->module . '%"';
            $params = Db::getInstance()->ExecuteS($query);
            if (count($params)) {
                foreach ($params as $param) {
                    Configuration::deleteByName($param['name']);
                }
            }
        }
    }

    function toHtml($field) {
        $field = $this->makeSafeField($field);

        $fieldCreator = $this->fieldsCretor;
        $field['value'] = $this->get($field['name'], $field['default']);
        $field['name'] = $this->getName($field['name'], true);

        $html = '<label for="' . $field['name'] . '">' . $this->moduleObj->l($field['label'], 'params_lang') .
                '<br /> <span class="params_desc">' . $this->moduleObj->l($field['description'], 'params_lang') . '</span></label>';
        $objHtml = new $fieldCreator($this);
        $element = 'get' . ucfirst($field['type']) . 'Field';
        if ($field['name']) {
            if (isset($field['translate']) && $field['translate']) {
                $html .= $objHtml->getFieldLang($field, $field['type']);
            } else {
                $html .= $objHtml->{$element}($field);
            }
        } else {
            $html .= '<span class="invalid-name">- Long name -</span>';
        }

        return $html;
    }

    function getFilesFromFolder($path) {
        $items = array();
        $handle = opendir($path);
        if (!$handle) {
            return $items;
        }
        while (false !== ($file = readdir($handle))) {
            if ($this->isValidFile($file)) {
                $items[] = $file;
            }
        }
        return $items;
    }

    function isValidFile($file, $allowed=array('css', 'js', 'php'), $disallowed=array('.', '..', '.svn')) {
        if (!is_dir($file) && !in_array($file, $disallowed)) {
            $ext = preg_replace('/^.*\./', '', $file);
            if (in_array($ext, $allowed)) {
                return true;
            } else
                return false;
        } else {
            return false;
        }
    }

    function getValues() {
        $lang=null;
        $names = $this->getParamsName();
        $values = array();

        if (count($names)) {
            foreach ($names as $name => $field) {
                $field = $this->makeSafeField($field);
                if (intval($field['translate']) > 0) {
                    $lang = $this->defaultLang;                    
                } else {
                    $lang = null;
                }
                
                $values[$name] = $this->get($name, $field['default'], $lang);
            }
        }
        return $values;
    }

    function languageBlock($id, $element='') {
        return '<div class="info_lang lang_' . $id . '"  >' . $element . '</div>';
    }

    public function displayFlags($id='', $use_vars_instead_of_ids = false) {
        global $cookie;
        $defaultLang = intval($cookie->id_lang);
        if ($id == '')
            $id = $defaultLang;
        $languages = Language::getLanguages(true);
        if (sizeof($languages) == 1)
            return false;
        $output = '<div class="lof_flag" style="position:relative; float:left; width: 1px;">
		<div class="displayed_flag">
			<img src="../img/l/' . $defaultLang . '.jpg" class="pointer" id="language_current_' . $id . '" onclick="toggleLanguageFlags(this);" alt="" />
		</div>
		<div id="languages_' . $id . '" class="language_flags">';
        foreach ($languages as $language) {
            $output .= '<img src="../img/l/' . (int) ($language['id_lang']) . '.jpg" class="pointer" alt="' . $language['name'] . '" title="' . $language['name'] . '" onClick="changeToLanguage(\'' . $language['id_lang'] . '\'); " />';
        }

        $output .= '</div></div>';

        return $output;
    }

    function debug($var) {
        echo '============================ START DEBUG ==========================<br />';
        if (is_string($var) || is_null($var)) {
            echo '====| ' . $var . ' |====<br />';
        } else {
            echo '<pre>';
            print_r($var);
            echo '</pre>';
        }

        echo '============================ END DEBUG ==========================<br />';
        die();
    }

    function makeSafeField($field) {
        if (!isset($field['description']))
            $field['description'] = '';
        if (!isset($field['translate']))
            $field['translate'] = 0;
        if (!isset($field['multi']))
            $field['multi'] = 0;
        if (!isset($field['attr']))
            $field['attr'] = '';
        if (!isset($field['default']))
            $field['default'] = '';
        if (!isset($field['class']))
            $field['class'] = '';

        return $field;
    }

    /**
     * -------------- STUPID ---------------------
     */
    function generateLang() {
        $langRegister = array();
        $fieldset = $this->getInfo();
        
        //for stupid regex :
        $translate = '$this->moduleObj->l';
                
        if(count($fieldset)) {
            foreach ($fieldset as $tab){
                $langRegister[] = $translate."('".$tab['label']."');";
                foreach ($tab['fields'] as $param) {
                    $param = $this->makeSafeField($param);
                    if($param['label']) $langRegister[] = $translate."('".$param['label']."');";
                    if($param['description']) $langRegister[] = $translate."('".  str_replace("'", '', $param['description'])."');";
                }
            }
        }
        
        //ok, write down :
        $errorLogFile = $this->root_dir . "params_lang.php";
        $fh = fopen($errorLogFile, 'w') or die("can't open file");
        $space = "\r\n";
        $string = '<?php '.$space.implode($space, $langRegister).$space.' ?>';
        fwrite($fh, $string);
        fclose($fh);
    }
    
    

}