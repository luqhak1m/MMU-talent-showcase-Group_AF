
<?php

# Import the necessary MODEL files
require_once __DIR__ . '/../Model/ProfileModel.php';

# Encapsulate the controller logic in a class
# Name the class according to the function it serves
# Usage example:
#                   $functionController = new FunctionNameController();
#                   $functionController->function1();
class ProfileController {

    private $profile_model;

    public function __construct($dbCredentials){
        $this->profile_model=new ProfileModel($dbCredentials);
    }

	public function viewProfile(){
        echo "[INFO] ProfileController.viewProfile(): Executing <br>";

        if($_SERVER['REQUEST_METHOD']==='POST') {
            echo "[INFO] POST received:<br>";
            $first_name=$_POST['firstname-input'];
            $last_name=$_POST['lastname-input'];
            $address=$_POST['address-input'];
            $gender=$_POST['gender-input'];
            $dob=$_POST['dob-input'];
            $phone_num=$_POST['phonenumber-input'];
            $bio=$_POST['bio-input'];
            $userID=$_SESSION['user_id'];

            // echo "<pre>";
            // echo "First Name: " . htmlspecialchars($first_name) . "<br>";
            // echo "Last Name: " . htmlspecialchars($last_name) . "<br>";
            // echo "Address: " . htmlspecialchars($address) . "<br>";
            // echo "Gender: " . htmlspecialchars($gender) . "<br>";
            // echo "DOB: " . htmlspecialchars($dob) . "<br>";
            // echo "Phone Number: " . htmlspecialchars($phone_num) . "<br>";
            // echo "Bio: " . htmlspecialchars($bio) . "<br>";
            // echo "User ID (from session): " . htmlspecialchars($userID) . "<br>";
            // echo "</pre>";

            // upload pfp
            $upload_dir=__DIR__.'/../../public/images/';
            $user_id=$_SESSION['user_id'];
            if (!empty($_FILES['profilepicture-input']['name'])) {
                $filename=$_FILES['profilepicture-input']['name'];
                $extension=pathinfo($filename, PATHINFO_EXTENSION);
                $unique_name=$user_id.'_'.date('YmdHis').'.'.$extension;

                $target_file = $upload_dir . $unique_name;

                if (move_uploaded_file($_FILES['profilepicture-input']['tmp_name'], $target_file)) {
                    $profile_picture = $unique_name;
                    echo "[INFO] File uploaded successfully: $profile_picture";
                } else {
                    echo "[ERROR] Failed to move uploaded file.";
                }
            }else{ 
                $existing_profile = $this->profile_model->fetchProfileDetails($user_id);
                $profile_picture = $existing_profile['ProfilePicture'] ?? null;
            }
            $this->profile_model->updateProfile($user_id, $first_name, $last_name, $address, $gender, $dob, $phone_num, $profile_picture, $bio);
            echo "[INFO] Profile Updated";
            // header("Location: /talent-portal/public/index.php?page=profile");
        } else {
            echo "[INFO] No POST received.";
        }

        if(isset($_SESSION['user_id'])) {
            $UserID=$_SESSION['user_id'];
            $fetched_profile=$this->profile_model->fetchProfileDetails($UserID);
            echo "[INFO] Found profile for user ".$_SESSION['username']."<br>";

        }else {
            echo "[INFO] No session";
        }

        include __DIR__ . '/../View/profile.php'; 
	} 
}