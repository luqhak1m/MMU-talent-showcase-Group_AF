
<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/forum-post-details.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>

    <div class="forum-details-container-div">
        <div class="forum-title-desc-container-div">
            <h2><?php echo htmlspecialchars($fetched_forum_post['ForumName']); ?></h2>
            <p><?php echo htmlspecialchars($fetched_forum_post['ForumDescription']); ?></p>
        </div>
        
        
        <div class="forum-members-summary-div">
            <h3>Members</h3>
            <p><?php echo count($forum_members); ?> member(s)</p>
        </div>
    </div>

    <div class="post-container-div">
        <div class="post-description-div">
                <?php

                echo '<div class="detailed-post-container-div">';

                    // echo '<a href="index.php?page=forum-post&id='.$post['FPostID'].'&action=view" class="post-link-wrapper">';
                    echo '<div class="post-upper-section-container-div">';
                        echo '<div class="pfp-upper-section-container-div">';
                            echo '<img src="uploads/'.$fetched_forum_post['ProfilePicture'].'" alt="!!">';
                            echo '<div class="details-upper-section-container-div">';
                                echo '<div>';
                                    echo '<p>'.htmlspecialchars($fetched_forum_post['FPostDate']).'</p>';
                                    echo '<p>@'.htmlspecialchars($fetched_forum_post['Username']).'</p>';
                                    echo '<h4>'.htmlspecialchars($fetched_forum_post['FPostTitle']).'</h4>';
                                    echo '<p>'.htmlspecialchars($fetched_forum_post['FPost']).'</p>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="post-lower-section-container-div">';
                        echo '<div class="comment-count-div">';
                                echo '<img src="images/comments_icon.png" alt="">';
                            echo '<p>'.count($fetched_comments).'</p>';
                        echo '</div>';
                        echo '<div class="like-count-div">';
                            echo '<a href="index.php?page=forum-post&id='. $fetched_forum_post['FPostID'].'&action=like" class="like-button">';
                                echo '<img src="images/likes_icon.png" alt="Like">';
                            echo '</a>';
                            echo '<p>'.$fetched_forum_post['FPostLikes'].'</p>';
                        echo '</div>';
                    echo '</div>';

                echo '</div>';
                ?>
        </div>
        <div class="post-comment-heading-div">
            <h1 class="post-comments-heading-h1">Comments</h1>

        </div>
        <div class="comment-like-container-div">
            <div class="comment-form-div">
                <form class="add-comment-form" action="index.php?page=forum-post&id=<?php echo $fetched_forum_post['FPostID']?>&action=comment" method="post">
                    <textarea class="comment-input" name="comment" placeholder="Write your comment here..." required></textarea>
                    <button type="submit" class="comment-submit-button">Post Comment</button>
                </form>
            </div>
        </div>
        <?php
            foreach($fetched_comments as $comment){
                echo '<div class="comment-description-div">';
                    echo '<div class="post-comment-card-collection-div">';
                        echo '<div class="post-comment-card-div">';
                            echo '<div class="post-pfp-username-time-div">';
                                echo '<img class="post-profilepicture-comment-img"';
                                echo 'src="uploads/'.$comment['ProfilePicture'].'"';
                                echo 'alt="Click to upload">';
                                echo '<div class="username-time-div">';
                                    echo '<p>@'.$comment['Username'].'</p>';
                                    echo '<p><'.$comment['FCommentTimeStamp'].'</p>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="post-comment-text-div">';
                                echo $comment['FComment'];
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        ?>
    </div>


</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>