<?php

define('APP_ROOT', dirname(dirname(__FILE__)) . '/');
include_once APP_ROOT . 'inc/bootloader.php';

try {
    Dispatcher::dispatch();
} catch(Exception $e) {
    Template::show404();
}
