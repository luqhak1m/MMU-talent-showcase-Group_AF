<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/database_config.php';
require_once __DIR__ . '/../Model/UserModel.php'; 
echo "[INFO] Loaded AuthController.php <br>";


class UserController {

    private $userModel;

    public function __construct($dbCredentials) {
        echo "[INFO] UserController.__construct(): Executing <br>";

        $this->userModel = new UserModel($dbCredentials);
    }

    // public function so we can access outside of this class (in index.php mostly)
    public function register() {
        echo "[INFO] Register(): Executing <br>";

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
                echo "[INFO] Creating User <br>";

                if ($this->userModel->createUser($userData)) {
                    echo "[INFO] Created User <br>";
                    $user = $this->userModel->findUserByEmail($email);
                    echo "[INFO] Found User".$user."<br>";

                    if ($user) {
                        session_start();
                        $_SESSION['user_id'] = $user['UserID'];
                        $_SESSION['username'] = $user['Username'];
                        $_SESSION['role'] = $user['Role'];

                        // Redirect to dashboard or homepage
                        header("Location: /talent-portal/public/index.php?page=home");
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
        echo "[INFO] UserController.login(): Executing <br>";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $user = $this->userModel->findUserByEmail($email);
            if ($user) {
                echo "[INFO] Found user during login <br>";

                session_start();
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['username'] = $user['Username'];
                $_SESSION['role'] = $user['Role'];
    
                // Redirect to dashboard or homepage
                header("Location: /talent-portal/public/index.php?page=home");
                exit;
            }else{
                echo "[INFO] Cannot find user during login <br>";

            }
            exit;
        }
        include __DIR__ . '/../View/login.php'; 


    }

}