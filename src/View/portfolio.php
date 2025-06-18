
<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/portfolio.css?v=<?= time() ?>">
    <script src="/talent-portal/public/js/portfolio.js?v=<?= time() ?>"></script>
    <title>Portfolio</title>
</head>
<body>
    <div id="banner-div">
        <div id="white-banner-div">
            <div class="follow-button-div">
                <button id="catalogue-follow-user-button" class="button">Follow</button>
            </div>
        </div>
        <div id="purple-banner-div">
            <div id="profilepicture-div">
                <img id="profilepicture-preview-img" 
                    src="<?php 
                        $profilePicturePath = 'images/profile.png'; // default image
                        if (!empty($fetched_profile['ProfilePicture'])) {
                            $profilePicturePath = 'uploads/' . htmlspecialchars($fetched_profile['ProfilePicture']);
                        }    
                        
                        echo $profilePicturePath;
                        ?>"
                        alt="Click to upload">
                <p>@username</p>

            </div>
            <div id="likes-and-followers-div">

                <img src="/talent-portal/public/images/likes_icon.png" alt="Like Icon" class="talent-icon">
                <p>100</p>
                <img src="/talent-portal/public/images/followers_icon.png" alt="Like Icon" class="talent-icon">
                <p>100</p>

            </div>
        </div>
    </div>
    <div class="add-talent-button-div">
        <a href="?page=add-talent-form" id="add-talent-button" class="button">Add Talent</a>
        <button onclick="editMode()" class="button">Edit Talent</button>
    </div>
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
                echo '<img src="'.$talent_img_path.'" alt="'.$talent['TalentTitle'].'">';
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