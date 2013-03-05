<?php

namespace github\streaky\framework;

class routerException extends \Exception {}

class router {
	
	/**
	 * Initialize the page router
	 * 
	 * @throws routerException on no routes (i.e. should be 404)
	 */
	public static function init() {

		// TODO: this has too much effectively repeated code, split it into a method
		
		// we want request uri without GET params on the end
		$uri = explode("?", $_SERVER['REQUEST_URI'], 2); $uri = $uri[0];
		
		$routes = array();
		require_once(ROOTDIR."routes.php");
		$uri = "/".str_replace($GLOBALS['config']['site-path'], "", $uri);
		$matches = array();
		foreach($routes as $route) {
			
			if(preg_match($route['match'], $uri, $matches) && is_callable($route['callback'])) {
				if(!isset($route['method']) || $_SERVER['REQUEST_METHOD'] == $route['method']) {
					$response = call_user_func($route['callback'], $matches);
					if($response != false) {
						page::display($response);
					}
					return;
				}
			}
		}

		// Find a possible plugin name
		$matches = array();
		if(preg_match('#^/([a-zA-Z0-9_]+)/(.{0,})$#U', $uri, $matches)) {
			$plugin = $matches[1];
			$pluginUri = "/{$matches[2]}";
			if(file_exists(ROOTDIR."plugins/{$plugin}/routes.php")) {
				$pluginRoutes = array();
				require_once(ROOTDIR."plugins/{$plugin}/routes.php");
				$matches = array();
				foreach($pluginRoutes as $route) {
					if(preg_match($route['match'], $pluginUri, $matches)) {
						if(!isset($route['method']) || $_SERVER['REQUEST_METHOD'] == $route['method']) {
							$callback = "{$GLOBALS['config']['plugin-ns']}\\{$plugin}::{$route['callback']}";
							if(is_callable($callback)) {
								$response = call_user_func($callback, $matches);
								if($response != false) {
									page::display($response);
								}
								return;
							}
						}
					}
				}
				
				// TODO: Check for plugin 404 route
				
			}
		}


		if(isset($routes['_error404'])) {
			// use route for 404
		}


		throw new routerException("No matching routes for URI");
	}
}
