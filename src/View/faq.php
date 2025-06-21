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
        <div class="header-add-div">
            <div class="placeholder-div"></div>
            <h1 class="admin-header-div">
                FAQ Management
            </h1>
            <div class="plus-button-div">
                <a href="index.php?page=faq&action=create" class="plus-button button">+</a>
            </div>
        </div>
        <?php  
        
        foreach($FAQs as $FAQ){
            echo '<div class="post-link-wrapper">';
            echo '    <div class="post-upper-section-container-div">';
            echo '        <div class="pfp-upper-section-container-div">';
            echo '            <div class="details-upper-section-container-div">';
            echo '                <div class="parent-content-div">';
            echo '                  <div class="left-content-div">';
            echo '                    <p>Question: <strong>'.$FAQ['Question'].'</strong></p>';
            echo '                    <p>Answer: <strong>'.$FAQ['Answer'].'</strong></p>';
            echo '                  </div>';
            echo '                  </div>';
            echo '              </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }


        

        ?>
    </div>


</body>
</html>