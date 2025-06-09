<?php // src/Controller/AdminController.php

require_once __DIR__ . '/Model/UserModel.php'; // Using UserModel as admins are users with a role

class AdminController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        $login_error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $login_error = "Email and Password are required.";
            } else {
                // Using the same model method as user login, but will check the role.
                $adminUser = $this->userModel->getUserByEmailForLogin($email); // for User table fields

                if ($adminUser && password_verify($password, $adminUser['Password'])) {
                    if ($adminUser['Role'] === 'Admin') { // Verify the 'Role' is 'Admin'
                        session_start(); // Ensure session is started
                        $_SESSION['admin_id'] = $adminUser['UserID'];
                        $_SESSION['admin_name'] = $adminUser['Username'];
                        $_SESSION['admin_role'] = $adminUser['Role'];

                        // Redirect to admin dashboard 
                        header("Location: /admin/dashboard");
                        exit;
                    } else {
                        // User exists but is not an admin
                        $login_error = "Access denied. Not an authorized admin.";
                    }
                } else {
                    $login_error = "Invalid email or password.";
                }
            }
        }
        include __DIR__ . '/../View/Admin/login.php'; // Adjust path
    }

    public function dashboard() {
        session_start();
        // Check if admin is logged in
        if (!isset($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'Admin') {
            header("Location: /admin/login");
            exit;
        }
        // Load Admin Main Menu 
        include __DIR__ . '/View/Admin/dashboard.php'; //Admin Main Menu view
        echo "Welcome to Admin Dashboard, " . htmlspecialchars($_SESSION['admin_name']) . "!";
        echo '<br><a href="/admin/logout">Logout</a>'; // Conceptual logout
    }
    // insert other admin methods later, e.g., manage users, view reports, etc.
}