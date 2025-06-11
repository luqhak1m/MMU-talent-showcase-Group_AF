<!-- 
 
Author(s): 
 
    1) Luqman

-->

<?php

require_once __DIR__ . '/../../config/database.php'; // get the databse connection using $pdo

class ProfileModel {
	private $db;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct() {
        $this->db=connectToDatabase($dbCredentials);
	}

    public function viewProfile(){
        
    }
}