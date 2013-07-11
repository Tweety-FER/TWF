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
        $class = get_class($this);
        $pattern = '~^(\w+?)Controller$~';
        return preg_replace($pattern, "$1", $class);
    }
    
    protected function fetchRedirect() {
        $this->redir = __session(REDIRECT, null, true);
    }
    
    protected function display(
            $action, array $data = array(), $css = DEFAULT_CSS, $js = array()
            ) {
        $controller = $this->getController();
        $view = new Template($controller, $action, $css, $js);
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
        if($this->redir !== null) {
            $this->redirect($action, $this->redir);
        } else {
            throw new InvalidParametersException(
                    'Cannot proceed to undefined site.'
                    );
        }
    }
    
}
