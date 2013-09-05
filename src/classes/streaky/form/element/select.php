<?php

namespace streaky\form\element;

class selectException extends \Exception {}

class select extends base\element {
	
	public $options = array();
	
	/**
	 * @var bool Enforce selection to an option (prevent people sending shady data to the application)
	 * 
	 * You'll want to usually leave this true - if you want to let people add their own data why are you using a select box?
	 */
	public $enforce = true;
	
	/**
	 * Disable the base\element constructor 
	 */
	public function __construct() {}
	
	public function getHtml(&$form, &$validate) {
		if(trim($this->id) == "") {
			$item->id = "{$form->id}-{$this->name}";
		}
		
		\tpl::assign("item-id", $this->id);
		
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
		
		$message = "";
		if($this->message != false && $this->message->message != "") {
			\tpl::assign("popover-message", $this->message->message);
			switch($this->message->error) {
				case \streaky\form\validate\response::ok;
					\tpl::assign("popover-classes", "icon icon-ok-sign");
				break;
				case \streaky\form\validate\response::info;
					\tpl::assign("popover-classes", "icon icon-info-sign");
				break;
				case \streaky\form\validate\response::warn;
					\tpl::assign("popover-classes", "icon icon-warning-sign");
				break;
				case \streaky\form\validate\response::error;
					\tpl::assign("popover-classes", "icon icon-exclamation-sign");
				break;
			}
			$message = \tpl::fetch("ui/popover.php");
		}
		\tpl::append("form-messages", $message);
		
		\tpl::assign("select-options", $options);
		
		\tpl::assign("item-value", $this->value);
		\tpl::assign("item-label", $this->label);
		\tpl::assign("item-name", $this->name);
		\tpl::assign("item-help", $this->help);
		\tpl::assign("item-outer-classes", implode(" ", $this->classes_outer));
		\tpl::assign("item-input-classes", implode(" ", $this->classes_input));
		return \tpl::fetch("ui/select.php");
	}
}
