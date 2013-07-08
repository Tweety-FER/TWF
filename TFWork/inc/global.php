<?php

include_once 'config/global.conf.php';
include_once 'lib/lib.conf.php';
include_once 'database/DBProvider.php';

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