

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$profilePicturePath = 'images/profile.png';
if (isset($_SESSION['user_id'])) {
	require_once __DIR__ . '/../src/Controller/ProfileController.php';
    require_once __DIR__.'/../config/database.php'; // ensure $pdo is available
    $profileController = new ProfileController($pdo);
    $fetched_profile = $profileController->getProfile($_SESSION['user_id']);

    if (!empty($fetched_profile['ProfilePicture'])) {
        $profilePicturePath = 'uploads/' . htmlspecialchars($fetched_profile['ProfilePicture']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>MMU Talent Showcase Portal</title>
	<link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/header.css?v=<?= time() ?>">
	<script src="js/main.js" defer></script>
</head>
<body>
	<header>
		<nav>
			<div class="navbar">
				<div class="navbar-left">
					<a href="index.php?page=home" class="website-title"><h1>Website Name</h1></a>
					<a href="index.php?page=catalogue">Catalogue</a> 	
					<a href="index.php?page=talent">Portfolio</a> 	
					<a href="/forum">Forum</a>
					<a href="/leaderboard">Leaderboard</a> 
					<a href="/feedback">Feedback</a>
					<a href="/announcement">Announcement</a> 
					<a href="/faq">FAQ</a>
				</div>

				<div class="navbar-right">
					<img src="images/search.png" class="navbar-img" alt="search">
					<a href="#"><img src="images/bag.png" class="navbar-img" alt="bag"></a>
					<?php
						echo '<a href="/talent-portal/public/index.php?page=profile"><img src="'.$profilePicturePath.'" class="navbar-prof" alt="profile"></a>';
					?>
				</div>
			</div>
		</nav>
	</header>
