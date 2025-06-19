<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/add-forum-form.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
        <h2>Create a Forum</h2>
            <form action="index.php?page=forum" method="POST">
                <label for="forum-name">Forum Name</label>
                <input type="text" id="forum-name" name="forum-name" placeholder="Enter forum title" required>

                <label for="forum-description">Description</label>
                <textarea id="forum-description" name="forum-description" placeholder="Write a short description..." required></textarea>

                <button type="submit">Create Forum</button>
            </form>
    </div>
</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>