<?php

# Import the necessary MODEL files
require_once __DIR__ . '/../Model/ForumModel.php';

# Encapsulate the controller logic in a class
# Name the class according to the function it serves
# Usage example:
#                   $functionController = new FunctionNameController();
#                   $functionController->function1();
class ForumController {
	private $forum_model;

    public function __construct($pdo){ // takes pdo instance as param to avoid reconnecting for every new model, no need to modify
        $this->forum_model=new ForumModel($pdo);
    }
	public function browseForum() {

         if($_SERVER['REQUEST_METHOD']==='POST'){
            echo "[INFO] POST received:<br>";
            $forum_name=$_POST['forum-name'];
            $forum_description=$_POST['forum-description'];

            $this->forum_model->createForum($forum_name, $forum_description);
            header("Location: " . BASE_URL . "index.php?page=forum");
         }

        $fetched_forums=$this->forum_model->fetchAllForum();
        var_dump($fetched_forums);
        include __DIR__ . '/../View/forum.php';
	} 

    public function joinForum($ForumID){
        $this->forum_model->addUserToForum($ForumID);
        $fetched_forums=$this->forum_model->fetchAllForum();
        include __DIR__ . '/../View/forum.php';
    }

    public function viewForumDetails($ForumID){
        $forum=$this->forum_model->fetchForumByForumID($ForumID);
        $forum_members=$this->forum_model->fetchForumMembers($ForumID);
        $forum_posts=$this->forum_model->fetchAllForumPosts($ForumID);

        // print_r($forum_posts);

        include __DIR__ . '/../View/forum-feed.php';
    }

    public function viewJoinedForums($UserID){
        $fetched_forums=$this->forum_model->fetchForumByUserID($UserID);
        include __DIR__ . '/../View/forum-joined.php';
    }
    
    public function createForum(){
        include __DIR__ . '/../View/add-forum-form.php';
    }

    public function createForumPost($ForumID){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            echo "[INFO] POST received:<br>";
            $forum_post_title=$_POST['forum_post_title'];
            $forum_post=$_POST['forum_post'];
            if(isset($_SESSION['user_id'])){
	            $UserID=$_SESSION['user_id'];
            }
            // echo "forumid".$ForumID;
            // echo "forumid".$UserID;
            $forum_member_id=$this->forum_model->fetchForumMemberID($UserID, $ForumID)['FMemberID'];

            $FPostID=$this->forum_model->createForumPost($ForumID, $forum_member_id, $forum_post_title, $forum_post);

            header("Location: " . BASE_URL . "index.php?page=forum-post&id=".$FPostID."&action=view");
            // $forum=$this->forum_model->fetchForumByForumID($ForumID);
            // $forum_members=$this->forum_model->fetchForumMembers($ForumID);
            // $forum_posts=$this->forum_model->fetchAllForumPosts($ForumID);
            // include __DIR__ . '/../View/forum-feed.php';
        }
        include __DIR__ . '/../View/add-forum-post-form.php';
    }

    public function viewForumPostDetails($FPostID){
        $fetched_forum_post=$this->forum_model->fetchForumPostbyForumPostID($FPostID);
        $forum_members=$this->forum_model->fetchForumMembers($fetched_forum_post['ForumID']);
        $fetched_comments=$this->forum_model->fetchAllCommentsByForumPostID($FPostID);

        include __DIR__ . '/../View/forum-post-details.php';
    }

    public function likeForumPost($FPostID){
        $fetched_forum_post=$this->forum_model->fetchForumPostbyForumPostID($FPostID);
        $newLikeCount=$fetched_forum_post['FPostLikes']+1;
        $this->forum_model->updateLikeCount($FPostID, $newLikeCount);
        $forum_members=$this->forum_model->fetchForumMembers($fetched_forum_post['ForumID']);
        header("Location: " . BASE_URL . "index.php?page=forum-post&id=".htmlspecialchars($FPostID)."&action=view");
    }

    public function addComment($FPostID){

        if($_SERVER['REQUEST_METHOD']==='POST'){
    
            echo "[INFO] POST received:<br>";
            $comment=$_POST['comment'];
            if(isset($_SESSION['user_id'])){
	            $UserID=$_SESSION['user_id'];
            }
            $ForumID=$this->forum_model->fetchForumIDByForumPostID($FPostID)['ForumID'];
            // echo "forumid ".$ForumID;
            $FMemberID=$this->forum_model->fetchForumMemberID($UserID, $ForumID)['FMemberID'];
            // echo "forumid ".$UserID;

            $this->forum_model->createComment($UserID, $FPostID, $FMemberID, $comment);

            header("Location: " . BASE_URL . "index.php?page=forum-post&id=".htmlspecialchars($FPostID)."&action=view");
            // $forum=$this->forum_model->fetchForumByForumID($ForumID);
            // $forum_members=$this->forum_model->fetchForumMembers($ForumID);
            // $forum_posts=$this->forum_model->fetchAllForumPosts($ForumID);
            // include __DIR__ . '/../View/forum-feed.php';
        }        
    }

    
}