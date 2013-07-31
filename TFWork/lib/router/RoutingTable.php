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
        $url = $_SERVER['REQUEST_URI'];
        $routers = array_merge(
                self::listRouters(USER_ROUTE_DIR),
                self::listRouters(APP_ROUTER_DIR)
                );
        
        foreach($routers as $routerName) {
            $router = new $routerName();
            $router->parse($url);
            if($router->success() === true) {
                return $router;
            }
        }
        
        throw new RouterNotFoundException(
                "No router capable of parsing URL $url found."
                );
    }
    
    private static function listRouters($path) {
        $files = scandir($path);
        $routerNames = array();
        
        foreach($files as $file) {
            if(is_dir($file)) {
                continue;
            }
            
            $routerNames[] = preg_replace('~^(\w+?).php$~', "$1", $file);
        }
        
        return $routerNames;
    }
}
