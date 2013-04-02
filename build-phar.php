#!/usr/bin/php -d phar.readonly=0
<?php

$dir = __DIR__;

$filename = "framework.phar";

$p = new Phar("{$dir}/{$filename}", FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, $filename);
$p->startBuffering();
$p->setStub("<?php Phar::mapPhar();\ninclude 'phar://{$filename}/bootstrap.php';\n__HALT_COMPILER();\n"); 

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("{$dir}/src/"), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $name => $object){
    if(preg_match('#.php$#', $name)) {
    	$fix = str_replace("{$dir}/src/", "", $name);
    	$p[$fix] = file_get_contents($name);
    	$p[$fix]->compress(Phar::BZ2);
	}
}

$p->stopBuffering();
