<?php 
require_once __DIR__ . '/Model/UserModel.php'; 

class UserController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register() {
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

                if ($this->userModel->createUser($userData)) {
                    // Redirect to login page or a success message page
                    header("Location: /user/login?registration=success");
                    exit;
                } else {
                    $errors[] = "Registration failed. Please try again.";
                }
            }
        }
        include __DIR__ . '/View/auth/register.php'; 
    }

}