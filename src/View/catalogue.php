
<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/catalogue.css?v=<?= time() ?>">

    <title>Portfolio</title>
</head>
<body>

    <form action="index.php" method="GET" class="search-filter-container-div">
        <input type="hidden" name="page" value="catalogue">
        <div class="search-wrapper-div">
            <div class="search-field-div">
                <input type="text" name="search" placeholder="Search for talent..." class="search-input" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />
            </div>
        </div>
        <div class="filter-wrapper-div">
            <div class="filter-div">
                <select name="category" class="filter-dropdown">
                    <option value="">Filter By Category</option>
                    <?php
                    $categories = ['Music', 'Art', 'Filmmaking', 'Videography', 'Photography', 'Animation', 'Voiceover'];
                    $selectedCategory = $_GET['category'] ?? '';
                    foreach ($categories as $cat) {
                        $isSelected = ($selectedCategory === $cat) ? 'selected' : '';
                        echo "<option value=\"$cat\" $isSelected>$cat</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" class="button" style="height: 3em; margin-top: 0; border-radius: 20px;">Search</button>
    </form>

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

                $filename=$talent['Content'];
                $extension=strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                $audio_extensions=['mp3', 'wav', 'ogg', 'aac', 'flac'];

                if(in_array($extension, $audio_extensions)){
                    echo '<img class="talent-img" src="images/audio_icon.png" alt="Audio File">';
                }else{
                    echo '<img class="talent-img" src="uploads/'.htmlspecialchars($filename).'" alt="Image Placeholder">';
                }

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