<?php require_once __DIR__ . '/../../../public/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="<?= BASE_URL ?>/js/home.js"></script>
</head>

<body class="index-body">

    <div class="container-div" id="admin-container-div" style="height: 20em;">
        <h1>
            <?php
                if (isset($_SESSION['username'])) {
                    echo "Welcome, " . htmlspecialchars($_SESSION['username']) . " (Admin)";
                } else {
                    echo "Admin Dashboard";
                }
            ?>
        </h1>
        <p>Manage various aspects of the MMU Talent Portal.</p>

        <div style="margin-top: 2em;">
            <a href="index.php?page=admin_manage_announcement" class="button">Manage Announcement</a>
            <a href="index.php?page=admin_manage_user" class="button">Manage User</a>
            <a href="index.php?page=admin_manage_catalogue" class="button">Manage Catalogue</a>
            <a href="index.php?page=admin_manage_feedback" class="button">Manage Feedback</a>
            <a href="index.php?page=admin_manage_faq" class="button">Manage FAQ</a>
        </div>

        <div style="margin-top: 2em;">
            <?php
                if (!isset($_SESSION['username'])) {
                    echo '<a href="?page=login" class="button">Login</a>';
                    echo '<a href="?page=register" class="button">Register</a>';
                } else {
                    echo '<a href="' . BASE_URL . 'index.php?page=logout" class="button">Log Out</a>';
                }
            ?>
        </div>
    </div>

</body>

</html>
<?php require_once __DIR__ . '/../../../public/footer.php'; ?>
