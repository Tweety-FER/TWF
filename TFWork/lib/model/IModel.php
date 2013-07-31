<?php

interface IModel {	
	/**
	 * Checks whether a model equals the provided model.
	 * @param IModel $model Model for which to check equality.
	 * @return bool True if they are equal, false otherwise.
	 */
	public function equals(IModel $model);
	
}