<?php

require_once __DIR__ . '/../../config/database.php'; // get the databse connection using $pdo

class FeedbackModel {
	private $pdo;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct($pdo) {
        $this->pdo=$pdo;
	}

    # Include the functions that interact with the database, CREATE, READ, UPDATE, DELETE (CRUD)
    # ...
    public function createFeedback($UserID, $Feedback){
        // echo "[INFO] FeedbackModel.createFeedback(): Executing <br>";
        $FeedbackID = generateID();
        $sql="INSERT INTO Feedback (FeedbackID, UserID, Feedback) VALUES (?, ?, ?)";
        $stmt=$this->pdo->prepare($sql);
        $result=$stmt->execute([$FeedbackID, $UserID, $Feedback]);
        return $result;
        // echo "[INFO] FeedbackModel.createFeedback(): Executed <br>";
    }

    public function fetchAllFeedback(){
        // echo "[INFO] FeedbackModel.fetchAllFeedback(): Executing <br>";
        $sql="SELECT Feedback.*, Profile.ProfilePicture, User.Username
                FROM Feedback
                JOIN User ON Feedback.UserID = User.UserID
                JOIN Profile ON Feedback.UserID = Profile.UserID
                ORDER BY FeedbackStatus DESC";
        $stmt = $this->pdo->query($sql);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "[INFO] FeedbackModel.fetchAllFeedback(): Executed <br>";
        return $result;
    }

    public function updateFeedbackStatus($FeedbackID, $FeedbackStatus){
        // echo "[INFO] FeedbackModel.updateFeedbackStatus(): Executing <br>";
        $sql="UPDATE `Feedback` SET FeedbackStatus=? WHERE FeedbackID=?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$FeedbackStatus, $FeedbackID]);
        // echo "[INFO] FeedbackModel.updateFeedbackStatus(): Executed <br>";
    }

    
}