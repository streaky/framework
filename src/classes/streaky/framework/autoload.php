<?php

namespace streaky\framework;

class autoloadException extends \Exception {}

class autoload {
	
	private static $root_dirs = array();
	
	public static function init(array $root_dirs) {
		foreach($root_dirs as $dir) {
			if(!in_array($dir, self::$root_dirs)) {
				self::$root_dirs[] = $dir;
			}
		}
		spl_autoload_register("self::loader");
	}
	
	public static function addDir($dir) {
		if(!in_array($dir, self::$root_dirs)) {
			self::$root_dirs[] = $dir;
			return true;
		}
		return false;
	}
	
	public static function loader($class) {
		if(count(self::$root_dirs) == 0) {
			throw new autoloadException("Autoloader not initialized correctly");
		}
		
		if(preg_match('#^'.preg_quote($GLOBALS['config']['plugin-ns'].'\\', '#').'(.*)$#', $class, $matches)) {
			$target = $matches[1];
			foreach(self::$root_dirs as $dir) {
				$path = "{$dir}plugins";
				if(file_exists("{$path}/{$target}/class.php")) {
					require_once("{$path}/{$target}/class.php");
					return true;
				}
			}
		}
		
		$target = str_replace('\\', '/', $class);
		foreach(self::$root_dirs as $dir) {
			$path = "{$dir}classes";
			if(file_exists("{$path}/{$target}.php")) {
				require_once("{$path}/{$target}.php");
				return true;
			}
		}
	}
}
