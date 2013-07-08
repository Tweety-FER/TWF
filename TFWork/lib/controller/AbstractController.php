<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Luka Skukan
 */
abstract class AbstractController {
    
    protected $redir;
    
    public function __construct() {
        $this->fetchRedirect();
    }
     
    protected function getController() {
        $class = get_class();
        $pattern = '~^(\w+?)Controller$~';
        return preg_replace($pattern, "$1", $class);
    }
    
    protected function fetchRedirect() {
        $this->redir = __session(REDIRECT, null, true);
    }
    
    protected function display($action, array $data = array()) {
        $controller = $this->getController();
        $view = new Template($controller, $action);
        $view->setAll($data);
        $view->display();
    }
    
    protected function redirect($action, $path) {
        $_SESSION[REDIRECT] = '/' . $this->getController() . '/' .
                $action;
        header("Location: $path");
        die();
    }
    
    protected function redirectBack($action) {
        if($this->redirect !== null) {
            $this->redirect($action, $this->redir);
        } else {
            throw new InvalidParametersException(
                    'Cannot proceed to undefined site.'
                    );
        }
    }
    
}
