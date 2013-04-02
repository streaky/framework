<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

if(!defined("ROOTDIR")) {
	define("ROOTDIR", __DIR__."/");
}
define("FWDIR", __DIR__."/");

require_once(ROOTDIR."config.php");
if(file_exists(ROOTDIR."config-override.php")) {
	require_once(ROOTDIR."config-override.php");
}

require_once(FWDIR."classes/github/streaky/framework/autoload.php");

// Autoloader will always use the first it matches so it's important to use any user overrides (ROOTDIR) first
\github\streaky\framework\autoload::init(array(ROOTDIR, FWDIR));
