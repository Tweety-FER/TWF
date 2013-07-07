<?php

/**
 * An abstraction of a model which can be stored in a database.
 * @author tweety
 *
 */
interface IDBModel extends IModel {
	
	/**
	 * Stores the instance of the model into a database. Can both store a new instance or perform<br> 
	 * updates on an existing one.
	 * @return bool Indication of success.
	 */
	public function save();
	
	/**
	 * Loads an instance of a model from the database. The instance is denoted by the given primary<br>
	 * key.
	 * @param unknown $pk Primary key
	 * @return bool Indication of success.
	 */
	public function load($pk);

	/**
	 * Deletes the instance of the model from the database.
	 * @return bool Indication of success.
	 */
	public function delete();
	
}