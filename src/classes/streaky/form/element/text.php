<?php

namespace streaky\form\element;

class textException extends \Exception {}

class text extends base\input {
	
	protected $type = "text";
	
	/**
	 * Disable the base\input constructor 
	 */
	public function __construct() {}
}
