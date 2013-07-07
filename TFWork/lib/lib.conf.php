<?php

spl_autoload_register(function($class_name) {
	$root = LIBROOT;
	$dirs = array(
			'ctl', 'dispatch', 'exception', 
			'validation', 'model', 'view'
	);
	
	foreach($dirs as $dir) {
		$file = $root . $dir . DS . $class_name . '.php';
		if(is_readable($file)) {
			require_once($file);
			return true;
		}
	}
	
	return false;
});