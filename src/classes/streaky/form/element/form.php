<?php

namespace streaky\form\element;

class formException extends \Exception {}

class form {
	
	/**
	 * @var string
	 */
	public $id;
	
	/**
	 * @var string
	 */
	public $method = "POST";
	
	public $autocomplete = true;
	
	/**
	 * @var string URL to send form to
	 */
	public $action;
	
	/**
	 * @var string Text shown at the top of the form
	 */
	public $help;
	
	/**
	 * @var array
	 */
	public $classes = array();
	
	/**
	 * @var array Form items
	 */
	public $items = array();
	
	/**
	 * @var array Form buttons
	 */
	public $buttons = array();
	
	/**
	 * @var string Callback class name for validation
	 */
	public $validate = false;
	
	/**
	 * @var string URL for item validation handler
	 */
	public $validate_url = false;
	
	public function __construct() {
		
	}
	
	public function validate() {
		
	}
	
	/**
	 * @param string $item_name
	 * @throws formException
	 * @return \streaky\form\base\element
	 */
	public function &getItemByName($item_name) {
		foreach($this->items as $item) {
			if($item->name == $item_name) {
				return $item;
			}
		}
		throw new formException("Unknown item");
	}
	
	public function reset() {
		foreach($this->items as &$item) {
			$item->reset();
		}
	}
}

