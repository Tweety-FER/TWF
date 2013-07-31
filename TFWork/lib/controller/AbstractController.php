<?php

/**
 * An abstract model of a controller in an MVC framework. Supports most basic
 * functions required by a controller, such as redirection, returning from a
 * redirection and displaying data. All inheritors must invoke this class'
 * constructor to work properly.
 *
 * @author Luka Skukan
 */
abstract class AbstractController {
    
    /**
     * Location from which a redirect was made to this controller or null if
     * none. 
     * @var String|null
     */
    protected $redir;
    
    public function __construct() {
        $this->fetchRedirect();
    }
     
    /**
     * Gets the name of the controller (itself).
     * @return String
     */
    protected function getController() {
        $class = get_class($this);
        $pattern = '~^(\w+?)Controller$~';
        return preg_replace($pattern, "$1", $class);
    }
    
    /**
     * Stores internally the controller from which it was redirected to this,
     * or null if no redirection occured.
     */
    protected function fetchRedirect() {
        $this->redir = __session(REDIRECT, null, true);
    }
    
    /**
     * Displays a template, using the given data for configuration purposes.
     * 
     * @param type $action Action to invoke
     * @param array $data Array od key -> value pairs of data used in display
     * @param string|string[] $css Css file path(s) 
     * @param string|string[] $js Javascript file path(s)
     */
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
