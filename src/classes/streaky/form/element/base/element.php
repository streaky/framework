<?php

namespace streaky\form\element\base;

class elementException extends \Exception {}

class element {
	
	/**
	 * @var string Optional form element ID - if this is not set it will be auto-generated from the form ID and the input name
	 */
	public $id;
	
	/**
	 * @var string
	 */
	public $label;
	
	/**
	 * @var string
	 */
	public $name;
	
	/**
	 * @var string
	 */
	public $help = "";
	
	/**
	 * @var array
	 */
	public $classes_outer = array();
	
	/**
	 * @var array
	 */
	public $classes_input = array();
	
	/**
	 * @var array
	 */
	public $extra = array();
	
	/**
	 * @var string Value of the form item
	 */
	public $value = "";
	
	/**
	 * @var \streaky\form\validate\response
	 */
	public $message = false;
	
	/**
	 * @var Boolean True if the form element is required to be filled in
	 */
	public $required = false;
	
	protected $validate = false;
	
	public function __construct() {
		throw new inputException("Elements can't be directly created, must use a subclass");
	}
	
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
		
		\tpl::assign("item-id", $this->id);
		\tpl::assign("item-value", $this->value);
		\tpl::assign("item-label", $this->label);
		\tpl::assign("item-name", $this->name);
		\tpl::assign("item-help", $this->help);
		\tpl::assign("item-type", $this->type);
		\tpl::assign("item-placeholder", $this->placeholder);
		\tpl::assign("item-outer-classes", implode(" ", $this->classes_outer));
		\tpl::assign("item-input-classes", implode(" ", $this->classes_input));
		return \tpl::fetch("ui/input.php");
	}
	
	public function validate() {
		
	}
	
	/**
	 * Reset the item to a blank state without messages, classes, and an empty value 
	 */
	public function reset() {
		$this->value = "";
		$this->classes_input = array();
		$this->classes_outer = array();
		$this->message = false;
	}
}
