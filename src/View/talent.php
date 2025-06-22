
<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/talent.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/forum-post-details.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>
    <div id="banner-div">
        <div id="white-banner-div">
        <?php if ($talent['UserID'] != $_SESSION['user_id']): ?>
            <div class="follow-button-div">
                <!-- <button id="catalogue-follow-user-button" class="button">Follow</button> -->
                 <a 
                    href="index.php?page=talent&id=<?php echo $talent['TalentID']; ?>&followerID=<?php echo $_SESSION['user_id']; ?>&followingID=<?php echo $talent['UserID']; ?>&action=follow" 
                    class="button"
                    id="catalogue-follow-user-button">
                    Follow
                </a>
            </div>
        
        <?php endif; ?>
        </div>
        <div id="purple-banner-div">
            <div id="profilepicture-div">
                <a class="profile-link-a" href="index.php?page=talent&id=<?php echo $talent['UserID']; ?>&action=portfolio">
                <img id="profilepicture-preview-img" 
                    src="<?php 
                        $profilePicturePath = 'images/profile.png'; // default image
                        if (!empty($talent['ProfilePicture'])) {
                            $profilePicturePath = 'uploads/' . htmlspecialchars($talent['ProfilePicture']);
                        }    
                        
                        echo $profilePicturePath;
                        ?>"
                        alt="Click to upload">
                <p><?= $talent['Username'] ?></p>
                </a>
            </div>
            <div id="likes-and-followers-div">

                <img src="/talent-portal/public/images/likes_icon.png" alt="Like Icon" class="talent-icon">
                <p><?php echo $post_likes; ?></p>
                <img src="/talent-portal/public/images/followers_icon.png" alt="Like Icon" class="talent-icon">
                <p><?php echo count($followers); ?></p>

            </div>
        </div>
    </div>
    <div class="content-container-div">
        <div id="talent-description-div" class="talent-card-div">
            <div id="big-image-div">
                <?php
                $file = htmlspecialchars($talent['Content']);
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $filepath = 'uploads/' . $file;

                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    echo "<img src='$filepath' alt='Image' style='width: 100%; height: auto; border-radius: 20px;'>";
                } elseif (in_array($extension, ['mp4', 'webm', 'ogg'])) {
                    echo "<video controls style='width: 100%; border-radius: 20px;'>
                            <source src='$filepath' type='video/$extension'>
                            Your browser does not support the video tag.
                        </video>";
                } elseif (in_array($extension, ['mp3', 'wav', 'aac'])) {
                    echo "<audio controls style='width: 100%; border-radius: 20px;'>
                            <source src='$filepath' type='audio/$extension'>
                            Your browser does not support the audio tag.
                        </audio>";
                } else {
                    echo "<p>Unsupported media type: $extension</p>";
                }
                ?>
            </div>
            <div id="title-price-div">
                <h2><?php echo $talent['TalentTitle'] ?></h2>
                <h3><?php echo $talent['Price'] ?></h3>
            </div>
            <div id="description-text-div">
                <p>
                    <?php echo $talent['TalentDescription'] ?>
                </p>
            </div>
            <div id="offer-cart-button-div">
                <a href="/talent-portal/public/index.php?page=offer&talent_id=<?= htmlspecialchars($talent['TalentID']) ?>" class="button">Make Offer</a>
                <a href="/talent-portal/public/index.php?page=cart&action=add&talent_id=<?= htmlspecialchars($talent['TalentID']) ?>" class="button">Add to Cart</a>
            </div>
            <div class="post-lower-section-container-div">
                <div class="comment-count-div">
                    <img src="images/comments_icon.png" alt="">
                    <p><?php echo count($comments) ?></p>
                </div>
                <div class="like-count-div">
                    <a href="index.php?page=talent&id=<?php echo $talent['TalentID']; ?>&action=like" class="like-button">
                        <img src="images/likes_icon.png" alt="Like">
                    </a>
                    <p><?php echo $talent['TalentLikes']; ?></p>
                </div>
            </div>
        </div>
        <div id="talent-comment-div" class="talent-card-div">
            <div id="talent-heading-div">
                <h1 id="comments-heading-h1">Comments</h1>
            </div>
            <div class="comment-form-div" id="talent-comment-form-div">
                <form class="add-comment-form" action="index.php?page=talent&id=<?php echo $talent['TalentID'] ?>&action=comment" method="post">
                    <textarea class="comment-input" name="comment" placeholder="Write your comment here..." required></textarea>
                    <button type="submit" class="comment-submit-button">Post Comment</button>
                </form>
            </div>
                <?php 
                    foreach($comments as $comment){
                        echo '<div class="comment-description-div" id="talent-comment-description-div">';
                            echo '<div class="post-comment-card-collection-div">';
                                echo '<div class="post-comment-card-div">';
                                    echo '<div class="post-pfp-username-time-div">';
                                        echo '<img class="post-profilepicture-comment-img" src="uploads/' . $comment['ProfilePicture'] . '" alt="Click to upload">';
                                        echo '<div class="username-time-div">';
                                            echo '<p>@' . htmlspecialchars($comment['Username']) . '</p>';
                                            echo '<p>' . htmlspecialchars($comment['CommentTimestamp']) . '</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="post-comment-text-div">';
                                        echo htmlspecialchars($comment['Comment']);
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                    ?>
        </div>
    
    </div>
</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>
