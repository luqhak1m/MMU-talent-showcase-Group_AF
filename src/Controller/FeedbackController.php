<?php

# Import the necessary MODEL files
require_once __DIR__ . '/../Model/FeedbackModel.php';

# Encapsulate the controller logic in a class
# Name the class according to the function it serves
# Usage example:
#                   $functionController = new FunctionNameController();
#                   $functionController->function1();
class FeedbackController {
	private $feedback_model;

    public function __construct($pdo){ // takes pdo instance as param to avoid reconnecting for every new model, no need to modify
        $this->feedback_model=new FeedbackModel($pdo);
    }
	public function viewFeedback(){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
    
           $Feedback=$_POST['feedback'];
           $UserID=$_SESSION['user_id'];
    
           $this->feedback_model->createFeedback($UserID, $Feedback);
            header("Location: /talent-portal/public/index.php?page=feedback");
       }
        require_once __DIR__ . '/../View/admin/add-feedback-form.php';
	} 
    public function viewAdminFeedback(){
        $feedbacks=$this->feedback_model->fetchAllFeedback();
        require_once __DIR__ . '/../View/admin/manage-feedback.php';

    }
    public function updateAdminFeedback($FeedbackID){
         if ($_SERVER['REQUEST_METHOD']==='POST'){

            $FeedbackStatus=$_POST['feedback_status'];

            $this->feedback_model->updateFeedbackStatus($FeedbackID, $FeedbackStatus);
            header("Location: /talent-portal/public/index.php?page=admin_manage_feedback");
        }
        $feedbacks=$this->feedback_model->fetchAllFeedback();
        require_once __DIR__ . '/../View/admin/manage-feedback.php';

    }
    public function deleteAdminFeedback($FeedbackID){
        if (!empty($FeedbackID)) {
            $deleted = $this->feedback_model->deleteFeedbackByID($FeedbackID); 
            if ($deleted) {
                $_SESSION['success_message'] = "Feedback deleted successfully!";
            } else {
                $_SESSION['error_message'] = "Failed to delete feedback.";
            }
        } else {
            $_SESSION['error_message'] = "Feedback ID missing for deletion.";
        }
        header("Location: " . BASE_URL . "index.php?page=admin_manage_feedback");
        exit; // IMPORTANT: Always exit after header redirect
    }
}