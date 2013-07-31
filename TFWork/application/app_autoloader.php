<?php

spl_autoload_register(function($className) {
    $root = APP_ROOT . 'application/';
    $dirs = array(
        'controller', 'model', 'router', 'template'
        );
    
    foreach($dirs as $dir) {
        $path = "$root$dir/$className.php";
        if(is_readable($path)) {
            require_once($path);
            return true;
        }
    }
    
    return false;
    
});
