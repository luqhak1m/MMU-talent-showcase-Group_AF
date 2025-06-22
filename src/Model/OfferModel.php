<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/ID-Generator.inc.php'; 

class OfferModel {
	private $pdo;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct($pdo) {
        $this->pdo=$pdo;
	}


    public function createOffer($UserID, $TalentID, $OfferDetails){
        $OfferID = generateID();
        $sql = "INSERT INTO Offer (OfferID, UserID, TalentID, OfferDetails)
        VALUES (?, ?, ?, ?)";
        $stmt= $this->pdo->prepare($sql);
        $result = $stmt->execute([$OfferID, $UserID, $TalentID, $OfferDetails]);
        echo '[DEBUG] Offer Data Inserted';
        return $result;
    }

}