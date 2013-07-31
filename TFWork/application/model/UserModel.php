<?php

/**
 * Description of UserModel
 *
 * @author Luka Skukan
 */
class UserModel extends AbstractDBModel {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getColumns() {
        return array('name', 'password');
    }

    public function getDefault($column) {
        return null;
    }

    public function getPrimaryKey() {
        return 'id';
    }

    public function getPrimaryKeyValue() {
        return $this->id;
    }

    public function getTable() {
        return 'user';
    }  
    
    public function logIn($username, $password) {
        return $this->query()->where(
                array('name' => $username, 'password' => sha1($password))
                )->fetch() !== false;
    }
}
