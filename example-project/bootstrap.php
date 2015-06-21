<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

if(!defined("ROOTDIR")) {
	define("ROOTDIR", __DIR__."/");
}
define("FWDIR", __DIR__."/");

// figure out site absolute path and url
$path = dirname($_SERVER['PHP_SELF'])."/";

if($path == "//") {
	$path = "/";
}


$proto = "cli";

if(isset($_SERVER['SERVER_PORT']) && isset($_SERVER['HTTP_HOST'])) {
	$proto = "http"; $port = "";
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
		$proto = "https";
	}
	if(($proto == "http" && $_SERVER['SERVER_PORT'] != 80) || ($proto == "https" && $_SERVER['SERVER_PORT'] != 443)) {
		$port = ":{$_SERVER['SERVER_PORT']}";
	}
	$url = "{$proto}://{$_SERVER['HTTP_HOST']}{$port}{$path}";
	define("SITE_PATH", $path);
	define("SITE_URL", $url);
}

require_once(ROOTDIR."config.php");
if(file_exists(ROOTDIR."config-override.php")) {
	require_once(ROOTDIR."config-override.php");
}

require_once(FWDIR."classes/streaky/framework/autoload.php");

// Autoloader will always use the first it matches so it's important to use any user overrides (ROOTDIR) first
\streaky\framework\autoload::init(array(ROOTDIR, FWDIR));

class tpl extends \streaky\template\template {};
