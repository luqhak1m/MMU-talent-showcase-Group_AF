<?php // src/Model/UserModel.php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/database_config.php';

echo "[INFO] Loaded UserModel.php <br>";
echo gettype($dbCredentials) . "<br>";


// Assuming a DB connection class or direct PDO usage
class UserModel {
    private $db; // Assume this is your PDO database connection object

    public function __construct($dbCredentials) {
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
 
            //commented on 11/06/2025
            //  $this->db = new PDO('mysql:host=localhost;dbname=mmu_talent_portal', 'root', ''); // EXAMPLE ONLY
            //  $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // can use this function to make connection now
            echo "[INFO] Inside of __construct() in UserModel.php <br>";
            $this->db=connectToDatabase($dbCredentials);
        } catch (PDOException $e) {
            // Log error or handle appropriately
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function findUserByEmail($email) {
        echo "[INFO] Inside of findUserByEmail() in UserModel.php <br>";

        $stmt = $this->db->prepare("SELECT UserID, Username, Email, `Role` FROM User WHERE Email = :email"); // [cite: 40] (User table, Email column)
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser(array $data) {

        // generate unique 8-character UserID, since the data dictionary uses CHAR(8)
        $userID=substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 8)), 0, 8);
        $data['UserID']=$userID;

        // Ensure all necessary fields are present, matching your DB schema.
        // The ERD shows User table with UserID (PK), Username, Email, Password, Role etc. [cite: 37]
        // Data dictionary has UserID, Username, Email, Password, Role, etc. [cite: 40]
        $sql = "INSERT INTO User (UserID, Username, Email, Password, Role) VALUES (:UserID, :Username, :Email, :Password, :Role)";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(':UserID', $data['UserID']); // generate unique 8-character UserID, since the data dictionary uses CHAR(8)
        $stmt->bindParam(':Username', $data['Username']);
        $stmt->bindParam(':Email', $data['Email']);
        $stmt->bindParam(':Password', $data['Password']); // Hashed password
        $stmt->bindParam(':Role', $data['Role']); // Default 'User' [cite: 40]
        
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error: $e->getMessage();
            echo "[EXCEPTION] " . $e->getMessage() . "<br>";

            return false;
        }
    }
}