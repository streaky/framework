<?php

$routes = array(
	"home" => array(
		"match" => "#^/$#",
		"callback" => '\mineadmin\plugins\dashboard::index',
	),
);
