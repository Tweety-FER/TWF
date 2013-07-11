<?php

/**
 *
 * @author Luka Skukan
 */
interface IRouter {
    
    /**
     * 
     * @param String $url URL relative to application base path, to parse
     * @return IRouter Returns self
     */
    public function parse($url);
    
    /**
     * 
     * @return String Controller, drawn from the URL
     */
    public function getController();
    
    /**
     * 
     * @return String Action, drawn from the URL
     */
    public function getAction();
    
    /**
     * 
     * @return stdClass Additional parameters, or empty string if none can be read
     * from the URL
     */
    public function getParams();
    
}
