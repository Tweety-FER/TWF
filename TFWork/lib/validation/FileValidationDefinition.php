<?php

/**
 * Model citaca definicije validacijskog procesa koji podatke cita iz tekstualnog dokumenta na disku.
 * @author tweety
 *
 */
class FileValidationDefinition implements IValidationDefinition {

	/**
	 * Poredano polje identifikatora pravila
	 * @var {array}
	 */
	private $rules = array();

	/**
	 * Poredno polje regularnih izraza za pravilo na istom indeksu.
	 * @var {array}
	*/
	private $regex = array();

	/**
	 * Poredano polje poruka greske za pravilo na istom indeksu.
	 * @var {array}
	*/
	private $errors = array();

	
	private $prettyReplace = array(
			'\d' => 'digits',
			'[a-zA-Z]' => 'letters',
			'[A-Za-z]' => 'letters',
			'\w' => 'letters or characters'
	); 
	/**
	 * Cita podatke iz dokumenta na danoj putanji, ako postoji, te ih parsira.<br>
	 * Specificnije verzija ovog: <br>
	 *
	 * @param {string} $file Putanja konfiguracijskog dokumenta
	 * @return boolean True pri uspjehu, false inace
	*/
	public function load_rules($file = 'resources/conf/rules.conf') {
		$fp = fopen($file, 'r');
		if($fp === false) {
			return false;
		}
		while(($line = fgets($fp)) !== false) {
			if(preg_match('~^#.*$~', $line) === 1 or preg_match('~^\s*$~', $line) === 1) {
				continue;
			}
				
			$parts = explode(';;', $line);
			$this->rules[] = '~' . $parts[0] . '~';
			$this->regex[] = '~' . $parts[1] . '~';
			$this->errors[] = $parts[2];
		}

		fclose($fp);

		return true;
	}

	public function has_rules() {
		return !(empty($this->rules) and empty($this->regex) and empty($this->errors));
	}

	public function get_regex_for_rule($rule) {
		return preg_replace($this->rules, $this->regex, $rule);
	}

	public function get_error_for_rule($rule, $negated = false) {
		$word = $negated ? 'not ' : '';
		$error = preg_replace($this->rules, $this->errors, $rule);
		return $this->pretty(preg_replace('~%@~', $word, $error));
	}
	
	private function pretty($text) {
		foreach($this->prettyReplace as $search => $replace) {
			$text = str_replace($search, $replace, $text);
		}
		return $text;
	}
}
