<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/add-forum-form.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
        <h2>Create a Forum Post</h2>
        <form action="index.php?page=forum-post&id=<?php echo $ForumID ?>&action=create" method="POST"> 
            <label for="forum_post_title">Post Title:</label>
            <input type="text" id="forum_post_title" name="forum_post_title" maxlength="255" required>

            <label for="forum_post">Post Content:</label>
            <textarea id="forum_post" name="forum_post" rows="5" cols="40" required></textarea>

            <button type="submit">Create Post</button>
        </form>
    </div>
</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>