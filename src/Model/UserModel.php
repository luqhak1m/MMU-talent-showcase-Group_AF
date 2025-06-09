<?php // src/Model/UserModel.php

// Assuming a DB connection class or direct PDO usage
class UserModel {
    private $db; // Assume this is your PDO database connection object

    public function __construct() {
        // Initialize DB connection (e.g., using your database.php config)
        // $this->db = new PDO("mysql:host=DB_HOST;dbname=DB_NAME", DB_USER, DB_PASS);
        // For example:
        // global $pdo_connection; // if you have a global PDO object
        // $this->db = $pdo_connection;
        // This part is highly dependent on your DB connection setup.
        // For now, methods will assume $this->db is a ready PDO object.
        // Replace with your actual database connection logic.
        try {
            // Example: Sourced from config/database.php (not provided, but conceptual)
            // $config = require __DIR__ . '/../../config/database.php';
            // $this->db = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);
            // For testing, you might mock or simplify this.
             $this->db = new PDO('mysql:host=localhost;dbname=mmu_talent_portal', 'root', ''); // EXAMPLE ONLY
             $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Log error or handle appropriately
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function findUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT UserID FROM User WHERE Email = :email"); // [cite: 40] (User table, Email column)
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser(array $data) {
        // Ensure all necessary fields are present, matching your DB schema.
        // The ERD shows User table with UserID (PK), Username, Email, Password, Role etc. [cite: 37]
        // Data dictionary has UserID, Username, Email, Password, Role, etc. [cite: 40]
        $sql = "INSERT INTO User (Username, Email, Password, Role) VALUES (:Username, :Email, :Password, :Role)";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(':Username', $data['Username']);
        $stmt->bindParam(':Email', $data['Email']);
        $stmt->bindParam(':Password', $data['Password']); // Hashed password
        $stmt->bindParam(':Role', $data['Role']); // Default 'User' [cite: 40]
        
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error: $e->getMessage();
            return false;
        }
    }
}