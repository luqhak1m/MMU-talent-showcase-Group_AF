<?php // config/database.php

require_once("database_config.php");

/* 

combined into 1 variable and moved into a config file for ease of modification

define('DB_HOST', '127.0.0.1');       
define('DB_NAME', 'mmu_talent_showcase_portal'); 
*/
  
/*

return [
    'dsn' => 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
    'username' => DB_USER,
    'password' => DB_PASS,
    'options' => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,      
        PDO::ATTR_EMULATE_PREPARES   => false,                  
    ],
];

*/

function connectToDatabase(array $values){
    /*  Make connection to the database */
    $conn=$values[0];
    $user=$values[1];
    $pass=$values[2];

    try{
        $pdo=new PDO($conn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "[INFO] Connection Successful <br>";
        return $pdo;
    }catch(PDOException $e){
        echo "[INFO] Connection Fails: ".$e." <br>";
        return null;
    }
}
?>