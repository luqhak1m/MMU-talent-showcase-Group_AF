<?php

# Import the necessary MODEL files
require_once __DIR__ . '/../Model/TalentModel.php';
require_once __DIR__ . '/../Model/CatalogueModel.php';
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

    public function __construct($pdo){
        $this->catalogue_model=new CatalogueModel($pdo);
        $this->talent_model=new TalentModel($pdo, $this->catalogue_model);
    }
	public function viewUserTalent(){
        echo "[INFO] TalentController.viewTalent(): Executing <br>";

        
	} 

    public function viewTalent(){
        # echo "[INFO] TalentController.submitTalent(): Executing <br>";

        if($_SERVER['REQUEST_METHOD']==='POST'){
            # echo "[INFO] Talent submission POST received:<br>";
            
            $UserID=$_SESSION['user_id'];
            
            $TalentTitle=$_POST['TalentTitle'];
            $TalentDescription=$_POST['TalentDescription'];
            $Price=$_POST['Price'];
            $TalentLikes=$_POST['TalentLikes'];
            $Category=$_POST['Category'];
            $CatalogueID=$this->catalogue_model->fetchCatalogueByUserID($UserID);
            
            // echo "UserID: $UserID<br>";
            // echo "TalentTitle: $TalentTitle<br>";
            // echo "TalentDescription: $TalentDescription<br>";
            // echo "Price: $Price<br>";
            // echo "Content: $Content<br>";
            // echo "TalentLikes: $TalentLikes<br>";
            // echo "Category: $Category<br>";
            // echo "Catalogue ID: $CatalogueID<br>";

            // echo '<pre>';
            // print_r($_FILES);
            // echo '</pre>';


            $content_filename=uploadMedia($UserID, 'Content');
            $this->talent_model->createTalent($UserID, $CatalogueID, $TalentTitle, $TalentDescription, $Price, $content_filename, $TalentLikes, $Category);
            header("Location: /talent-portal/public/index.php?page=portfolio");
        }else{
            # echo "[INFO] No talent submission POST received<br>";
        }

        if(isset($_SESSION['user_id'])) {
            $UserID=$_SESSION['user_id'];
            $fetched_talent=$this->talent_model->fetchTalentByUserID($UserID);
            # echo "[INFO] Found ".count($fetched_talent)." talent(s) for user ".$_SESSION['username']."<br>";

        }else {
            # echo "[INFO] No session";
        }

        require_once __DIR__ . '/../View/portfolio.php';
    }

    public function viewSpecificTalent($TalentID){
        $talent=$this->talent_model->fetchTalentByTalentID($TalentID);
        # echo "[INFO] Found talent ID ".$talent['TalentID']."<br>";
        require_once __DIR__ . '/../View/talent.php';
    }

    public function deleteTalent($TalentID){
        $deleted_talent_status=$this->talent_model->deleteTalentByID($TalentID);
        if(isset($_SESSION['user_id'])) {
            $UserID=$_SESSION['user_id'];
            $fetched_talent=$this->talent_model->fetchTalentByUserID($UserID);
            # echo "[INFO] Found ".count($fetched_talent)." talent(s) for user ".$_SESSION['username']."<br>";
        }else {
            # echo "[INFO] No session";
        }        
        require_once __DIR__ . '/../View/portfolio.php';
    }
}