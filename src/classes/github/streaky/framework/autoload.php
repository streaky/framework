<?php

namespace github\streaky\framework;

class autoloadException extends \Exception {}

class autoload {
	
	private static $main_path = false;
	private static $plugins_path = false;
	
	public static function init($root_dir) {
		self::$main_path = "{$root_dir}/classes/";
		self::$plugins_path = "{$root_dir}/plugins/";
		spl_autoload_register("self::loader");
	}
	
	public static function loader($class) {
		if(self::$main_path === false) {
			throw new autoloadException("Autoloader not initialized");
		}
		
		if(preg_match('#^'.preg_quote($GLOBALS['config']['plugin-ns'].'\\', '#').'(.*)$#', $class, $matches)) {
			$target = $matches[1];
			if(file_exists(self::$plugins_path."{$target}/class.php")) {
				require_once(self::$plugins_path."{$target}/class.php");
				return true;
			}
		}
		
		$target = str_replace('\\', '/', $class);
		if(file_exists(self::$main_path."{$target}.php")) {
			require_once(self::$main_path."{$target}.php");
			return true;
		}
		
		throw new autoloadException("Couldn't find class");
	}
}
