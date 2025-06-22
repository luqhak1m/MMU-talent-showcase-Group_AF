

<?php


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/add-forum-form.css?v=<?= time() ?>">
        <title>Add Announcement</title>
    </head>
    <body>
        <div class="form-container">
            <h2><?php echo isset($announcement) ? "Edit Announcement" : "Add Announcement"; ?></h2>
            <form action="index.php?page=admin_manage_announcement<?php
                if(!isset($announcement)){
                    echo '&action=create';
                }else{
                    echo '&id='.$announcement['AnnouncementID'].'&action=edit';
                }
            ?>" method="POST">
                <label for="announcement-title">Announcement Title</label>
                <input type="text" id="announcement-title" name="announcement-title" placeholder="Enter announcement title" value="<?php echo isset($announcement) ? $announcement['AnnouncementTitle'] : ''; ?>" required>

                <label for="announcement-details">Announcement Details</label>
                <textarea id="announcement-details" name="announcement-details" placeholder="Write your announcement here..." rows="6" required><?php echo isset($announcement) ? $announcement['Announcement'] : ''; ?></textarea>

                <button type="submit"><?php echo isset($announcement) ? "Edit Announcement" : "Post Announcement"; ?></button>
            </form>
        </div>
    </body>
</html>