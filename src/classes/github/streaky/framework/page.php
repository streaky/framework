<?php

namespace github\streaky\framework;

use \github\streaky\template\template as tpl;

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
