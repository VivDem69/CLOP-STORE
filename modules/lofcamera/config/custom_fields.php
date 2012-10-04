<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class LOFParamsFieldLofcamera extends LOFParamsField {

    function getImageuploadField($field) {
        if ($field['multi']) {
            $name = $field['name'] . '[]';
            $multi = 'multiple="1"';
        }

        $html = '<input class="' . $field['class'] . '" onChange="' . $field['change'] . '" type="file" name="' . $name . '" id="' . $field['name'] . '" ' . $multi . ' />';
        $html .= '<fieldset>
                    <legend>Files Selected</legend>
                    <ul id="upload_list"><li><span>Please select some image ("Ctrl + left click" on image to select multiple image)</span></li></ul>    
                </fieldset>';

        return $html;
    }

    function getImageeditField($field) {

        $images = $this->getImages();
        $html = 'No image found !';
        $languages = Language::getLanguages();

        if (count($languages)) {
            $html = '';
            global $cookie;

            $html .= $this->config->displayFlags();

            foreach ($languages as $lang) {
                $html .= '<div class="info_lang lang_' . $lang['id_lang'] . '"  >';

                if (count($images)) {
                    $properties = explode(',', $field['properties']);
                    $labels = explode(',', $field['labels']);
                    foreach ($images as $k => $imgname) {
                        if (count($properties)) {
                            $html .= '<div class="image-edit-field">';
                            $html .= '<div class="edit-field-left" >
                                <img src="' . LOF_SIMPLE_SLIDE_URI_IMAGES_THUMB . $imgname . '" /> 
                                    <div class="check_remove"><input onClick="selectImage(this);" type="checkbox" name="remove_images[]" value="' . $imgname . '" />Delete</div>
                              </div>';
                            $html .= '<div class="edit-field-right">';
                            foreach ($properties as $i => $property) {
                                $labeltext = trim($labels[$i]) ? trim($labels[$i]) : ucfirst(trim($property));
                                $fullname = $this->config->checkName($field['name'] . $lang['id_lang'] . '_' . $k . '_' . trim($property));
                                if (trim($property) != 'image') {
                                    $html .= '<label >' . $labeltext . '</label>';
                                    if (trim($property) == 'desc') {
                                        $html .= '<textarea name="' . $fullname . '" cols="70" rows="5" >' . $this->config->get($fullname) . '</textarea>';
                                    } else {
                                        $html .= '<input type="text" name="' . $fullname . '" value="' . $this->config->get($fullname) . '" />';
                                    }

                                    $html .= '<div class="clearfix"></div>';
                                } else {
                                    $html .= '<input type="hidden" name="' . $fullname . '" value="' . $imgname . '" />';
                                }
                            }
                            $html .= '</div>';
                            $html .= '</div>';
                        }
                    }
                }
                $html .= '</div>';
            }
            $html .= '<script type="text/javascript">changeToLanguage("' . $cookie->id_lang . '");</script>';
        }

        return $html;
    }

    function getImages($path='') {
        $items = array();
        if ($path) {
            $handle = opendir($path);
        } else {
            $handle = opendir(LOF_SIMPLE_SLIDE_IMAGES_THUMB);
        }

        if (!$handle) {
            return $items;
        }
        while (false !== ($file = readdir($handle))) {
            if ($this->isItemImage($file)) {
                $items[] = $file;
            }
        }
        return $items;
    }

    function isItemImage($file, $disallowed=array('.', '..', '.svn')) {
        $allowed = array('jpg', 'png', 'gif', 'jpeg');
        if (!is_dir($file) && !in_array($file, $disallowed)) {
            $ext = strtolower(preg_replace('/^.*\./', '', $file));
            if (in_array($ext, $allowed)) {
                return true;
            } else
                return false;
        } else {
            return false;
        }
    }

}