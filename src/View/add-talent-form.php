

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';
$fetched_talent=$fetched_talent??[]; // handle if user is adding talent, not editing 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?= BASE_URL ?>/js/portfolio.js?v=<?= time() ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/add-talent-form.css?v=<?= time() ?>">

    <title>Document</title>
</head>
<body>
    <div id="talent-form-div">
        <?php
        $actionUrl='index.php?page=talent';
        if(!empty($fetched_talent)){
            $actionUrl.='&id='.urlencode($fetched_talent['TalentID']).'&action=edit';
        }else{
            $actionUrl.='&id='.urlencode($UserID).'&action=portfolio';

        }
        // echo $actionUrl;
        ?>
    <form action="<?php echo $actionUrl; ?>" method="POST" enctype="multipart/form-data">
       
        <label for="TalentTitle">Talent Title:</label><br>
        <input type="text" id="TalentTitle" name="TalentTitle" maxlength="255" value="<?php echo htmlspecialchars($fetched_talent['TalentTitle'] ?? ''); ?>" required><br><br>

        <label for="TalentDescription">Talent Description:</label><br>
        <textarea id="TalentDescription" name="TalentDescription" rows="4" cols="50" required><?php echo htmlspecialchars($fetched_talent['TalentDescription'] ?? ''); ?></textarea><br><br>

        <label for="Price">Price (RM):</label><br>
        <input type="number" id="Price" name="Price" step="0.01" min="0" value="<?php echo htmlspecialchars($fetched_talent['Price'] ?? ''); ?>" required><br><br>

        <label for="Content">Upload Media (Image, Video, or Audio):</label><br>
        <input type="file" id="Content" name="Content" accept="image/*,video/*,audio/*" required><br><br>
        <div id="new-media-preview" style="margin-top: 10px;"></div>
        <?php if(!empty($fetched_talent['Content'])): ?>
        <div id="existing-media-preview">
            <p>Current file:</p>
                <?php 
                    $file=htmlspecialchars($fetched_talent['Content']);
                    $extension=pathinfo($file, PATHINFO_EXTENSION);
                    $filepath="uploads/".$file;
                    // echo "<p>Resolved path: <code>$filepath</code></p>";
                    // echo "<p>Full URL test: <a href='$filepath' target='_blank'>Open File</a></p>";

                    if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])){
                        echo "<img src='$filepath' alt='Image Preview'>";
                    }elseif(in_array(strtolower($extension), ['mp4', 'webm', 'mov'])){
                        echo "<video controls src='$filepath'></video>";
                    }elseif(in_array(strtolower($extension), ['mp3', 'wav', 'ogg'])){
                        echo "<audio controls src='$filepath'></audio>";
                    }else{
                        echo "<p>Unsupported file type: $file</p>";
                    }
                ?>
            </div>
        <?php endif; ?>

        <!-- <label for="TalentLikes">Talent Likes:</label><br>
        <input type="number" id="TalentLikes" name="TalentLikes" min="0" value="<?php echo htmlspecialchars($fetched_talent['TalentLikes'] ?? '0'); ?>"><br><br> -->

        <label for="Category">Category:</label><br>
        <select id="Category" name="Category">
            <?php
            $categories = ['Music', 'Art', 'Filmmaking', 'Videography', 'Photography', 'Animation', 'Voiceover'];
            $selected = $fetched_talent['Category'] ?? '';
            foreach ($categories as $category) {
                $isSelected = ($selected === $category) ? 'selected' : '';
                echo "<option value=\"$category\" $isSelected>$category</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Submit" class="Button">
    </form>
    </div>
</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>