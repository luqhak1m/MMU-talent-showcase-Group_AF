
<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/forum-post-details.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>

    <div class="post-container-div">

        <div class="post-description-div">
                <?php

                echo '<div class="detailed-post-container-div">';
                // echo '<a href="index.php?page=forum-post&id='.$post['FPostID'].'&action=view" class="post-link-wrapper">';
                echo '<div class="post-upper-section-container-div">';
                echo '<div class="pfp-upper-section-container-div">';
                echo '<img src="'.$fetched_forum_post['ProfilePicture'].'" alt="!!">';
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
                echo '</div>';
                ?>
        </div>
        <!-- <div id="post-comment-div" class="post-card-div">
            <div id="post-heading-div">
                <h1 id="post-comments-heading-h1">Comments</h1>
            </div>
            <div id="post-comment-card-collection-div">
                <div class="post-comment-card-div">
                    <div class="post-pfp-username-time-div">
                        <img class="post-profilepicture-comment-img" 
                        src="<?php 
                            $profilePicturePath = 'images/profile.png'; // default image
                            if(!empty($profile_picture)){
                                $profilePicturePath = 'uploads/'.htmlspecialchars($profile_picture);
                            }    
                            
                            echo $profilePicturePath;
                            ?>"
                            alt="Click to upload">
                        <p>@Username</p>
                        <p>4 Hours Ago</p>
                    </div>
                    <div class="post-comment-text-div">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus impedit cupiditate saepe sint labore aliquam error placeat molestias, quaerat quidem? Labore, hic! Laudantium pariatur ab dignissimos in, nobis quisquam neque.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos ex delectus explicabo expedita unde, molestiae quod libero officia corporis excepturi eos? Rerum similique tempore dolorem accusantium fugit labore quam aliquam.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, rem perferendis? Ullam at voluptatibus totam ex blanditiis rerum soluta rem nobis labore optio reiciendis eaque laborum facere, incidunt facilis amet!
                    </div>
                </div>
            </div>
        </div>
        </div> -->


</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>