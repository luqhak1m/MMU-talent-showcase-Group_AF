
<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/forum-feed.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/forum-post-details.css?v=<?= time() ?>">
    <title>Forum Feed</title>
</head>
<body>

    <div class="forum-details-container-div">
        <div class="forum-title-desc-container-div">
            <h2><?php echo htmlspecialchars($forum['ForumName']); ?></h2>
            <p><?php echo htmlspecialchars($forum['ForumDescription']); ?></p>
        </div>
        
        
        <div class="forum-members-summary-div">
            <h3>Members</h3>
            <p><?php echo count($forum_members); ?> member(s)</p>
        </div>
    </div>
    
    <div class="middle-container-div">
        <div class="posts-text">
            <h3>Posts</h3>
        </div>
        <div class="create-post-button">
            <a class="button" href='index.php?page=forum-post&id=<?php echo $ForumID ?>&action=create'>Create Post</a>
        </div>
    </div>
    <?php foreach($forum_posts as $post){
        echo '<a href="index.php?page=forum-post&id='.$post['FPostID'].'&action=view" class="post-link-wrapper">';
        echo '<div class="post-upper-section-container-div">';
            echo '<div class="pfp-upper-section-container-div">';
                echo '<img src="uploads/'.$post['ProfilePicture'].'" alt="!!">';
                echo '<div class="details-upper-section-container-div">';
                    echo '<div>';
                        echo '<p>'.htmlspecialchars($post['FPostDate']).'</p>';
                        echo '<p>@'.htmlspecialchars($post['Username']).'</p>';
                        echo '<h4>'.htmlspecialchars($post['FPostTitle']).'</h4>';
                        echo '<p>'.htmlspecialchars($post['FPost']).'</p>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="post-lower-section-container-div">';
                echo '<div class="comment-count-div">';
                        echo '<img src="images/comments_icon.png" alt="">';
                    echo '<p>'.htmlspecialchars($post['CommentCount']).'</p>';
                echo '</div>';
                echo '<div class="like-count-div" id=post-feed-unclickable-like-div>';
                    echo '<img src="images/likes_icon.png" alt="Like">';
                    echo '<p>'.htmlspecialchars($post['FPostLikes']).'</p>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
    ?>
</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>