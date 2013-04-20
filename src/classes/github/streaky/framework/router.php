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
		
		try {
		
			// we want request uri without GET params on the end
			$uri = explode("?", $_SERVER['REQUEST_URI'], 2); $uri = $uri[0];
			
			$routes = array();
			require_once(ROOTDIR."routes.php");
			
			// Fix for site path being '/' and making a horrible mess...
			$p = preg_quote($GLOBALS['config']['site-path'], '#');
			$uri = preg_replace('#^'.$p.'#', '/', $uri);
			
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
			if(preg_match('#^/([a-zA-Z0-9_-]+)/(.{0,})$#U', $uri, $matches)) {
				$matches[1] = str_replace(array("-"), "_", $matches[1]);
				$plugin = $matches[1];
				
				// check for any master plugin rewrites
				if(isset($routes["plugin:{$plugin}"])) {
					$plugin = $routes["plugin:{$plugin}"]['rewrite'];
				}
				
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
					
					if(isset($pluginRoutes['__error_404'])) {
						$detail = array("type" => 404, "uri" => $uri, "request-uri" => $_SERVER['REQUEST_URI']);
						$response = call_user_func($GLOBALS['config']['plugin-ns'].'\error::'.$pluginRoutes['__error_404']['callback'], $detail);
						if($response != false) {
							page::display($response);
						}
						return;
					}
					
				}
			}
			
			throw new routerException("No route handlers", 404);
		
		} catch(routerException $ex) {

			if(file_exists(ROOTDIR."plugins/error/class.php") && file_exists(ROOTDIR."plugins/error/routes.php")) {
				$pluginRoutes = array();
				require_once(ROOTDIR."plugins/error/routes.php");
				if(isset($pluginRoutes['__error_404'])) {
					$detail = array("type" => 404, "uri" => $uri, "request-uri" => $_SERVER['REQUEST_URI'], "message" => $ex->getMessage());
					$response = call_user_func($GLOBALS['config']['plugin-ns'].'\error::'.$pluginRoutes['__error_404']['callback'], $detail);
					if($response != false) {
						page::display($response);
					}
					return;
				}
			}
		
		}
		
		


		throw new routerException("No matching routes for URI and no suitable 404 handler");
	}
}
