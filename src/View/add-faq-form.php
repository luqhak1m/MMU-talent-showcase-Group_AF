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
        <h2>Submit a FAQ</h2>
            <form action="index.php?page=faq" method="POST">
                <label for="question">Question</label>
                <input type="text" id="question" name="question" placeholder="Enter question" required>
                <button type="submit">Submit FAQ</button>
            </form>
    </div>
</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>