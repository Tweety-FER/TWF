<?php

class AbstractDBModel implements IDBModel {
	
	/**
	 * Query builder.
	 * @var FluentPDO
	 */
	protected $fpdo;
	
	public function __construct() {
		$this->fpdo = DBProvider::provide();
	}
	
	public function save() {
		if($this->validate() === false) {
			throw new InvalidParametersExpcetion('Properties of the model are not valid. Cannot store');
		}
		
		//Check whether performing an update or an insert
		if($this->getPrimaryKeyValue() === null) {
			//Attempt insert
			if(($result = $this->fpdo->insertInto($this->getTable(), $this->getValues())->execute()) !== false) {
				$this->{$this->getPrimaryKey()} = $result;
				return true; //Update primary key, indicate success
			}
			
			return false; //Cry
		} else {
			//Update
			return $this->fpdo->update(
					$this->getTable(), 
					$this->getValues(), 
					array($this->getPrimaryKey() => $this->getPrimaryKeyValue())
					)->execute();
		}
	}
	
	public function load($pk) {
		$results = $this->fpdo->from($this->getTable())->
			where(array($this->getPrimaryKey() => $pk))->fetch();
		
		if($results === false) {
			return false;
		}
		
		foreach($results as $k => $v) {
			$this->$k = $v;
		}
		
		return $true;
	}
	
	public function delete() {
		return $this->fpdo->
			delete($this->getTable(), array($this->getPrimaryKey() => $this->getPrimaryKeyValue()))->execute();
	}
	
	public function count() {
		return (int) $this->fpdo->from($this->getTable())->select(null)->select('COUNT(*)');
	}
	
	/**
	 * Returns a begun query over the database containing the object, allowing for user-made
	 * select queries.
	 * @return SelectQuery
	 */
	public function query() {
		return $this->fpdo->from($this->getTable());
	}
	
	public function validate() {
		$validator = new ObjectValidator();
		$validator->addRules($this->getValidationRules());
		$result = $validator->validate($this);
		if($result === false) {
			$this->validationErrors = $validator->getValidationErrors();
		}
		
		return $result;
	}
	
	public function equals(IModel $model) {
		if(get_class($this) !== get_class($model)) {
			return false;
		}
		
		return $this->getPrimaryKeyValue() === $model->getPrimaryKeyValue();
	}
	
	public function __get($var) {
		return isset($this->$var) ? $this->$var : $this->getDefault($var);
	}
	
	protected function getValues() {
		$values = array();		
		$columns = $this->getColumns();
		
		foreach($columns as $column) {
			$values[$column] = isset($this->column) ? $this->column : null;
		}
		
		return $values;
	}
	
	abstract public function getTable();
	
	abstract public function getColumns();
	
	abstract public function getDefault($column);
	
	abstract public function getPrimaryKey();
	
	abstract public function getPrimaryKeyValue();
	
	abstract public function getValidationRules();
}