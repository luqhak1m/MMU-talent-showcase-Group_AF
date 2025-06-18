
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
    <title>Document</title>
</head>
<body>
    <div id="banner-div">
        <?php if ($talent['UserID'] != $_SESSION['user_id']): ?>
        <div id="white-banner-div">
            <div class="follow-button-div">
                <button id="catalogue-follow-user-button" class="button">Follow</button>
            </div>
            
        </div>
    <?php endif; ?>
        <div id="purple-banner-div">
            <div id="profilepicture-div">
                <a href="/talent-portal/public/index.php?page=profile">
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
                <?php
						echo '<a href="/talent-portal/public/index.php?page=profile"><img src="'.$profilePicturePath.'" class="navbar-prof" alt="profile"></a>';
				?>

            </div>
            <div id="likes-and-followers-div">

                <img src="/talent-portal/public/images/likes_icon.png" alt="Like Icon" class="talent-icon">
                <p>100</p>
                <img src="/talent-portal/public/images/followers_icon.png" alt="Like Icon" class="talent-icon">
                <p>100</p>

            </div>
        </div>
    </div>
    <div id="content-container-div">
        
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
                <a href="/talent-portal/public/index.php?page=offer" class="button">Make Offer</a>
                <a href="/talent-portal/public/index.php?page=cart" class="button">Add to Cart</a>
            </div>
        </div>
        <div id="talent-comment-div" class="talent-card-div">
            <div id="talent-heading-div">
                <h1 id="comments-heading-h1">Comments</h1>
            </div>
            <div id="comment-card-collection-div">
                <div class="comment-card-div">
                    <div class="pfp-username-time-div">
                        <img class="profilepicture-comment-img" 
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
                    <div class="comment-text-div">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus impedit cupiditate saepe sint labore aliquam error placeat molestias, quaerat quidem? Labore, hic! Laudantium pariatur ab dignissimos in, nobis quisquam neque.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos ex delectus explicabo expedita unde, molestiae quod libero officia corporis excepturi eos? Rerum similique tempore dolorem accusantium fugit labore quam aliquam.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, rem perferendis? Ullam at voluptatibus totam ex blanditiis rerum soluta rem nobis labore optio reiciendis eaque laborum facere, incidunt facilis amet!
                    </div>
                </div>
                <div class="comment-card-div">
                    <div class="pfp-username-time-div">
                        <img class="profilepicture-comment-img" 
                        src="<?php 
                            $profilePicturePath = 'images/profile.png'; // default image
                            if (!empty($fetched_profile['ProfilePicture'])) {
                                $profilePicturePath = 'uploads/' . htmlspecialchars($fetched_profile['ProfilePicture']);
                            }    
                            
                            echo $profilePicturePath;
                            ?>"
                            alt="Click to upload">
                        <p>@Username</p>
                        <p>4 Hours Ago</p>
                    </div>
                    <div class="comment-text-div">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus impedit cupiditate saepe sint labore aliquam error placeat molestias, quaerat quidem? Labore, hic! Laudantium pariatur ab dignissimos in, nobis quisquam neque.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos ex delectus explicabo expedita unde, molestiae quod libero officia corporis excepturi eos? Rerum similique tempore dolorem accusantium fugit labore quam aliquam.
                    </div>
                </div>
                <div class="comment-card-div">
                    <div class="pfp-username-time-div">
                        <img class="profilepicture-comment-img" 
                        src="<?php 
                            $profilePicturePath = 'images/profile.png'; // default image
                            if (!empty($fetched_profile['ProfilePicture'])) {
                                $profilePicturePath = 'uploads/' . htmlspecialchars($fetched_profile['ProfilePicture']);
                            }    
                            
                            echo $profilePicturePath;
                            ?>"
                            alt="Click to upload">
                        <p>@Username</p>
                        <p>4 Hours Ago</p>
                    </div>
                    <div class="comment-text-div">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus impedit cupiditate saepe sint labore aliquam error placeat molestias, quaerat quidem? Labore, hic! Laudantium pariatur ab dignissimos in, nobis quisquam neque.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos ex delectus explicabo expedita unde, molestiae quod libero officia corporis excepturi eos? Rerum similique tempore dolorem accusantium fugit labore quam aliquam.
                    </div>
                </div>
            </div>
        </div>
                

    </div>
</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>