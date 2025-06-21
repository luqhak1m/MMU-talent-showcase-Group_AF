<?php

require_once __DIR__ . '/../../config/database.php'; // get the databse connection using $pdo

class AnnouncementModel {
	private $pdo;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct($pdo) {
        $this->pdo=$pdo;
	}

    # Include the functions that interact with the database, CREATE, READ, UPDATE, DELETE (CRUD)
    # ...
    public function createAnnouncement($AnnouncementTitle, $Announcement){
        // echo "[INFO] AnnouncementModel.createAnnouncement(): Executing <br>";
        $AnnouncementID = generateID();
        $sql="INSERT INTO Announcement (AnnouncementID, AnnouncementTitle, Announcement) VALUES (?, ?, ?)";
        $stmt=$this->pdo->prepare($sql);
        $result=$stmt->execute([$AnnouncementID, $AnnouncementTitle, $Announcement]);
        return $result;
        // echo "[INFO] AnnouncementModel.createAnnouncement(): Executed <br>";
    }

    public function fetchAllAnnouncement(){
        // echo "[INFO] AnnouncementModel.fetchAllAnnouncement(): Executing <br>";
        $sql="SELECT * FROM Announcement ORDER BY AnnouncementTimestamp DESC";
        $stmt = $this->pdo->query($sql);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "[INFO] AnnouncementModel.fetchAllAnnouncement(): Executed <br>";
        return $result;
    }

    public function fetchAnnouncementByAnnouncementID($AnnouncementID){
        // echo "[INFO] AnnouncementModel.fetchAnnouncementByAnnouncementID(): Executing <br>";
        $sql="SELECT * FROM Announcement WHERE AnnouncementID=?"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$AnnouncementID]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        // echo "[INFO] AnnouncementModel.fetchAnnouncementByAnnouncementID(): Executed <br>";
        return $result;
    }

    public function deleteAnnouncementByID($AnnouncementID){
        // echo "[INFO] AnnouncementModel.deleteAnnouncementByID(): Executing <br>";
        $sql="DELETE FROM Announcement WHERE AnnouncementID=?";
        $stmt=$this->pdo->prepare($sql);
        $result=$stmt->execute([$AnnouncementID]);
        // echo "[INFO] AnnouncementModel.deleteAnnouncementByID(): Executed <br>";
        return $result;
    }
}