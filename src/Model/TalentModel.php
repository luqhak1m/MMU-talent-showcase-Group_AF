<?php

require_once __DIR__ . '/../../config/database.php'; // get the databse connection using $pdo
require_once __DIR__ . '/../../includes/ID-Generator.inc.php'; // to get the generateID() function
require_once __DIR__ . '/CatalogueModel.php'; // to get the generateID() function

class TalentModel {
	private $pdo;
    private $catalogue_model;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct($pdo, CatalogueModel $catalogue_model) {
        $this->pdo=$pdo;
        $this->catalogue_model=$catalogue_model;
	}

    # Include the functions that interact with the database, CREATE, READ, UPDATE, DELETE (CRUD)
    # ...
    public function createTalent($UserID, $CatalogueID, $TalentTitle, $TalentDescription, $Price, $Content, $TalentLikes, $Category){
        // echo "[INFO] TalentModel.createTalent(): Executing <br>";
        $TalentID=generateID();
        $CatalogueID=$this->catalogue_model->fetchCatalogueByUserID($UserID);
        $sql="INSERT INTO Talent (TalentID, UserID, CatalogueID, TalentTitle, TalentDescription, Price, Content, TalentLikes, Category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$TalentID, $UserID, $CatalogueID, $TalentTitle, $TalentDescription, $Price, $Content, $TalentLikes, $Category]);
        // echo "[INFO] TalentModel.createTalent(): Executed <br>";
    }

    public function fetchTalentByUserID($UserID){
        // echo "[INFO] TalentModel.fetchTalentByUserID(): Executing <br>";
        $sql="SELECT * FROM Talent WHERE UserID=?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$UserID]);
        // echo "[INFO] TalentModel.fetchTalentByUserID(): Executed <br>";
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchTalentByTalentID($TalentID){
        // echo "[INFO] TalentModel.fetchTalentByTalentID(): Executing <br>";
        $sql="SELECT * FROM Talent WHERE TalentID=?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$TalentID]);
        // echo "[INFO] TalentModel.fetchTalentByTalentID(): Executed <br>";
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteTalentByID($TalentID){
        // echo "[INFO] TalentModel.deleteTalent(): Executing <br>";
        $sql="DELETE FROM Talent WHERE TalentID=?";
        $stmt=$this->pdo->prepare($sql);
        $result=$stmt->execute([$TalentID]);
        // echo "[INFO] TalentModel.deleteTalent(): Executed <br>";
        return $result;
    }

    public function modifyData(){
    }
}