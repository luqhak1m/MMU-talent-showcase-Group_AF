<?php

# Import the necessary MODEL files
require_once __DIR__ . '/../Model/TalentModel.php';
require_once __DIR__ . '/../Model/CatalogueModel.php';
require_once __DIR__ . '/../Model/ProfileModel.php';
require_once __DIR__ . '/CatalogueController.php';
require_once __DIR__ . '/../../includes/MediaUpload.inc.php';


# Encapsulate the controller logic in a class
# Name the class according to the function it serves
# Usage example:
#                   $functionController = new FunctionNameController();
#                   $functionController->function1();
class TalentController {
	private $talent_model;
	private $catalogue_model;
    private $profile_model;

    public function __construct($pdo){
        $this->profile_model=new ProfileModel($pdo);
        $this->catalogue_model=new CatalogueModel($pdo);
        $this->talent_model=new TalentModel($pdo, $this->catalogue_model);
    }

    public function viewTalent(){
        // echo "[INFO] TalentController.submitTalent(): Executing <br>";

        if($_SERVER['REQUEST_METHOD']==='POST'){
            echo "[INFO] Talent submission POST received:<br>";
            
            $UserID=$_SESSION['user_id'];
            
            $TalentTitle=$_POST['TalentTitle'];
            $TalentDescription=$_POST['TalentDescription'];
            $Price=$_POST['Price'];
            $Category=$_POST['Category'];
            $CatalogueID=$this->catalogue_model->fetchCatalogueByUserID($UserID);
            
            echo "UserID: $UserID<br>";
            echo "TalentTitle: $TalentTitle<br>";
            echo "TalentDescription: $TalentDescription<br>";
            echo "Price: $Price<br>";
            echo "Content: $Content<br>";
            echo "Category: $Category<br>";
            echo "Catalogue ID: $CatalogueID<br>";

            echo '<pre>';
            print_r($_FILES);
            echo '</pre>';

            $content_filename=uploadMedia($UserID, 'Content');
            $this->talent_model->createTalent($UserID, $CatalogueID, $TalentTitle, $TalentDescription, $Price, $content_filename, $Category);
            if(isset($_SESSION['user_id']) && isset($_POST['user_id'])) {
                $UserID=$_SESSION['user_id'];
                $fetched_talent=$this->talent_model->fetchTalentByUserID($UserID);
                $profile_picture=$this->profile_model->fetchProfile($UserID)['ProfilePicture'];
                // echo "[INFO] Found ".count($fetched_talent)." talent(s) for user ".$_SESSION['username']."<br>";

            }else {
                echo "[INFO] No session";
            }
            header("Location: /talent-portal/public/index.php?page=talent");
        }else{
            // echo "[INFO] No talent submission POST received<br>";
        }

        // if(isset($_SESSION['user_id'])) {
            
            $UserID=$_SESSION['user_id'];
            // $fetched_talent=$this->talent_model->fetchTalentByUserID($UserID);
            $fetched_talent=$this->talent_model->fetchTalentByUserID($UserID);
            $profile_picture=$this->profile_model->fetchProfile($UserID)['ProfilePicture'];
            // echo "[INFO] Found ".count($fetched_talent)." talent(s) for user ".$_SESSION['username']."<br>";
        // }else {
            //     echo "[INFO] No session";
            // }


        require_once __DIR__ . '/../View/portfolio.php';
    }

    public function viewSpecificTalent($TalentID){
        $talent=$this->talent_model->fetchTalentByTalentID($TalentID);
        $comments=$this->talent_model->fetchAllCommentsByTalentID($TalentID);
        // var_dump($comments);
        # echo "[INFO] Found talent ID ".$talent['TalentID']."<br>";
        if(isset($_SESSION['user_id'])) {
            $UserID=$_SESSION['user_id'];
            $fetched_talent=$this->talent_model->fetchTalentByUserID($UserID);
            $profile_picture=$this->profile_model->fetchProfile($UserID)['ProfilePicture'];
            # echo "[INFO] Found ".count($fetched_talent)." talent(s) for user ".$_SESSION['username']."<br>";
        }else {
            # echo "[INFO] No session";
        }   
        require_once __DIR__ . '/../View/talent.php';
    }

    public function deleteTalent($TalentID){
        $deleted_talent_status=$this->talent_model->deleteTalentByID($TalentID);
        if(isset($_SESSION['user_id'])) {
            $UserID=$_SESSION['user_id'];
            $fetched_talent=$this->talent_model->fetchTalentByUserID($UserID);
            $profile_picture=$this->profile_model->fetchProfile($UserID)['ProfilePicture'];
            # echo "[INFO] Found ".count($fetched_talent)." talent(s) for user ".$_SESSION['username']."<br>";
        }else {
            # echo "[INFO] No session";
        }        
        require_once __DIR__ . '/../View/portfolio.php';
    }

    public function editTalent($TalentID){

        if(isset($_SESSION['user_id'])) {
            $UserID=$_SESSION['user_id'];
            $fetched_talent=$this->talent_model->fetchTalentByUserID($UserID);
            $profile_picture=$this->profile_model->fetchProfile($UserID)['ProfilePicture'];
            # echo "[INFO] Found ".count($fetched_talent)." talent(s) for user ".$_SESSION['username']."<br>";
        }else {
            # echo "[INFO] No session";
        }      

        # echo "[INFO] TalentController.submitTalent(): Executing <br>";
        $fetched_talent=$this->talent_model->fetchTalentByTalentID($TalentID);
        $profile_picture=$this->profile_model->fetchProfile($UserID)['ProfilePicture'];

        // foreach ($fetched_talent as $key => $value) {
        //     echo $key . ' => ' . $value . '<br>';
        // }
        if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['id'])){
            # echo "[INFO] Talent submission POST received:<br>";
            
            $UserID=$_SESSION['user_id'];
            $TalentTitle=$_POST['TalentTitle'];
            $TalentDescription=$_POST['TalentDescription'];
            $Price=$_POST['Price'];
            $Category=$_POST['Category'];
        
            $Content=uploadMedia($UserID, "Content"); // params: user_id and html input id

            if(!$Content){
                $Content=$fetched_talent['Content']??null;
            }

            $this->talent_model->updateTalent($TalentID, $TalentTitle, $TalentDescription, $Price, $Content, $Category);
            header("Location: /talent-portal/public/index.php?page=talent&id=".htmlspecialchars($TalentID));
        }else{
            require_once __DIR__ . '/../View/add-talent-form.php';
        }
    }

    public function likeTalent($TalentID){
        $talent=$this->talent_model->fetchTalentByTalentID($TalentID);
        $newLikeCount=$talent['TalentLikes']+1;
        $this->talent_model->updateLikeCount($TalentID, $newLikeCount);
        header("Location: /talent-portal/public/index.php?page=talent&id=".htmlspecialchars($TalentID));
    }

    public function addComment($TalentID){

        if($_SERVER['REQUEST_METHOD']==='POST'){
    
            echo "[INFO] POST received:<br>";
            $comment=$_POST['comment'];
            if(isset($_SESSION['user_id'])){
	            $UserID=$_SESSION['user_id'];
            }
            
            $this->talent_model->createComment($TalentID, $UserID, $comment);

            header("Location: /talent-portal/public/index.php?page=talent&id=".htmlspecialchars($TalentID));
            // $forum=$this->forum_model->fetchForumByForumID($ForumID);
            // $forum_members=$this->forum_model->fetchForumMembers($ForumID);
            // $forum_posts=$this->forum_model->fetchAllForumPosts($ForumID);
            // include __DIR__ . '/../View/forum-feed.php';
        }        
    }
}