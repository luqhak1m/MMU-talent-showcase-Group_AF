
<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/css/talent.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/css/portfolio.css?v=<?= time() ?>">

    <script src="<?= BASE_URL ?>/js/portfolio.js?v=<?= time() ?>"></script>
    <title>Portfolio</title>
</head>
<body>
    <div id="banner-div">
        <div id="white-banner-div">
            <?php if ($user_id != $_SESSION['user_id']): ?>

            <div class="follow-button-div">
                <!-- <button id="catalogue-follow-user-button" class="button">Follow</button> -->
                 <a 
                    href="index.php?page=talent&id=<?php echo $user_id; ?>&followerID=<?php echo $_SESSION['user_id']; ?>&followingID=<?php echo $user_id; ?>&action=portfolio" 
                    class="button">
                    Follow
                </a>
            </div>

        <?php endif; ?>
        </div>
        <div id="purple-banner-div">
            <div id="profilepicture-div">
                    <img id="profilepicture-preview-img" 
                        src="uploads/<?php echo $profile_picture; ?>"
                        alt="Click to upload">
            <p><?php echo $username; ?></p>

            </div>
            <div id="likes-and-followers-div">

                <img src="<?= BASE_URL ?>images/likes_icon.png" alt="Like Icon" class="talent-icon">
                <p><?php echo $post_likes; ?></p>
                <img src="<?= BASE_URL ?>images/followers_icon.png" alt="Like Icon" class="talent-icon">
                <p><?php echo count($followers); ?></p>

            </div>
        </div>
    </div>
    <?php
    
    if($UserID==$_SESSION['user_id']){
        echo '<div class="add-talent-button-div">';
        echo '<a href="?page=add-talent-form" id="add-talent-button" class="button">Add Talent</a>';
        echo '<button onclick="editMode()" class="button">Edit Talent</button>';
        echo '</div>';
    }

    ?>
    <div class="talent-card-container-div">
        <div class="talent-search-results-grid">
            <?php
            foreach($fetched_talent as $talent){
                
                $talent_img_path='images/img_placeholder.svg.png'; // default image
                if(!empty($talent['Content'])){
                    $talent_img_path = 'uploads/'.htmlspecialchars($talent['Content']);
                }   
                
                $user_id=htmlspecialchars($talent['TalentID']);

                
                echo '<div class="talent-container">';
                echo '<a class="delete-button" href="?page=talent&id=' . htmlspecialchars($talent['TalentID']) . '&action=del">&times;</a>';
                // echo '<div class="talent-search-result-card" data-id="'.htmlspecialchars($talent['TalentID']).'">';

                // this a tag holds custom html tags -  the url to the view link and edit link.
                echo '<a 
                href="index.php?page=talent&id='.$user_id.'" 
                class="talent-search-result-card" 
                data-id="'.$user_id.'" 
                data-view-url="index.php?page=talent&id='.$user_id.'"
                data-edit-url="index.php?page=talent&id='.$user_id.'&action=edit"
                >';

                echo '<div class="talent-img-container-div">';
                $filename=$talent['Content'];
                $extension=strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                $audio_extensions=['mp3', 'wav', 'ogg', 'aac', 'flac'];

                if(in_array($extension, $audio_extensions)){
                    echo '<img class="talent-img" src="images/audio_icon.png" alt="Audio File">';
                }else{
                    echo '<img class="talent-img" src="'.$talent_img_path.'" alt="'.htmlspecialchars($talent['TalentTitle']).'">';
                }                
                
                echo '</div>';
                echo '<div class="talent-title-description-div">';
                echo '<h2>'.$talent['TalentTitle'].'</h2>';
                echo '<p>'.$talent['TalentDescription'].'</p>';
                echo '</div>';
                echo '</a>';
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