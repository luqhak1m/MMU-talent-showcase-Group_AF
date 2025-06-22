<?php

# Import the necessary MODEL files
require_once __DIR__ . '/../Model/AnnouncementModel.php';

# Encapsulate the controller logic in a class
# Name the class according to the function it serves
# Usage example:
#                   $functionController = new FunctionNameController();
#                   $functionController->function1();
class AnnouncementController {
	private $announcement_model;

    public function __construct($pdo){ // takes pdo instance as param to avoid reconnecting for every new model, no need to modify
        $this->announcement_model=new AnnouncementModel($pdo);
    }

	public function viewAnnouncement(){
        $announcements=$this->announcement_model->fetchAllAnnouncement();
        require_once __DIR__ . '/../View/announcement.php';
	} 
	public function viewAdminAnnouncement(){
        $announcements=$this->announcement_model->fetchAllAnnouncement();
        require_once __DIR__ . '/../View/admin/manage-announcement.php';
	} 
	public function editAdminAnnouncement($AnnouncementID=null){
        if($AnnouncementID!=null){
            // edit announcement
            if ($_SERVER['REQUEST_METHOD']==='POST'){
                echo"not null, post";
                $AnnouncementTitle=$_POST['announcement-title'];
                $Announcement=$_POST['announcement-details'];

                $this->announcement_model->updateAnnouncement($AnnouncementID, $AnnouncementTitle, $Announcement);

                header("Location: /talent-portal/public/index.php?page=admin_manage_announcement");
            }
            $announcement=$this->announcement_model->fetchAnnouncementByAnnouncementID($AnnouncementID);
        }else{
            // create announcement
            if ($_SERVER['REQUEST_METHOD']==='POST'){

                $AnnouncementTitle=$_POST['announcement-title'];
                $Announcement=$_POST['announcement-details'];

                $this->announcement_model->createAnnouncement($AnnouncementTitle, $Announcement);            

                header("Location: /talent-portal/public/index.php?page=admin_manage_announcement");
            }
        }
            
        require_once __DIR__ . '/../View/admin/add-announcement-form.php';
	} 
    public function deleteAdminAnnouncement($AnnouncementID){
        $deleted_announcement_status=$this->announcement_model->deleteAnnouncementByID($AnnouncementID);
        $announcements=$this->announcement_model->fetchAllAnnouncement();
        require_once __DIR__ . '/../View/admin/manage-announcement.php';
    }
}