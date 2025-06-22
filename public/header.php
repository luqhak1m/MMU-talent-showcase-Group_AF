<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$profilePicturePath = 'images/profile.png';
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	require_once __DIR__ . '/../src/Controller/ProfileController.php';
    require_once __DIR__.'/../config/database.php';
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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/css/header.css?v=<?= time() ?>">
	<script src="js/main.js" defer></script>
</head>
<body>
	<header>
		<nav>
			<div class="navbar">
				<div class="navbar-left">
					<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
						<a href="index.php?page=admin_dashboard" class="website-title">
							<h1>Website Name</h1>
						</a>
					<?php else: ?>
						<a href="<?= BASE_URL ?>index.php?page=home" class="website-title">
							<h1>Website Name</h1>
						</a>
					<?php endif; ?>
					<a href="index.php?page=catalogue">Catalogue</a> 	
					<a href="index.php?page=talent&id=<?php echo $user_id; ?>&action=portfolio">Portfolio</a> 	
					<a href="index.php?page=forum&id=<?php echo $user_id; ?>&action=joined">Forum</a>
					<a href="index.php?page=leaderboard">Leaderboard</a> 
					<a href="index.php?page=feedback">Feedback</a>
					<a href="index.php?page=announcement">Announcement</a> 
					<a href="index.php?page=faq">FAQ</a>
				</div>

				<div class="navbar-right">
					<img src="images/search.png" class="navbar-img" alt="search">
					<a href="<?= BASE_URL ?>index.php?page=cart"><img src="images/bag.png" class="navbar-img" alt="bag"></a>
					<?php
						echo '<a href="' . BASE_URL . 'index.php?page=profile"><img src="' . BASE_URL . $profilePicturePath . '" class="navbar-prof" alt="profile"></a>';
					?>
				</div>
			</div>
		</nav>
	</header>
