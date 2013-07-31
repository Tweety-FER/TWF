<?php

include_once APP_ROOT . 'config/global.conf.php';
include_once APP_ROOT . 'lib/lib.conf.php';
include_once APP_ROOT . 'application/app_autoloader.php';
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

function session_begin($name = 'session') {
    session_name($name);
    session_start();
}

session_begin();