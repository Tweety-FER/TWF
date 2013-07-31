<?php

define('DS', DIRECTORY_SEPARATOR);
define('LIBROOT', APP_ROOT . 'lib/');
define('TEMPLATE_ROOT', APP_ROOT .'application/template/');
define('TEMPLATE_EXTENSION','.template.php');
define('DEF_HEADER', TEMPLATE_ROOT . 'header' . TEMPLATE_EXTENSION);
define('DEF_FOOTER', TEMPLATE_ROOT . 'footer' . TEMPLATE_EXTENSION);
define('NOT_FOUND', TEMPLATE_ROOT . '404' . TEMPLATE_EXTENSION);
define('CSS_DIR', '/css/');
define('JS_DIR', '/js/');
define('IMG_DIR', '/img/');
define('DEFAULT_CSS', 'default');
define('REDIRECT', 'redirect');
define('USER_ROUTE_DIR', APP_ROOT . 'application/router');
define('APP_ROUTER_DIR', APP_ROOT . 'lib/router/routers');