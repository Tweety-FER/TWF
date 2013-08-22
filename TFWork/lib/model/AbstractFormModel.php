<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractFormModel
 *
 * @author Luka Skukan
 */
abstract class AbstractFormModel implements IFormModel, Serializable {
    
    protected $fields;
    
    protected $action;
    
    protected $name;
    
    protected $clear;
    
    public function __construct($action, $name, $fields = array(), $clear = true) {
        $this->action = $action;
        $this->name = $name;
        $this->fields = $fields;
        $this->clear = $clear;
    }
    
    public function addField(IFormElement $field) {
        $this->fields[] = $field;
    }

    public function addFields(array $fields) {
        foreach($fields as $field) {
            $this->addField($field);
        }
    }

    public function display() {
        $_SESSION['form'] = serialize($this);
        $html = $this->getSkeleton();
        $html = str_replace('$action', $this->action, $html);
        
        $elements = '';
        foreach($this->fields as $field) {
            $elements .= "<p>" . $field->display() . "</p>";
        }
        $elements .= '<button type="submit">' . $this->name . '</button>';
        if($this->clear === true) {
            $elements .= '<button type="reset">Clear</button>';
        }
        
        $html = str_replace('$elements', $elements, $html);
        
        return $html;
    }

    public function validate() {
        $success = true;
        
        foreach($this->fields as $field) {
            $success &= $field->fill();
        }
        
        return $success;
    }
    
    public function serialize() {
        $elements = array();
        foreach($this->fields as $field) {
            $elements[] = serialize($field);
        }
        
        return serialize(array(
            'action' => $this->action,
            'clear' => $this->clear,
            'name' => $this->name,
            'fields' => $elements
        ));
    }
    
    public function unserialize($serialized) {
        $data = unserialize($serialized);
        $this->action = $data['action'];
        $this->clear = $data['clear'];
        $this->name = $data['name'];
        $this->fields = array();
        
        foreach($data['fields'] as $field) {
            $this->fields[] = unserialize($field);
        }
    }
    
    protected abstract function getSkeleton();
}
