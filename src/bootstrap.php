<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define("ROOTDIR", __DIR__."/");

require_once(ROOTDIR."config.php");
if(file_exists(ROOTDIR."config-override.php")) {
	require_once(ROOTDIR."config-override.php");
}

require_once(ROOTDIR."classes/github/streaky/framework/autoload.php");

define("SITE_URL", "://{$GLOBALS['config']['site-host']}{$GLOBALS['config']['site-path']}");

\github\streaky\framework\autoload::init(ROOTDIR);

use \github\streaky\template\template as tpl;
tpl::addPath(ROOTDIR."templates/{$GLOBALS['config']['template']}/");


tpl::assign("site-url", SITE_URL);
tpl::assign("static-url", $GLOBALS['config']['static-url']);
