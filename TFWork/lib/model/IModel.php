<?php

interface IModel {
	
	/**
	 * Validates the state of the model, checking whether all of its properties<br>
	 * are set and in a legal state. If any errors are encountered, they will be
	 * made available via $model->validationErrors as an array.
	 * @return bool True if all are valid, false otherwise
	 */
	public function validate();
	
	/**
	 * Checks whether a model equals the provided model.
	 * @param IModel $model Model for which to check equality.
	 * @return bool True if they are equal, false otherwise.
	 */
	public function equals(IModel $model);
	
}