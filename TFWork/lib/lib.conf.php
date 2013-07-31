<?php

spl_autoload_register(function($class_name) {
	$root = APP_ROOT . 'lib/';
	$dirs = array(
			'controller', 'dispatcher', 'exception', 
			'validation', 'model', 'view', 'router',
                        'router/routers'
	);
	
	foreach($dirs as $dir) {
		$file = $root . $dir . '/' . $class_name . '.php';
		if(is_readable($file)) {
			require_once($file);
			return true;
		}
	}
	
	return false;
});