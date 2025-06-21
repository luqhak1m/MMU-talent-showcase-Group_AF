<?php require_once __DIR__ . '/../../../public/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/home.css">
</head>

<body class="index-body">

    // Author: Sabrina
    <div class="container-div" id="adminlist-container-div" style="padding-bottom: 2em;">
        <h1>Admin Dashboard</h1>

        <a href="index.php?page=admin_manage_announcement" class="button">Manage Annoucement</a>
        <a href="index.php?page=admin_manage_user" class="button">Manage User</a>
        <a href="index.php?page=admin_manage_catalogue" class="button">Manage Catalogue</a>
        <a href="index.php?page=admin_manage_feedback" class="button">Manage Feedback</a>
        <a href="index.php?page=admin_manage_faq" class="button">Manage FAQ</a>
    </div>

</body>

</html>
<?php require_once __DIR__ . '/../../../public/footer.php'; ?>
