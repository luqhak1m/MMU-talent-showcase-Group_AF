<!-- 
 
Author(s): 
 
    1) Luqman

-->

<?php

require_once __DIR__ . '/../../config/database.php'; // get the databse connection using $pdo
require_once __DIR__ . '/../../config/database_config.php';
require_once __DIR__ . '/../../includes/ID-Generator.inc.php';
// echo "[INFO] ProfileModel.php: Entered <br>";
// echo gettype($dbCredentials) . "<br>";
class ProfileModel {
	private $pdo;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct($pdo) {
        $this->pdo=$pdo;
	}

    public function createProfile($UserID){
        // echo "[INFO] ProfileModel.createProfile(): Executing <br>";
        $ProfileID = generateID();
        $sql_profile = "INSERT INTO Profile (ProfileID, UserID) VALUES (?, ?)";
        $stmt_profile = $this->pdo->prepare($sql_profile);
        $stmt_profile->execute([$ProfileID, $UserID]);
        // echo "[INFO] ProfileModel.createProfile(): Executed <br>";
    }

    public function fetchProfile($UserID){ // takes the UserID FK as parameter
        // echo "[INFO] ProfileModel.fetchProfile(): Executing <br>";
        $sql="SELECT FirstName, LastName, `Address`, Gender, DOB, Followers, `Following`, PhoneNum, ProfilePicture, Bio FROM Profile WHERE UserID = ?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$UserID]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // fetch one, fetch as array
        // echo "[INFO] ProfileModel.fetchProfile(): Executed <br>";
    }

    public function updateProfile($UserID, $FirstName, $LastName, $Address, $Gender, $DOB, $PhoneNum, $ProfilePicture, $Bio){
        // echo "[INFO] ProfileModel.updateProfile(): Executing <br>";
        $sql="UPDATE `Profile` SET FirstName=?, LastName=?, `Address`=?, Gender=?, DOB=?, PhoneNum=?, ProfilePicture=?, Bio=? WHERE UserID = ?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$FirstName, $LastName, $Address, $Gender, $DOB, $PhoneNum, $ProfilePicture, $Bio, $UserID]);
        // echo "[INFO] ProfileModel.updateProfile(): Executed <br>";
    }
}