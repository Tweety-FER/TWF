<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasswordInputElement
 *
 * @author Luka Skukan
 */
class PasswordInputElement extends AbstractInputFormElement {
    
    public function __construct($name) {
        parent::__construct(
                $name, 
                'length[6]|contains[[A-Za-z]]|contains[\d]', 
                true
                );
    }
    
    protected function getType() {
        return 'password';
    }
    
}
