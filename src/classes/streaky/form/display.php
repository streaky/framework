<?php

namespace streaky\form;

use streaky\template\template as tpl;

class displayException extends \Exception {}

class display {
	
	private static $form_added = false;
	
	/**
	 * @var \streaky\form\element\form
	 */
	private $form = null;
	
	public function __construct(\streaky\form\element\form $form) {
		if(self::$form_added == false) {
			tpl::addPath(__DIR__."/templates/");
			self::$form_added = true;
		}
		$this->form = $form;
	}
	
	public function getHtml() {
		
		$validate = validate::getValidationItems($this->form->validate);
		$class = $this->form->validate;
		
		$extra = array();
		$items = "";
		$fid = $this->form->id;
		foreach($this->form->items as $item) {
			if(!$item instanceof \streaky\form\element\base\element) {
				throw new displayException('Form item must be a subclass of \streaky\form\base\element');
			}
			if(trim($item->id) == "") {
				$item->id = "{$fid}-{$item->name}";
			}
			if(count($item->extra) > 0) {
				$extra[$item->name] = (array) $item->extra;
			}
			
			$items .= $item->getHtml($this->form, $validate);
		}
		tpl::assign("form-autocomplete", ($this->form->autocomplete == false ? " autocomplete='off'" : ""));
		tpl::assign("form-items", $items);
		tpl::assign("form-id", $this->form->id);
		tpl::assign("form-validate-url", $this->form->validate_url);
		tpl::assign("form-method", $this->form->method);
		tpl::assign("form-action", $this->form->action);
		tpl::assign("form-items-extra", json_encode($extra));
		
		$buttons = "";
		if(count($this->form->buttons) > 0) {
			foreach($this->form->buttons as $button) {
				$buttons .= $button->getHtml();
			}
			tpl::assign("buttons", $buttons);
			$buttons = tpl::fetch("ui/buttons-outer.php");
		}
		tpl::assign("buttons", $buttons);
		
		return tpl::fetch("ui/form.php");
	}
}
