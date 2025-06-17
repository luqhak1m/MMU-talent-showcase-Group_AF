<?php // src/Model/UserModel.php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/database_config.php';
require_once __DIR__ . '/../../includes/ID-Generator.inc.php';
require_once __DIR__ . '/ProfileModel.php';
require_once __DIR__ . '/CatalogueModel.php';

echo "[INFO] UserModel.php: Entered <br>";
echo gettype($dbCredentials) . "<br>";


// Assuming a DB connection class or direct PDO usage
class UserModel {
    private $pdo; // Assume this is your PDO database connection object

    // to use other module's model function

    private $profile_model;
    private $catalogue_model;
    

    public function __construct($pdo, ProfileModel $profile_model, CatalogueModel $catalogue_model) {
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
            echo "[INFO] UserModel.__construct(): Executing <br>";
            $this->pdo=$pdo;
            $this->profile_model=$profile_model;
            $this->catalogue_model=$catalogue_model;
        } catch (PDOException $e) {
            // Log error or handle appropriately
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function findUserByEmail($email) {
        echo "[INFO] UserModel.findUserByEmail(): Executing <br>";

        $stmt = $this->pdo->prepare("SELECT UserID, Username, Email, `Role` FROM User WHERE Email = :email"); // [cite: 40] (User table, Email column)
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser(array $data) {

        // generate unique 8-character UserID, since the data dictionary says to use CHAR(8)
        $userID=generateID();
        
        $data['UserID']=$userID;
        
        // Ensure all necessary fields are present, matching your DB schema.
        // The ERD shows User table with UserID (PK), Username, Email, Password, Role etc. [cite: 37]
        // Data dictionary has UserID, Username, Email, Password, Role, etc. [cite: 40]
        $sql = "INSERT INTO User (UserID, Username, Email, Password, Role) VALUES (:UserID, :Username, :Email, :Password, :Role)";
        $stmt = $this->pdo->prepare($sql);
        
        
        $stmt->bindParam(':UserID', $data['UserID']); // generate unique 8-character UserID, since the data dictionary uses CHAR(8)
        $stmt->bindParam(':Username', $data['Username']);
        $stmt->bindParam(':Email', $data['Email']);
        $stmt->bindParam(':Password', $data['Password']); // Hashed password
        $stmt->bindParam(':Role', $data['Role']); // Default 'User' [cite: 40]
        
        try {
            $stmt->execute();
            echo "[INFO] UserModel.CreateUser(): Executing <br>";

            // immediately create an empty profile

            $this->profile_model->createProfile($userID);

            // immediately create an empty catalogue

            $this->catalogue_model->createCatalogue($userID);

            echo "[INFO] UserModel.CreateUser(): Executed <br>";
            return true;
        } catch (PDOException $e) {
            // Log error: $e->getMessage();
            echo "[EXCEPTION] " . $e->getMessage() . "<br>";

            return false;
        }
    }
    public function getAllUsers() {
        // Simple query to get all users, you can add ordering
        $stmt = $this->db->prepare("SELECT UserID, Username, Email, Role FROM User ORDER BY Username");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}