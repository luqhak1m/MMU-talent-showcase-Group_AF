<?php

require_once __DIR__ . '/../../config/database.php'; // get the databse connection using $pdo

class ObjectModel {
	private $pdo;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct($pdo) {
        $this->pdo=$pdo;
	}

    # Include the functions that interact with the database, CREATE, READ, UPDATE, DELETE (CRUD)
    # ...
    public function getData(){
    }

    public function setData(){
    }

    public function deleteData(){
    }

    public function modifyData(){
    }
}