<?php

/**
 * Description of AbstractRouter
 *
 * @author Luka Skukan
 */
abstract class AbstractRouter implements IRouter {
    
    /**
     *
     * @var String
     */
    protected $action;
    
    /**
     *
     * @var String
     */
    protected $controller;
    
    /**
     *
     * @var array
     */
    protected $params;
    
    public function getAction() {
        return isset($this->action) ? $this->action : '';
    }

    public function getController() {
        return isset($this->controller) ? $this->controller : '';
    }

    public function getParams() {
        return isset($this->params) ? (object) $this->params : new stdClass();
    }

    abstract public function parse($url);
}