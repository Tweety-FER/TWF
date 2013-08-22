<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractFormElement
 *
 * @author Luka Skukan
 */
abstract class AbstractFormElement implements IFormElement, Serializable {
    
    public $value;
    
    public $name;
    
    protected $rules;
    
    protected $error;
    
    protected $secret; #Here for later upgrades (?)
    
    public function __construct($name, $rules, $secret) {
        $this->name = $name;
        $this->value = null;
        $this->rules = $rules;
        $this->error = null;
        $this->secret = $secret;
    }
    
    public function display() {
        $display = $this->error === null ? '' : 
                '<span class="error">' . $this->error . '</span>' . '<br/>';
        $display .= $this->fillSkeleton();
        return $display;
    }

    public function fill() {
        $this->value = __post($this->name);
        if($this->value === null) {
            return false;
        }
        
        return $this->validate();
    }

    public function validate() {
        $validator = new FieldValidator();
        $validator->addRules($this->rules);
        $success = $validator->validate($this);
        
        if($success === false) {
            $errors = $validator->getValidationErrors();
            $this->error = implode("<br/>", $errors);
            return false;
        }
        
        return true;
    }
    
    protected function fillSkeleton() {
        $skeleton = $this->getSkeleton();
        $skeleton = str_replace('$name', $this->name, $skeleton);
        if($this->value !== null) {
            $skeleton = str_replace('$value', $this->value, $skeleton);
        } else {
            $skeleton = str_replace('$value', '', $skeleton);
        }
        return $skeleton;
    }
    
    public function serialize() {
        return serialize(array(
            'name' => $this->name,
            'value' => $this->value,
            'rules' => $this->rules,
            'error' => $this->error
        ));
    }
    
    public function unserialize($serialized) {
        $data = unserialize($serialized);
        $this->name = $data['name'];
        $this->values = $data['value'];
        $this->rules = $data['rules'];
        $this->error = $data['error'];
    }
    
    abstract public function getSkeleton();
}
