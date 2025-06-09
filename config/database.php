<?php // config/database.php

// Common XAMPP/localhost settings
define('DB_HOST', '127.0.0.1');       
define('DB_NAME', 'mmu_talent_showcase_portal'); 
define('DB_USER', 'root');              
define('DB_PASS', '');                 
define('DB_CHARSET', 'utf8mb4');

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
?>