<?php

namespace streaky\form\validate;

class response {
	
	const ok = 0;
	const info = 1;
	const warn = 2;
	const error = 3;
	
	public $value = "";
	public $message = "";
	public $error = 0;
}
