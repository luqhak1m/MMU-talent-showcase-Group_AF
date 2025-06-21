<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/announcement.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/forum-feed.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/forum-post-details.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>

    <div class="admin-container">
        <h1 class="admin-header-div" id="announcement-header-div">
            Announcement
        </h1>
        <?php  
        
        foreach($announcements as $announcement){
            echo '<div class="post-link-wrapper">';
            echo '    <div class="post-upper-section-container-div">';
            echo '        <div class="pfp-upper-section-container-div">';
            echo '            <img src="images/admin_icon.png" alt="!!">';
            echo '            <div class="details-upper-section-container-div">';
            echo '                <div>';
            echo '                    <p>'.$announcement['AnnouncementTimestamp'].'</p>';
            echo '                    <p>Admin</p>';
            echo '                    <h4>'.$announcement['AnnouncementTitle'].'</h4>';
            echo '                    <p>';
            echo                        $announcement['Announcement'];
            echo '                    </p>';
            echo '                </div>';
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }

        

        ?>
    </div>


</body>
</html>