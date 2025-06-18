<?php

require_once __DIR__ . '/../../config/database.php'; // get the databse connection using $pdo
require_once __DIR__ . '/../../config/database_config.php'; // get the databse connection using $pdo
require_once __DIR__ . '/../../includes/ID-Generator.inc.php';
// echo "[INFO] CatalogueModel.php: Entered <br>";
class CatalogueModel {
	private $pdo;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct($pdo) {
        $this->pdo=$pdo;
	}

    # Include the functions that interact with the database, CREATE, READ, UPDATE, DELETE (CRUD)
    # ...
    public function createCatalogue($UserID){
        // echo "[INFO] CatalogueModel.createCatalogue(): Executing <br>";
        $CatalogueID = generateID();
        $sql = "INSERT INTO Catalogue (CatalogueID, UserID) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$CatalogueID, $UserID]);
        // echo "[INFO] CatalogueModel.createCatalogue(): Executed <br>";
    }

    public function fetchCatalogueByUserID($UserID){
        // echo "[INFO] CatalogueModel.fetchCatalogueByUserID(): Executing <br>";
        $sql="SELECT CatalogueID FROM Catalogue WHERE UserID=?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$UserID]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        // echo "[INFO] CatalogueModel.fetchCatalogueByUserID(): Executed <br>";
        return $result['CatalogueID'];
    }

    public function fetchAllCatalogue(){
        // echo "[INFO] CatalogueModel.fetchAllCatalogue(): Executing <br>";
        $sql="SELECT t.*, p.ProfilePicture 
            FROM Talent t 
            JOIN `Profile` p ON t.UserID = p.UserID"; // join the talent table with profile picture from user table to display in html for each talent
        $stmt = $this->pdo->query($sql);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "[INFO] CatalogueModel.fetchAllCatalogue(): Executed <br>";
        return $result;
    }

    public function modifyData(){
    }
}