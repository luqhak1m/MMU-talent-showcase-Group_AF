

<?php


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/add-forum-form.css?v=<?= time() ?>">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?> css/feedback.css?v=<?= time() ?>">
        <title>Add Feedback</title>
    </head>
    <body>
        <div class="form-container">
            <div class="h2-div">
                <h2>Add Feedback</h2>
            </div>
            <form action="index.php?page=feedback" method="POST">
                <textarea id="feedback" name="feedback" placeholder="Write your feedback here..." rows="6" required></textarea>

                <button type="submit">Submit Feedback</button>
            </form>
        </div>
    </body>
</html>
