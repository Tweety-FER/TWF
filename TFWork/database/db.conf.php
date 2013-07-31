<?php

define('DBTYPE', 'mysql');
define('DBUSER', 'test');
define('DBPASS', 'test');
define('DBNAME', 'test');

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