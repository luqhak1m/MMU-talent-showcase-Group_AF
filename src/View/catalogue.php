
<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/catalogue.css?v=<?= time() ?>">

    <title>Portfolio</title>
</head>
<body>
    <div class="search-filter-container-div">
        <div class="search-wrapper-div">
            <div class="search-field-div">
                <input type="text" placeholder="Search for talent..." class="search-input" />
            </div>
        </div>
        <div class="filter-wrapper-div">
            <div class="filter-div">
                <select class="filter-dropdown">
                <option value="">Filter By</option>
                <option value="design">Art</option>
                <option value="development">Music</option>
                <option value="marketing">Video</option>
                </select>
            </div>
        </div>
    </div>
    <div class="talent-card-container-div">
        <div class="talent-search-results-grid">
            <?php


            foreach($catalogue as $talent){
                $profilePicturePath='images/profile.png'; // default picture
                if(!empty($talent['ProfilePicture'])){
                    $profilePicturePath='uploads/'.htmlspecialchars($talent['ProfilePicture']);
                }
                // echo "<p>Resolved path: <code>$profilePicturePath</code></p>";
                // echo "<p>Full URL test: <a href='$profilePicturePath' target='_blank'>Open File</a></p>";
   
                echo '<a href="index.php?page=talent&id='.$talent['TalentID'].'" class="talent-search-result-card">';
                echo '<div class="image-name-price-pfp-container-div">';
                echo '<div class="talent-img-container-div">';
                echo '<img class="talent-img" src="uploads/'.htmlspecialchars($talent['Content']).'" alt="Image Placeholder">';
                echo '</div>';
                echo '<div class="name-price-pfp-container-div">';
                echo '<div class="talent-title-description-div">';
                echo '<h2>'.$talent['TalentTitle'].'</h2>';
                echo '<p>RM'.$talent['Price'].'</p>';
                echo '</div>';
                echo '<div class="mini-profilepicture-div">';
                echo '<img class="mini-profilepicture-img"';
                echo 'src="'.$profilePicturePath.'"';
                echo 'alt="Click to upload">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
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