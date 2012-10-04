<?php

class LofBlock extends ObjectModel
{
	public 		$id;
	public 		$id_loffc_block;
	public		$width;
	public		$show_title=1;
	public		$id_position;
	
	public		$title;
	
	protected 	$table = 'loffc_block';
	protected 	$identifier = 'id_loffc_block';
	
	protected	$fieldsValidate = array('width' => 'isFloat','show_title' => 'isUnsignedId', 'id_position' => 'isUnsignedId');
	
	protected 	$fieldsRequiredLang = array('title');
 	protected 	$fieldsSizeLang = array('title' => 255);
 	protected 	$fieldsValidateLang = array('title' => 'isGenericName');
	
	public function getFields() {
		parent::validateFields();
		if (isset($this->id))
			$fields['id_loffc_block'] = (int)($this->id);
		
		$fields['width'] = (float)($this->width);
		$fields['show_title'] = (int)($this->show_title);
		$fields['id_position'] = (int)($this->id_position);
		
		return $fields;
	}
	
	public function getTranslationsFieldsChild() {
		parent::validateFieldsLang();
		return parent::getTranslationsFields(array('title'));
	}
	
	public function add($autodate = true, $nullValues = false){ 
		return parent::add($autodate, false); 
	}
	
	public function update($nullValues = false){
		return parent::update($nullValues);
	}
	
	public function delete(){
		global $cookie;
		$id_loffc_block = $this->id;
		$return = true;
	 	if (parent::delete()){
			$items = self::getItems($id_loffc_block, $cookie->id_lang);
			if($items){
				foreach($items as $i){
					$obj = new LofItem($i['id_loffc_block_item']);
					$return &= $obj->delete();
				}
			}
		}else{
			$return &= false;
		}
		return $return;
	}
	
	public static function getBlocks( $id_position = false, $id_lang ) {
		return Db::getInstance()->ExecuteS('
		SELECT fl.*, fll.`title` 
		FROM `'._DB_PREFIX_.'loffc_block` fl
		LEFT JOIN `'._DB_PREFIX_.'loffc_block_lang` fll ON(fll.id_loffc_block = fl.id_loffc_block AND fll.`id_lang` = '.(int)($id_lang).')
		WHERE 1 '.($id_position ? ' AND fl.`id_position` = '.(int)($id_position) : '').' 
		ORDER BY fl.`id_loffc_block` ASC' );
	}
	
	
	public static function getItems( $id_loffc_block, $id_lang){
		$results = Db::getInstance()->ExecuteS('
		SELECT *
		FROM `'._DB_PREFIX_.'loffc_block_item` bi
		LEFT JOIN `'._DB_PREFIX_.'loffc_block_item_lang` bil ON(bi.`id_loffc_block_item` = bil.`id_loffc_block_item` AND bil.`id_lang` = '.(int)($id_lang).')
		WHERE bi.`id_loffc_block`='.(int)$id_loffc_block.'
		ORDER BY bi.`position` ASC ');
		
		return $results; 
	}
	
}


