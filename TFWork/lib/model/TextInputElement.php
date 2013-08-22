<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TextInputElement
 *
 * @author Luka Skukan
 */
class TextInputElement extends AbstractInputFormElement {
    
    public function __construct($name) {
        parent::__construct($name, '', false);
    }
    
    protected function getType() {
        return 'text';
    }
}
