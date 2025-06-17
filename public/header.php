
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
					if(isset($_SESSION['username'])) {
						$username=$_SESSION['username'];
						$profilePicturePath = 'images/profile.png'; // default image
                        if (!empty($fetched_profile['ProfilePicture'])) {
                            $profilePicturePath = 'uploads/' . htmlspecialchars($fetched_profile['ProfilePicture']);
                        }    
                                            
						echo '<a href="/talent-portal/public/index.php?page=profile"><img src="'.$profilePicturePath.'" class="navbar-prof" alt="profile"></a>';
					}else{
						echo '<a href="#"><img src="images/profile.png" class="navbar-prof" alt="profile"></a>';
					}
				
					?>
				</div>
			</div>
		</nav>
	</header>
