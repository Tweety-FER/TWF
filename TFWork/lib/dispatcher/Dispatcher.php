<?php
/**
 * Description of Dispatcher
 *
 * @author Luka Skukan
 */
class Dispatcher {
    
    public static function dispatch() {
        $router = RoutingTable::route();
        
        $ctl = ucfirst(strtolower($router->getController())) . 'Controller';
        $act = 'action_' . strtolower($router->getAction());
        
        $break = function($className) {
            throw new ControllerNotFoundException(
                    "No such controller as $className"
                    );
        };
        
        
        spl_autoload_register($break);
        $controller = new $ctl();
        spl_autoload_unregister($break);
        
        if(is_callable(array($controller, $act))) {
            $controller->$act($router->getParams());
        } else {
            throw new ControllerNotFoundException(
                    "No controller $ctl with method $act exits"
                    );
        }
       
    }
}
