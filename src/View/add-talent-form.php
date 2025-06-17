

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="?page=talent" method="POST" enctype="multipart/form-data">
       
        <label for="TalentTitle">Talent Title:</label><br>
        <input type="text" id="TalentTitle" name="TalentTitle" maxlength="255" required><br><br>

        <label for="TalentDescription">Talent Description:</label><br>
        <textarea id="TalentDescription" name="TalentDescription" rows="4" cols="50" required></textarea><br><br>

        <label for="Price">Price (RM):</label><br>
        <input type="number" id="Price" name="Price" step="0.01" min="0" required><br><br>

        <label for="Content">Upload Media (Image, Video, or Audio):</label><br>
        <input type="file" id="Content" name="Content" accept="image/*,video/*,audio/*"><br><br>

        <input type="submit" value="Submit">

        <label for="TalentLikes">Talent Likes:</label><br>
        <input type="number" id="TalentLikes" name="TalentLikes" min="0" value="0"><br><br>

        <label for="Category">Category:</label><br>
        <input type="text" id="Category" name="Category" maxlength="50"><br><br>

        <input type="submit" value="Submit Talent">
    </form>

</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>