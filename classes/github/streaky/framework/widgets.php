<?php

namespace mineadmin;

use \github\streaky\template\template as tpl;

class widgetsException extends \Exception {}

class widgets {
	
	public static function display() {
		foreach($GLOBALS['config']['widgets'] as $widget) {
			tpl::display("plugins/{$widget}/widget.php");
		}
	}
}
