<?php

namespace streaky\form\element;

class buttonException extends \Exception {}

class button {
	
	/**
	 * @var string Optional form element ID - if this is not set it will be auto-generated from the form ID and the input name
	 */
	public $id;
	
	/**
	 * @var string
	 */
	public $title;
	
	/**
	 * @var string
	 */
	public $type = "submit";
	
	/**
	 * @var array
	 */
	public $classes = array();
	
	public function getHtml(/*&$form, &$validate*/) {
		if(trim($this->id) == "") {
			//$item->id = "{$form->id}-{$this->name}";
		}
		
		\tpl::assign("button-id", $this->id);
		\tpl::assign("button-title", $this->title);
		\tpl::assign("button-type", $this->type);
		\tpl::assign("button-classes", implode(" ", $this->classes));
		return \tpl::fetch("ui/button.php");
	}
}