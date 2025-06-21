<?php

require_once __DIR__ . '/../../config/database.php'; // get the databse connection using $pdo

class FAQModel {
	private $pdo;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct($pdo) {
        $this->pdo=$pdo;
	}

    # Include the functions that interact with the database, CREATE, READ, UPDATE, DELETE (CRUD)
    # ...
    public function createFAQ($Question){
        // echo "[INFO] FAQModel.createFAQ(): Executing <br>";
        $FAQID = generateID();
        $sql="INSERT INTO FAQ (FAQID, Question) VALUES (?, ?)";
        $stmt=$this->pdo->prepare($sql);
        $result=$stmt->execute([$FAQID, $Question]);
        return $result;
        // echo "[INFO] FAQModel.createFAQ(): Executed <br>";
    }

    public function fetchAllFAQ(){
        // echo "[INFO] FAQModel.fetchAllFAQ(): Executing <br>";
        $sql="SELECT * FROM FAQ";
        $stmt = $this->pdo->query($sql);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "[INFO] FAQModel.fetchAllFAQ(): Executed <br>";
        return $result;
    }

    public function updateFAQ($FAQID, $Answer){
        // echo "[INFO] FAQModel.updateFAQ(): Executing <br>";
        $sql="UPDATE `FAQ` SET Answer=? WHERE FAQID=?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$Answer, $FAQID]);
        echo "[INFO] FAQModel.updateFAQ(): Executed <br>";
    }

    public function modifyData(){
    }
}