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
    public function __construct($dbCredentials) {
        $this->db=connectToDatabase($dbCredentials);
	}

    public function fetchProfileDetails($UserID){ // takes the UserID FK as parameter
        $sql="SELECT FirstName, LastName, `Address`, Gender, DOB, Followers, `Following`, PhoneNum, ProfilePicture, Bio FROM Profile WHERE UserID = ?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([$UserID]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // fetch one, fetch as array
    }

    public function updateProfile($UserID, $FirstName, $LastName, $Address, $Gender, $DOB, $PhoneNum, $ProfilePicture, $Bio){
        $sql="UPDATE `Profile` SET FirstName=?, LastName=?, `Address`=?, Gender=?, DOB=?, PhoneNum=?, ProfilePicture=?, Bio=? WHERE UserID = ?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([$FirstName, $LastName, $Address, $Gender, $DOB, $PhoneNum, $ProfilePicture, $Bio, $UserID]);
    }
}