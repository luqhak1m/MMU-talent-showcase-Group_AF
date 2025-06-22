<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/announcement.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/faq.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/forum-feed.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css//forum-post-details.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>

    <div class="container-div" style="padding-top: 2em; height: auto; min-height: 100vh;">
            <h1 style="text-align: center" class="page-title">FAQ Management</h1> 
            <div style="text-align: right; margin-bottom: 1em;">
                <a href="<?= BASE_URL ?>index.php?page=admin_manage_faq&action=create" class="button plus-button">+</a>
            </div>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>

        <table border="1" style="width:90%; margin: 2em auto; border-collapse: collapse; background-color: #fff;">
            <thead>
                <tr style="background-color: #E7E6F2;">
                    <th style="padding: 8px;">Question</th>
                    <th style="padding: 8px;">Answer</th>
                    <th style="padding: 8px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($FAQs)): ?>
                    <?php foreach ($FAQs as $faq): ?>
                        <tr>
                            <td style="padding: 8px;"><?php echo htmlspecialchars($faq['Question'] ?? ''); ?></td>
                            <td style="padding: 8px;"><?php echo htmlspecialchars($faq['Answer'] ?? ''); ?></td>
                            <td style="padding: 8px;">
                                <a href="index.php?page=admin_manage_faq&action=edit&id=<?php echo htmlspecialchars($faq['FAQID']); ?>" class="button" id="list-button">Edit</a>
                                <a href="index.php?page=admin_manage_faq&action=delete&id=<?php echo htmlspecialchars($faq['FAQID']); ?>" class="button" id="list-button" onclick="return confirm('Are you sure you want to delete this FAQ?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 8px;">No FAQs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php?page=admin_dashboard" class="button">Back to Dashboard</a>
        </div>
    </div>

</body>
</html>