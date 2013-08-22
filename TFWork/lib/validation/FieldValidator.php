<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FieldValidator
 *
 * @author Luka Skukan
 */
class FieldValidator {
   
	/**
	 * Asocijativno polje u kojem su spremljena sva pravila za sva
	 * polja koja je potrebno provjeriti.
	 * @var {array}
	 */
	private $rules;
	
	/**
	 * Polje gresaka koje su pronadene pri ispitivanju podataka.
	 * @var {array}
	 */
	private $errors;
	
	/**
	 * Objekt koji sadrzi definiciju validacija i gresaka
	 * @var IValidationDefinition
	 */
	private $val_def;
	
	/**
	 * Stvara novi prazan element 
	 */
	public function __construct() {
		$this->rules = array();
		$this->errors = array();
		$this->val_def = new FileValidationDefinition();
	}

	/**
	 * Postavlja nova pravila za validaciju podataka.
	 * @param string $rules				pravila za validaciju podataka
	 */
	public function addRules($rules) {
		$this->rules = explode('|', $rules);
	}

	/**
	 * Pokrece validaciju podataka.
	 * @return boolean true ako svi podaci zadovoljavaju pravila
	*/
	public function validate($obj) {
		if(!$this->val_def->has_rules()) {
			$this->val_def->load_rules();
		}
		
		$ok = true;
		$data = preg_replace('~\n~', ' ', (isset($obj->value) ? $obj->value : ''));
		foreach($this->rules as $rule) {
			if(empty($rule)) {
				continue;
			}
			$flip = false;
			if(preg_match('~^![^!].*$~',$rule) === 1) {
				$flip = true;
			}	
			
                        $reg = $this->val_def->get_regex_for_rule($rule);
			$success = (preg_match($reg, $data) === 1);
				
			if($flip) { 
				$success = !$success;
			}
			
			if ($success !== true) {
				$ok = false;
				$this->errors[] = 
                                        $this->val_def->get_error_for_rule($rule, $flip);
			}
		}
		
		return $ok;
	}
	
	/**
	 * Vraća pogreske koje su se dogodile prilikom validacije.
	 * @return array Greške
	*/
	public function getValidationErrors() {
		return $this->errors;
	}
	
	/**
	 * Vraća podatak je li validator naišao na pogreške
	 * @return boolean Podatak
	 */
	public function hasErrors() {
		return !empty($this->errors);
	}
}
