<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/announcement.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/faq.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/forum-feed.css?v=<?= time() ?>">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/forum-post-details.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>

    <div class="admin-container">
        <h1 class="admin-header-div" id="announcement-header-div">
            FAQ Management
        </h1>
        <?php  
        
        foreach($FAQs as $FAQ){
            echo '<div class="post-link-wrapper">';
            echo '    <div class="post-upper-section-container-div">';
            echo '        <div class="pfp-upper-section-container-div">';
            echo '            <div class="details-upper-section-container-div">';
            echo '                <div class="parent-content-div">';
            echo '                    <div class="left-content-div">';
            echo '                        <p>Question: <strong>'.$FAQ['Question'].'</strong></p>';
            echo '                        <div class="form-div">';
            echo '                        <form method="POST" action="index.php?page=admin_manage_faq&id='.$FAQ['FAQID'].'&action=answer">';
            echo '                            <label for="answer">Answer:</label><br>';
            echo '                            <textarea id="answer" name="answer" rows="3" cols="50">'.$FAQ['Answer'].'</textarea><br>';
            echo '                            <button type="submit" class="button">Save Answer</button>';
            echo '                        </form>';
            echo '                       </div>';
            echo '                    </div>';
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