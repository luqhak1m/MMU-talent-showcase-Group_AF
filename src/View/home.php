<!DOCTYPE html>
<html>
<head>
    <title>Welcome to My Website</title>
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/home.css?v=<?= time() ?>">
    <script src="<?= BASE_URL ?>/js/home.js"></script>   
</head>
<body class="index-body">

    <div class="container-div" id="home-container-div">
        <h1>
            <?php
                if(isset($_SESSION['username'])) {
                    echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
                } else {
                    echo "Welcome to MMU Talent Portal";
                }
            ?>
        </h1>
        <p>Your one-stop portal for stuff.</p>
        
        <?php
            if(!isset($_SESSION['username'])) {
                echo '<a href="?page=login" class="button">Login</a>';
                echo '<a href="?page=register" class="button">Register</a>';
            } else {
                echo '<a href="' . BASE_URL . 'index.php?page=logout" class="button">Log Out</a>';
            }
        ?>
    </div>

    <div class="info-section">
        <h2>What is this platform?</h2>
        <p>
            The MMU Talent Portal is a digital space where students of Multimedia University can showcase their talents, from music and design to programming and photography. It's a creative hub for visibility, collaboration, and recognition.
        </p>

        <hr>

        <h2>Why use this platform?</h2>
        <p>
            Whether you're looking to build a portfolio, gain followers, get discovered by others, or simply share your passion, this platform gives you the tools and audience to grow. Upload content, interact with others, and climb the talent leaderboard!
        </p>
    </div>

</body>
</html>
