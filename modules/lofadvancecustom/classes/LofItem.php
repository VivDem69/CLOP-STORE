<?php

class LofItem extends ObjectModel {
 	/** @var string Name */
 	public 		$id;
	public 		$id_loffc_block_item;
	
	public  	$id_loffc_block;
	public 		$type;
	public 		$linktype;
	public 		$link_content;
	public 		$module_name;
	public 		$hook_name;
	public 		$latitude;
	public 		$longitude;
	public 		$addthis;
	public 		$show_title=1;
	public		$target;
	public		$position;
	
	public		$title;
	public		$text;
	
	
	protected 	$table = 'loffc_block_item';
	protected 	$identifier = 'id_loffc_block_item';
	
	protected	$fieldsValidate = array('id_loffc_block_item' => 'isUnsignedId', 'id_loffc_block' => 'isUnsignedId', 'linktype' => 'isGenericName',  'link_content' => 'isGenericName', 'module_name' => 'isGenericName',
				'hook_name' => 'isGenericName','latitude' => 'isGenericName','longitude' => 'isGenericName','addthis' => 'isBool', 'position'=>'isUnsignedId', 'show_title'=>'isUnsignedId', 'type'=>'isGenericName', 'target'=>'isString');
	
	protected	$fieldsSizeLang = array('title' => 255);	
	protected	$fieldsRequiredLang = array('title');
	protected 	$fieldsValidateLang = array('title' => 'isGenericName', 'text' => 'isString');
	
	public function getFields(){
		parent::validateFields();
		if (isset($this->id))
			$fields['id_loffc_block_item'] = (int)($this->id);
		$fields['id_loffc_block'] = (int)($this->id_loffc_block);
		$fields['type'] = pSQL($this->type);
		$fields['linktype'] = pSQL($this->linktype);
		$fields['link_content'] = pSQL($this->link_content);
		$fields['module_name'] = pSQL($this->module_name);
		$fields['hook_name'] = pSQL($this->hook_name);
		$fields['latitude'] = pSQL($this->latitude);
		$fields['longitude'] = pSQL($this->longitude);
		$fields['show_title'] = (int)($this->show_title);
		$fields['addthis'] = (int)($this->addthis);
		$fields['target'] = pSQL($this->target);
		$fields['position'] = (int)($this->position);
		
		return $fields;
	}
	
	public function getTranslationsFieldsChild() {
		parent::validateFieldsLang();
		$fieldsArray = array('title');
		$fields = array();
		$languages = Language::getLanguages(false);
		$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
		foreach ($languages as $language) {
			$fields[$language['id_lang']]['id_lang'] = (int)($language['id_lang']);
			$fields[$language['id_lang']][$this->identifier] = (int)($this->id);
			$fields[$language['id_lang']]['text'] = (isset($this->text[$language['id_lang']])) ? pSQL($this->text[$language['id_lang']], true) : '';
			foreach ($fieldsArray as $field) {
				if (!Validate::isTableOrIdentifier($field))
					die(Tools::displayError());
				if (isset($this->{$field}[$language['id_lang']]) AND !empty($this->{$field}[$language['id_lang']]))
					$fields[$language['id_lang']][$field] = pSQL($this->{$field}[$language['id_lang']]);
				else
					$fields[$language['id_lang']][$field] = pSQL($this->{$field}[$defaultLanguage]);
			}
		}
		return $fields;
	}
	
	public function add($autodate = true, $nullValues = false){ 
		$this->position = LofItem::getLastPosition((int)$this->id_loffc_block);
		//echo "<pre>".print_r($this->position ,1); die;
		return parent::add($autodate); 
	}
	
	public function update($nullValues = false){
		if (parent::update($nullValues))
			return $this->cleanPositions($this->id_loffc_block);
		return false;
	}
	
	public function delete(){
	 	if (parent::delete())
			return $this->cleanPositions($this->id_loffc_block);
		return false;
	}
	/**
	 * Delete several categories from database
	 *
	 * return boolean Deletion result
	 */
	public function deleteSelection($customfields){
		$return = 1;
		foreach ($customfields AS $id_loffc_block_item){
			$customfield = new LofItem((int)($id_loffc_block_item));
			$return &= $customfield->delete();
		}
		return $return;
	}
	
	public static function getLastPosition($id_loffc_block){
		return (Db::getInstance()->getValue('SELECT MAX(position)+1 FROM `'._DB_PREFIX_.'loffc_block_item` WHERE `id_loffc_block` = '.(int)($id_loffc_block)));
	}
	
	public function updatePosition($way, $position){
		if (!$res = Db::getInstance()->ExecuteS('
			SELECT cp.`id_loffc_block_item`, cp.`position`, cp.`id_loffc_block` 
			FROM `'._DB_PREFIX_.'loffc_block_item` cp
			WHERE cp.`id_loffc_block` = '.(int)$this->id_loffc_block.' 
			ORDER BY cp.`position` ASC'
		))
			return false;
		
		foreach ($res AS $custom_field)
			if ((int)($custom_field['id_loffc_block_item']) == (int)($this->id))
				$movedField = $custom_field;
		
		if (!isset($movedField) || !isset($position))
			return false;
		
		return (Db::getInstance()->Execute('
			UPDATE `'._DB_PREFIX_.'loffc_block_item`
			SET `position`= `position` '.($way ? '- 1' : '+ 1').'
			WHERE `position` 
			'.($way 
				? '> '.(int)($movedField['position']).' AND `position` <= '.(int)($position)
				: '< '.(int)($movedField['position']).' AND `position` >= '.(int)($position)).'
			AND `id_loffc_block`='.(int)($movedField['id_loffc_block']))
		AND Db::getInstance()->Execute('
			UPDATE `'._DB_PREFIX_.'loffc_block_item`
			SET `position` = '.(int)($position).'
			WHERE `id_loffc_block_item` = '.(int)($movedField['id_loffc_block_item']).'
			AND `id_loffc_block`='.(int)($movedField['id_loffc_block'])));
	}
	
	public static function cleanPositions($id_loffc_block) {
		$result = Db::getInstance()->ExecuteS('
		SELECT `id_loffc_block_item`
		FROM `'._DB_PREFIX_.'loffc_block_item`
		WHERE `id_loffc_block` = '.(int)($id_loffc_block).'
		ORDER BY `position`');
		$sizeof = sizeof($result);
		for ($i = 0; $i < $sizeof; ++$i){
			$sql = '
			UPDATE `'._DB_PREFIX_.'loffc_block_item`
			SET `position` = '.(int)($i).'
			WHERE `id_loffc_block` = '.(int)($id_loffc_block).'
			AND `id_loffc_block_item` = '.(int)($result[$i]['id_loffc_block_item']);
			Db::getInstance()->Execute($sql);
		}
		return true;
	}
	
	public static function getFooterItems($id_loffc_block_item = false, $id_loffc_block = false, $active = true){
		$sql = 'SELECT value
				FROM `'._DB_PREFIX_.'loffc_block_item` ll
				LEFT JOIN `'._DB_PREFIX_.'loffc_block_item_lang` lll ON (ll.`id_loffc_block_item` = lll.`id_loffc_block_item`)
				WHERE 1 '.($id_loffc_block_item ? ' AND ll.`id_loffc_block_item` = '.(int)($id_loffc_block_item) : '').($id_loffc_block ? ' AND ll.`id_loffc_block` = '.(int)($id_loffc_block) : '').
				($active ? ' AND ll.`active`='.(int)($active) : '');
				
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
	}
}
?>