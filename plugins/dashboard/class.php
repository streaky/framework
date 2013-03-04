<?php

namespace mineadmin\plugins;

class dashboardException extends \Exception {}

class dashboard {
	
	public static function index() {
		return "Index";
	}
	
	public static function phpinfo() {
		phpinfo();
	}
}
