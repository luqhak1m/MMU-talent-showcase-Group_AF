<?php

# Import the necessary MODEL files
require_once __DIR__ . '/../Model/FAQModel.php';

# Encapsulate the controller logic in a class
# Name the class according to the function it serves
# Usage example:
#                   $functionController = new FunctionNameController();
#                   $functionController->function1();
class FAQController {
	private $faq_model;

    public function __construct($pdo){ // takes pdo instance as param to avoid reconnecting for every new model, no need to modify
        $this->faq_model=new FAQModel($pdo);
    }
	public function viewFAQ(){
        if ($_SERVER['REQUEST_METHOD']==='POST'){

            $Question=$_POST['question'];
            $this->faq_model->createFAQ($Question);
            header("Location: ". BASE_URL . "index.php?page=faq");

        }
        $FAQs=$this->faq_model->fetchAllFAQ();
        require_once __DIR__ . '/../View/faq.php';
	} 

    public function viewAdminFAQ(){
        $faq=$this->faq_model->fetchAllFAQ();
        require_once __DIR__ . '/../View/admin/manage-faq.php';
	}

    public function addFAQ(){
        require_once __DIR__ . '/../View/add-faq-form.php';
    }

    public function UpdateAdminFAQ($FAQID=null){
        if ($_SERVER['REQUEST_METHOD']==='POST'&&isset($FAQID)){
            $Answer=$_POST['answer'];
            $this->faq_model->updateFAQ($FAQID, $Answer);
            header("Location: ". BASE_URL . "index.php?page=admin_manage_faq");
            
        }
        $FAQs=$this->faq_model->fetchAllFAQ();
        require_once __DIR__ . '/../View/admin/manage-faq.php';
    }

    public function deleteAdminFAQ($FAQID){
        $deleted_faq_status=$this->faq_model->deleteFAQByID($FAQID);
        $faq=$this->faq_model->fetchAllFAQ();
        require_once __DIR__ . '/../View/admin/manage-faq.php';
    }
}