<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/database_config.php';
require_once __DIR__ . '/../Model/UserModel.php'; 
require_once __DIR__ . '/../Model/ProfileModel.php'; 
require_once __DIR__ . '/../Model/CatalogueModel.php'; 
//  echo "[INFO] Loaded AuthController.php <br>";


class UserController {

    private $userModel;
    private $profile_model;
    private $catalogue_model;

    public function __construct($pdo) {
        // echo "[INFO] UserController.__construct(): Executing <br>";

        $this->profile_model=new ProfileModel($pdo);
        $this->catalogue_model=new CatalogueModel($pdo);
        $this->userModel = new UserModel($pdo, $this->profile_model, $this->catalogue_model);
    }

    // public function so we can access outside of this class (in index.php mostly)
    public function register() {
        // echo "[INFO] Register(): Executing <br>";

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            // --- Basic Validation ---
            if (empty($name)) {
                $errors[] = "Name is required.";
            }
            if (empty($email)) {
                $errors[] = "Email is required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            } else {
                // Check if email already exists
                if ($this->userModel->findUserByEmail($email)) {
                    $errors[] = "Email already registered.";
                }
            }
            if (empty($password)) {
                $errors[] = "Password is required.";
            } elseif (strlen($password) < 6) { // Example: minimum length
                $errors[] = "Password must be at least 6 characters long.";
            }
            if ($password !== $confirm_password) {
                $errors[] = "Passwords do not match.";
            }
            // --- End Validation ---

            if (empty($errors)) {
                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $userData = [
                    'Username' => $name, 
                    'Email' => $email,
                    'Password' => $hashedPassword, 
                    'Role' => 'User',                
                ];
                // echo "[INFO] Creating User <br>";

                if ($this->userModel->createUser($userData)) {
                    // echo "[INFO] Created User <br>";
                    $user = $this->userModel->findUserByEmail($email);
                    // echo "[INFO] Found User".$user."<br>";

                    if ($user) {
                        session_start();
                        $_SESSION['user_id'] = $user['UserID'];
                        $_SESSION['username'] = $user['Username'];
                        $_SESSION['role'] = $user['Role'];

                        // Redirect to dashboard or homepage
                        header("Location: /index.php?page=home");
                        exit;
                    }
                    exit;
                } else {
                    $errors[] = "Registration failed. Please try again.";
                }
            }
        }
        include __DIR__ . '/../View/register.php'; 

    }

    public function login(){
        $login_error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $user = $this->userModel->findUserByEmail($email);
            var_dump($user);

            // Check if user exists AND the password is correct
            if ($user && password_verify($password, $user['Password'])) {
                
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['username'] = $user['Username'];
                $_SESSION['role'] = $user['Role'];

                if ($user['Role'] === 'Admin') {
                    $_SESSION['is_admin'] = true;
                    header("Location: index.php?page=admin_dashboard");
                } else {
                    header("Location: index.php?page=home");
                }
                exit;

            } else {
                // If login fails, set an error message.
                $login_error = "Invalid email or password.";
            }
        }
        include __DIR__ . '/../View/login.php';
    }

    public function logout() {
        // Ensure the session is started before trying to modify it
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Unset all session variables
        $_SESSION = array();

        // Destroy the session completely
        session_destroy();

        // Redirect the user to the homepage 
        header("Location: index.php");
        exit;
    }

    // public function logout(){
    //     session_start(); 
    //     session_unset();
    //     session_destroy();

    //     if (ini_get("session.use_cookies")) {
    //         $params = session_get_cookie_params();
    //         setcookie(session_name(), '', time() - 42000,
    //             $params["path"], $params["domain"],
    //             $params["secure"], $params["httponly"]
    //         );
    //     }

    //     header("Location: /talent-portal/public/index.php"); 
    //     exit;
    // }

    public function followUser($FollowerID, $FollowingID, $TalentID=null){
        echo "executing followuser";
        $this->userModel->followUser($FollowerID, $FollowingID);
        if($TalentID===null){
            $url="index.php?page=talent&id=".urlencode($FollowingID)."&action=portfolio";
        }else {
            $url="index.php?page=talent&id=".urlencode($TalentID);
        }
        echo "executed followuser bye".$url ;
        header("Location: $url");
    }


}