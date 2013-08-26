<?php

namespace streaky\form\element;

class selectException extends \Exception {}

class select extends base\element {
	
	public $options = array();
	
	/**
	 * Disable the base\element constructor 
	 */
	public function __construct() {}
	
	public function getHtml(&$form, &$validate) {
		if(trim($this->id) == "") {
			$item->id = "{$form->id}-{$this->name}";
		}
		
		if(in_array($this->name, $validate)) {
			$this->classes_input[] = "validate-item";
			$this->validate = true;
		}
		
		if($this->required == true) {
			$this->classes_outer[] = "required";
			if($this->validate == false) {
				$this->classes_input[] = "validate-item";
				$this->validate = true;
			}
		}
		
		$options = "";
		foreach($this->options as $value => $title) {
			$selected = "";
			\tpl::assign("option-value", $value);
			\tpl::assign("option-title", $title);
			if($this->value == $value) {
				$selected = "selected='selected' ";
			}
			\tpl::assign("option-selected", $selected);
			$options .= \tpl::fetch("ui/select-option.php");
		}
		
		\tpl::assign("select-options", $options);
		
		\tpl::assign("item-id", $this->id);
		\tpl::assign("item-value", $this->value);
		\tpl::assign("item-label", $this->label);
		\tpl::assign("item-name", $this->name);
		\tpl::assign("item-help", $this->help);
		//\tpl::assign("item-type", $this->type);
		//\tpl::assign("item-placeholder", $this->placeholder);
		\tpl::assign("item-outer-classes", implode(" ", $this->classes_outer));
		\tpl::assign("item-input-classes", implode(" ", $this->classes_input));
		return \tpl::fetch("ui/select.php");
	}
}
