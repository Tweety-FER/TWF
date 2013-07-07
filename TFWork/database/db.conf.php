<?php

define('DBTYPE', 'mysql');
define('DBUSER', 'root');
define('DBPASS', 'root');
define('DBNAME', 'root');

/**
 * Handles error reporting for any database caused exceptions.
 * Implement at will. By default throws the exception.
 * 
 * @param PDOException $exception Caught exception
 * @throws PDOException By default just throws it
 */
function DBReportError(PDOException $exception) {
	throw $exception;
}

/*
 * Registers a simple autoloader for local use.
 */
spl_autoload_register(function($className) {
	$file = 'FluentPDO' . DS . "$className.php";
	if(is_readable($file)) {
		require_once($file);
		return true;
	}
	
	return false;
});