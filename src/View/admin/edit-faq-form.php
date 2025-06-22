<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit FAQ</title>
    
    <!-- Reuse all styles from FAQ Management -->
    <link rel="stylesheet" href="<?= BASE_URL ?>css/announcement.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/faq.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/forum-feed.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/forum-post-details.css?v=<?= time() ?>">
</head>
<body>

    <div class="container-div" style="padding-top: 2em; height: auto; min-height: 100vh;">
        <h1 class="page-title" id="feedback-header-div">Edit FAQ</h1>

        <form method="POST" action="index.php?page=admin_manage_faq&action=edit&id=<?= htmlspecialchars($faq['FAQID']) ?>" 
              style="width: 90%; margin: 0 auto; background-color: #fff; padding: 2em; border-radius: 10px;">

            <div class="form-group" style="margin-bottom: 1.5em;">
                <label for="question"><strong>Question:</strong></label>
                <input type="text" id="question" name="question" value="<?= htmlspecialchars($faq['Question']) ?>" 
                       readonly style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div class="form-group" style="margin-bottom: 2em;">
                <label for="answer"><strong>Answer:</strong></label>
                <textarea id="answer" name="answer" rows="6" required
                          style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;"><?= htmlspecialchars($faq['Answer'] ?? '') ?></textarea>
            </div>

            <div style="display: flex; justify-content: space-between;">
                <button type="submit" class="button" id="list-button">Update</button>
                <a href="index.php?page=admin_manage_faq" class="button" id="list-button" style="text-align: center;">Cancel</a>
            </div>
        </form>

        <div style="text-align: center; margin-top: 2em;">
            <a href="index.php?page=admin_dashboard" class="button">Back to Dashboard</a>
        </div>
    </div>

</body>
</html>

