<?php

namespace streaky\form\element;

class passwordException extends \Exception {}

class password extends base\input {
	
	protected $type = "password";
	
	/**
	 * Disable the base\input constructor 
	 */
	public function __construct() {}
}
