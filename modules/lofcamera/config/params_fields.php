<?php

/**
 * Defined fields for LOFXParams 
 * 
 * ** For define custom field :
 * Create function with name follow this rule : get<Element>Field with param $field e.g: function getCategoriesField($field) {}
 * $field : is an array and contain element same with xml, for example :
 * 
 * if xml field is : <field type="text" name="test" default="1" label="This is test" class="this-is-test" />
 * we'll get $field information like this : array('type' => "text", 'name' => 'test' .... and so on...
 * 
 * * If you want to create custom style then you just create a css file and push to /config/css folder, do same with javascript file.
 * * No need to hard code because every media file in css and js folder will be call from system.
 */
class LOFParamsField {

    function __construct($obj = null) {
        $this->config = $obj;
    }

    /*     * *********************************** BASIC FIELDS *************************************************** */

    function getFieldLang($field, $type='text') {
        $html = '';
        $origin_name = $field['name'];
        $fieldObect = 'get' . ucfirst(trim($type)) . 'Field';
        if (count($this->config->languages)) {
            foreach ($this->config->languages as $lang) {
                $field['name'] = $origin_name . $lang['id_lang'];
                $field['value'] = $this->config->get($field['name']);
                $element = $this->{$fieldObect}($field);        
                $html .= $this->config->languageBlock($lang['id_lang'], $element);
            }
            $html .= $this->config->displayFlags();
        } else {
            $html = 'Not any language available !';
        }
        return $html;
    }

    function getTextField($field) {
        return '<input type="text" id="input_' . $field['name'] . '" ' . $field['attr'] . ' name="' . $field['name'] . '" value="' . $field['value'] . '" />';
    }

    function getTextareaField($field) {
        return '<textarea ' . $field['attr'] . ' cols="' . $field['cols'] . '" rows="' . $field['rows'] . '" id="' . $field['name'] . '" name="' . $field['name'] . '">' . $field['value'] . '</textarea>';
    }

    function getListField($field) {
        if($field['multi']) {
            $field['name'] .= '[]';
            $values = explode(',', $field['value']);
            $field['attr'] .= ' multiple="multiple" size="'.  count($field['options']).'" ';
        }
        $html = '<select name="' . $field['name'] . '" ' . $field['attr'] . ' >';
        foreach ($field['options'] as $opt) {
            if($field['multi']) {
                $selected = in_array($opt['value'], $values) ? 'selected="selected"' : ''; 
            } else {
                $selected = $opt['value'] == $field['value'] ? 'selected="selected"' : '';
            }
            
            $html .= '<option value="' . $opt['value'] . '" ' . $selected . ' >' . $opt['text'] . '</option>';
        }
        $html .= '</select>';

        return $html;
    }

    function getThemeField($field) {
        $path = _PS_ROOT_DIR_ . '/modules/' . $this->config->module . '/themes/';
        $folders = $this->getFolderList($path);
        $options = array();
        foreach ($folders as $folder) {
            $options[] = array('text' => ucfirst($folder), 'value' => $folder);
        }
        $field['options'] = $options;
        return $this->getListField($field);
    }

    private function getFolderList($path) {
        $items = array();
        $handle = opendir($path);
        if (!$handle) {
            return $items;
        }
        while (false !== ($file = readdir($handle))) {
            if (is_dir($path . $file))
                $items[$file] = $file;
        }
        unset($items['.'], $items['..'], $items['.svn']);
        return $items;
    }

}
