<?php

require_once __DIR__ . '/../../config/database.php'; // get the databse connection using $pdo

class ForumModel {
	private $pdo;

    # Constructor to initialize the database connection
    # Reference: https://www.php.net/manual/en/language.oop5.decon.php
    # To initialize Model object like this: $objectModel = new ObjectModel();
    public function __construct($pdo) {
        $this->pdo=$pdo;
	}

    # Include the functions that interact with the database, CREATE, READ, UPDATE, DELETE (CRUD)
    # ...
    public function createForum($ForumName, $ForumDescription){
        // echo "[INFO] ForumModel.createForum(): Executing <br>";
        $ForumID = generateID();
        $sql = "INSERT INTO Forum (ForumID, ForumName, ForumDescription) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $result=$stmt->execute([$ForumID, $ForumName, $ForumDescription]);
        return $result;
        // echo "[INFO] ForumModel.createForum(): Executed <br>";
    }

    public function fetchAllForum(){
        // echo "[INFO] ForumModel.fetchAllForum(): Executing <br>";
        $sql="SELECT * FROM Forum";
        $stmt = $this->pdo->query($sql);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "[INFO] ForumModel.fetchAllForum(): Executed <br>";
        return $result;
    }

    public function addUserToForum($ForumID){
        // echo "[INFO] ForumModel.createForum(): Executing <br>";
        $FMemberID = generateID();
        if(isset($_SESSION['user_id'])){
            $UserID=$_SESSION['user_id'];
        }
    
        $checkSql="SELECT COUNT(*) FROM ForumMember WHERE ForumID=? AND UserID=?";
        $checkStmt=$this->pdo->prepare($checkSql);
        $checkStmt->execute([$ForumID, $UserID]);
        $exists=$checkStmt->fetchColumn();

        if($exists) {
            echo "user already exists";
            return false; // user already exists
        }

        $sql = "INSERT INTO ForumMember (FMemberID, UserID, ForumID) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $result=$stmt->execute([$FMemberID, $UserID, $ForumID]);
        return $result;
        // echo "[INFO] ForumModel.createForum(): Executed <br>";
    }

    public function fetchForumByForumID($ForumID){
        // echo "[INFO] ForumModel.fetchForumByForumID(): Executing <br>";
        $sql="SELECT * FROM Forum WHERE ForumID=?"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ForumID]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        // echo "[INFO] ForumModel.fetchForumByForumID(): Executed <br>";
        return $result;
    }

    public function fetchForumMembers($ForumID){
        // echo "[INFO] ForumModel.fetchForumMembers(): Executing <br>";
        $sql="SELECT fm.*, u.Username
                FROM ForumMember fm
                JOIN User u ON fm.UserID=u.UserID
                WHERE fm.ForumID=?
        "; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ForumID]);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "[INFO] ForumModel.fetchForumMembers(): Executed <br>";
        return $result;
    }

    public function fetchForumByUserID($UserID){
        // echo "[INFO] ForumModel.fetchForumByUserID(): Executing <br>";
        $sql="SELECT f.*
                FROM ForumMember fm
                JOIN Forum f ON fm.ForumID = f.ForumID
                WHERE fm.UserID = ?
                "; 
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$UserID]);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "[INFO] ForumModel.fetchForumByUserID(): Executed <br>";
        return $result;
    }

    public function createForumPost($ForumID, $FMemberID, $FPostTitle, $FPost){
        // echo "[INFO] ForumModel.createPost(): Executing <br>";
        $FPostID=generateID();
        var_dump($FPostID, $ForumID, $FMemberID, $FPostTitle, $FPost);

        $sql="INSERT INTO ForumPost (FPostID, ForumID, FMemberID, FPostTitle, FPost) VALUES (?, ?, ?, ?, ?)";
        $stmt=$this->pdo->prepare($sql);
        $result=$stmt->execute([$FPostID, $ForumID, $FMemberID, $FPostTitle, $FPost]);
        return $FPostID;
        // echo "[INFO] ForumModel.createPost(): Executed <br>";
    }

    public function fetchAllForumPosts($ForumID){
        // echo "[INFO] ForumModel.fetchAllForumPosts(): Executing <br>";
        $sql="SELECT ForumPost.*, Profile.ProfilePicture, User.Username
                FROM ForumPost
                JOIN ForumMember ON ForumPost.FMemberID = ForumMember.FMemberID
                JOIN Profile ON ForumMember.UserID = Profile.UserID
                JOIN User ON ForumMember.UserID = User.UserID
                WHERE ForumPost.ForumID = ?
            "; 
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$ForumID]);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "[INFO] ForumModel.fetchAllForumPosts(): Executed <br>";
        return $result;
    }

    public function fetchForumMemberID($UserID, $ForumID){
        // echo "[INFO] ForumModel.fetchForumMemberID(): Executing <br>";
        $sql="SELECT FMemberID FROM ForumMember WHERE UserID=? AND ForumID=?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$UserID, $ForumID]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        // echo "[INFO] ForumModel.fetchForumMemberID(): Executed <br>";
        return $result;
    }

    public function fetchForumPostbyForumPostID($FPostID){
        // echo "[INFO] ForumModel.fetchForumPostbyForumPostID(): Executing <br>";
        $sql="SELECT 
                    ForumPost.*, 
                    Profile.ProfilePicture, 
                    User.Username, 
                    Forum.ForumName, 
                    Forum.ForumDescription
                FROM ForumPost
                JOIN ForumMember ON ForumPost.FMemberID = ForumMember.FMemberID
                JOIN Profile ON ForumMember.UserID = Profile.UserID
                JOIN User ON ForumMember.UserID = User.UserID
                JOIN Forum ON ForumPost.ForumID = Forum.ForumID
                WHERE ForumPost.FPostID = ?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$FPostID]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        // echo "[INFO] ForumModel.fetchForumPostbyForumPostID(): Executed <br>";
        return $result;
    }
}