<?php

namespace streaky\framework;

use \streaky\template\template as tpl;

class pageException extends \Exception {}

class page {
	
	public static function display($content) {
		tpl::assign("main-content", $content);
		tpl::display("main.php");
	}
	
	public static function output($content) {
		echo $content;
	}
}
