<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractModelCreatorForm
 *
 * @author Luka Skukan
 */
abstract class AbstractModelCreatorForm extends AbstractFormModel 
implements IModelCreator {
    
    protected $modelName = '';
    
    abstract protected function getSkeleton();
    
    public function createModel() {
        //TODO Error catching
        $model = new $this->modelName();
        foreach($this->fields as $field) {
            $name = $field->name;
            $model->$name = $field->value;
        }
        
        return $model;
    }
}
