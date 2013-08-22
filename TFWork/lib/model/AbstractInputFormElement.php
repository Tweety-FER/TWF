<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TextInputFormElement
 *
 * @author Luka Skukan
 */
abstract class AbstractInputFormElement extends AbstractFormElement {
    
    
    public function getSkeleton() {
        return '<label>$name: <input type="' . $this->getType() .
                '" name="$name" value="$value" /></label>';
    }    
    
    abstract protected function getType();
}
