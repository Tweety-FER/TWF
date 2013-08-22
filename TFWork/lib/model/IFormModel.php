<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Luka Skukan
 */
interface IFormModel {
    
    public function addField(IFormElement $field);
    
    public function addFields(array $fields);
    
    public function display();
    
    public function validate();
    
}
