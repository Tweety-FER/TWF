<?php

include_once APP_ROOT . 'config/global.conf.php';
include_once APP_ROOT . 'lib/lib.conf.php';
require_once APP_ROOT . 'database/DBProvider.php';

function __get($name, $alt = null) {
    return isset($_GET[$name]) ? $_GET[$name] : $alt;
}

function __post($name, $alt = null) {
    return isset($_POST[$name]) ? $_POST[$name] : $alt;
}

function __session($name, $alt = null, $unset = false) {
    $ret = isset($_SESSION[$name]) ? $_SESSION[$name] : $alt;
    if($unset === true) {
        unset($_SESSION[$name]);
    }
    return $ret;
}

$appLoader = function($className) {
    $dirs = array(
        'application/controller', 'application/model',
        'lib/controller', 'lib/dispatcher', 'lib/router', 
        'lib/model', 'lib/exception', 'lib/validation',
        'lib/view', 'application/router'
    );
    
    foreach($dirs as $dir) {
        $path = APP_ROOT . "$dir/$className.php";
        if(is_readable($path)) {
            require_once($path);
            return true;
        }
    }
    
    return false;
};

function session_begin($name = 'session') {
    session_name($name);
    session_start();
}

spl_autoload_register($appLoader);
session_begin();