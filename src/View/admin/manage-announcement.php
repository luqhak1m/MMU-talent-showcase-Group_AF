<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/forum.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/announcement.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>

    <div class="admin-container">
        <div class="header-add-div">
            <div class="placeholder-div"></div>
            <h1 class="admin-header-div">
                Announcement Management
            </h1>
            <div class="plus-button-div">
                <a href="index.php?page=admin_manage_announcement&action=create" class="plus-button button">+</a>
            </div>
        </div>
        <?php
        
        foreach($announcements as $announcement){
            echo '<div class="forum-listing">';
            echo '<h3>'.htmlspecialchars($announcement['AnnouncementTitle']).'</h3>';
            echo '<p>'.htmlspecialchars($announcement['Announcement']).'</p>';
            echo '<p>'.htmlspecialchars($announcement['AnnouncementTimestamp']).'</p>';
            echo '<div class="button-container-parent-div">';
            echo '<div class="button-container-div">';
            echo '<a href="index.php?page=admin_manage_announcement&id='.htmlspecialchars($announcement['AnnouncementID']).'&action=edit">Edit</a>';
            echo '<a href="index.php?page=admin_manage_announcement&id='.htmlspecialchars($announcement['AnnouncementID']).'&action=delete">Delete</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
        ?>
    </div>


</div>
</body>
</html>