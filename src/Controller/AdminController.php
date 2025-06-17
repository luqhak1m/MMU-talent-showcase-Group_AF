<?php // src/Controller/AdminController.php

require_once __DIR__ . '/.../Model/UserModel.php'; // Using UserModel as admins are users with a role
require_once __DIR__ . '/../Model/ProfileModel.php';

class AdminController {
    private $userModel;
    private $profileModel; 

    public function __construct($dbCredentials) {
        $this->userModel = new UserModel($dbCredentials);
        // This line was missing. It creates the ProfileModel.
        $this->profileModel = new ProfileModel($dbCredentials);
    }

    public function login() {
        $login_error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $user = $this->userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user['Password']) && $user['Role'] === 'Admin') {
                if (session_status() == PHP_SESSION_NONE) { session_start(); }
                $_SESSION['admin_id'] = $user['UserID'];
                $_SESSION['admin_name'] = $user['Username'];
                $_SESSION['is_admin'] = true;

                header("Location: /talent-portal/public/index.php?page=admin_dashboard");
                exit;
            } else {
                $login_error = "Invalid credentials or not an admin.";
            }
        }
        include __DIR__ . '/../View/admin/login.php';
    }

    public function dashboard() {
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: /talent-portal/public/index.php?page=admin_login");
            exit;
        }
        $users = $this->userModel->getAllUsers();
        include __DIR__ . '/../View/admin/dashboard.php';
    }

    public function viewUserProfile() {
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: /talent-portal/public/index.php?page=admin_login");
            exit;
        }
        $userIdToView = $_GET['user_id'] ?? null;
        if (!$userIdToView) { die("User ID is required."); }

        // This will now work because $this->profileModel exists
        $fetched_profile = $this->profileModel->fetchProfileDetails($userIdToView);
        include __DIR__ . '/../View/profile.php';
    }

    public function editUserProfile() {
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: /talent-portal/public/index.php?page=admin_login");
            exit;
        }
        
        $userIdToEdit = $_GET['user_id'] ?? ($_POST['user_id'] ?? null);
        if (!$userIdToEdit) { die("User ID is required."); }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['firstname-input'];
            $lastName = $_POST['lastname-input'];
            $address = $_POST['address-input'];
            $gender = $_POST['gender-input'];
            $dob = $_POST['dob-input'];
            $phoneNum = $_POST['phonenumber-input'];
            $bio = $_POST['bio-input'];
            
            require_once __DIR__ . '/../../includes/MediaUpload.inc.php';
            $profilePicture = uploadMedia($userIdToEdit, "profilepicture-input");
            if (!$profilePicture) {
                $existing_profile = $this->profileModel->fetchProfileDetails($userIdToEdit);
                $profilePicture = $existing_profile['ProfilePicture'] ?? null;
            }

            // This will now work because $this->profileModel exists
            $this->profileModel->updateProfile($userIdToEdit, $firstName, $lastName, $address, $gender, $dob, $phoneNum, $profilePicture, $bio);

            header("Location: /talent-portal/public/index.php?page=admin_dashboard");
            exit;
        }

        // This will also now work
        $fetched_profile = $this->profileModel->fetchProfileDetails($userIdToEdit);
        include __DIR__ . '/../View/profile.php';
    }
    // insert other admin methods later, e.g., manage users, view reports, etc.
}