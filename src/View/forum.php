
<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/forum.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>
    <div class="upper-section-div">

        <div class="search-filter-container-div">
            <div class="search-wrapper-div">
                <div class="search-field-div">
                    <input type="text" placeholder="Search for forum..." class="search-input" />
                </div>
            </div>
            <div class="filter-wrapper-div">
                <div class="filter-div">
                    <select class="filter-dropdown">
                        <option value="">Filter By</option>
                        <option value="design">Art</option>
                        <option value="development">Music</option>
                        <option value="marketing">Video</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="text-div">
            <div clas="browse-forum-text-div">
                <h2>Browse Popular Forums</h2>
            </div>
            <div clas="create-forum-text-div">
                <a href='index.php?page=forum&action=create' class='browse-forum-button'>Create Forum</a>
                <a href='index.php?page=forum&id=<?php echo $_SESSION['user_id']; ?>&action=joined' class='browse-forum-button'>Joined Forum</a>
            </div>
        </div>
    </div>
        <?php
    
    foreach($fetched_forums as $forum){
        echo '<div class="forum-listing">';
        echo '<h3>'.htmlspecialchars($forum['ForumName']).'</h3>';
        echo '<p>'.htmlspecialchars($forum['ForumDescription']).'</p>';
        echo '<div class="button-container-parent-div">';
        echo '<div class="button-container-div">';
        echo '<a href="index.php?page=forum&id='.$forum['ForumID'].'&action=join">Join</a>';
        echo '<a href="index.php?page=forum&id='.$forum['ForumID'].'&action=view">View</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    ?>
</body>
</html>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>