<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/announcement.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/feedback.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/forum-feed.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/forum-post-details.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>

    <div class="admin-container">
        <h1 class="admin-header-div" id="announcement-header-div">
            Feedback Management
        </h1>
        <?php  
        
        foreach($feedbacks as $feedback){
            echo '<div class="post-link-wrapper">';
            echo '    <div class="post-upper-section-container-div">';
            echo '        <div class="pfp-upper-section-container-div">';
            echo '            <img src="uploads/'.$feedback['ProfilePicture'].'" alt="!!">';
            echo '            <div class="details-upper-section-container-div">';
            echo '                <div class="parent-content-div">';

            echo '                  <div class="left-content-div">';
            echo '                    <p>@'.$feedback['Username'].'</p>';
            echo '                    <p>'.htmlspecialchars($feedback['Feedback']).'</p>';
            echo '                  </div>';

            echo '                  <div class="right-content-div">';
            echo '                    <form class="status-form" method="POST" action="index.php?page=admin_manage_feedback&id='.$feedback['FeedbackID'].'&action=update">';
            echo '                        <label>Status:</label>';
            echo '                        <select name="feedback">';
            echo '                            <option disabled '.($feedback['FeedbackStatus'] === '' ? 'selected' : '').'>Select Status</option>';
            echo '                            <option value="Pending" '.($feedback['FeedbackStatus'] === 'Pending' ? 'selected' : '').'>Pending</option>';
            echo '                            <option value="InProgress" '.($feedback['FeedbackStatus'] === 'InProgress' ? 'selected' : '').'>In Progress</option>';
            echo '                            <option value="Resolved" '.($feedback['FeedbackStatus'] === 'Resolved' ? 'selected' : '').'>Resolved</option>';
            echo '                        </select>';
            echo '                        <button type="submit" class="button">Save</button>';
            echo '                    </form>';
            echo '                  </div>';

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