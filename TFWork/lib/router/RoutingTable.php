<?php

/**
 * Description of RoutingTable
 *
 * @author Luka Skukan
 */
class RoutingTable {
    
    /**
     * 
     * @return IRouter
     * @throws RouterNotFoundException
     */
    public static function route() {
        $fullURL = $_SERVER['REQUEST_URI'];
        $matches = array();
        if(preg_match('~^/(\w+?)(?:/(.+?))?(?:\?.*)?$~', $fullURL, $matches) === 1) {
            $routerName = ucfirst(strtolower($matches[1])) . 'Router';
            $relativeURL = isset($matches[2]) ? $matches[2] : '';

            $router = new $routerName();
            return $router->parse($relativeURL);
        } else {
            throw new RouterNotFoundException('No router defined for URL');
        }
    }
    
}
