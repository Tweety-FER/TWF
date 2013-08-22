<?php

/**
 * Description of IFormElement
 *
 * @author Luka Skukan
 */
interface IFormElement {
    
    public function display();
    
    public function validate();
   
    public function fill();
}
