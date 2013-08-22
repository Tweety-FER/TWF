<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailInputElement
 *
 * @author Luka Skukan
 */
class EmailInputElement extends AbstractInputFormElement {
    
    public function __construct($name) {
        parent::__construct($name, 'email', false);
    }
    
    protected function getType() {
        return 'text';
    }    
}
