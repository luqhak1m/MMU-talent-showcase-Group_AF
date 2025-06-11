<?php

session_start();

require_once __DIR__ . '/../../public/header.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to My Website</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body class="index-body">
        <h1>
            
         <?php
        if(isset($_SESSION['username'])) {
            echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
        }else {
            echo "Welcome to MMU Talent Portal";
        }
        ?>


        </h1>
        <p>Your one-stop portal for stuff.</p>

        <?php
        if(!isset($_SESSION['username'])) {
            echo '<a href="?page=login" class="button">Login</a>';
            echo '<a href="?page=register" class="button">Register</a>';
        }else{
            echo '<a href="#" class="button">Log Out</a>';
        }
        ?>
    </body>
    </html>
<?php

require_once __DIR__ . '/../../public/footer.php';

?>
