<?php 
# Include the header and footer files for the page
require_once __DIR__ . '/../../public/header.php';

// These variables are expected to be passed from the LeaderboardController::viewLeaderboard() method
// Initialize them to empty arrays/default values if not set to prevent errors during initial load
if (!isset($top3Talents)) {
    $top3Talents = [];
}
if (!isset($remainingTalents)) {
    $remainingTalents = [];
}
if (!isset($categories)) {
    $categories = []; // Should be populated by controller
}
if (!isset($selectedCategory)) {
    $selectedCategory = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="../public/css/leaderboard.css">
    <script src="../js/leaderboard.js"></script>
</head>
<body>
    <div class="leader-container">
        <div class="top-container">
            <div class="top-left-container">
                <h2>Leaderboard</h2>
                <p>Most Liked Talents</p>
            </div>
            <div class="top-right-container">
                <form action="<?= BASE_URL ?>index.php" method="GET">
                    <input type="hidden" name="page" value="leaderboard">
                    <select name="category" class="filter-dropdown" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <?php
                        foreach ($categories as $cat) {
                            $isSelected = ($selectedCategory === $cat) ? 'selected' : '';
                            echo "<option value=\"" . htmlspecialchars($cat) . "\" $isSelected>" . htmlspecialchars($cat) . "</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>
        </div>

        <div class="mid-container">
            <?php 
            // Position 2, 1, 3 
            $podiumOrder = [
                1 => $top3Talents[1] ?? null, // Second place (left)
                0 => $top3Talents[0] ?? null, // First place (center)
                2 => $top3Talents[2] ?? null  // Third place (right)
            ];

            foreach ($podiumOrder as $index => $talent): 
                if ($talent):
                    $rank = 0; // Placeholder
                    if ($index === 0) $rank = 1; // Center is 1st
                    else if ($index === 1) $rank = 2; // Left is 2nd
                    else if ($index === 2) $rank = 3; // Right is 3rd

                    $filename=$talent['Content'];
                    $extension=strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                    $audio_extensions=['mp3', 'wav', 'ogg', 'aac', 'flac'];

                    if(in_array($extension, $audio_extensions)){
                        $talentImagePath="images/audio_icon.png";
                    }else{
                        $talentImagePath='uploads/'.htmlspecialchars($filename);
                    }

            ?>
                    <div class="mid-talent-card rank-<?= $rank ?>">
                        <div class="rank-number">#<?= $rank ?></div>
                        <img src="<?= $talentImagePath ?>" alt="<?= htmlspecialchars($talent['TalentTitle']) ?> Image" class="talent-image-main">
                        <div class="likes-count">
                            <img class="likes-icon-small" src="<?= BASE_URL ?>images/likes_icon.png" alt="Likes Icon"> 
                            <?= htmlspecialchars($talent['TalentLikes']) ?>
                        </div>
                    </div>
            <?php 
                endif;
            endforeach; 
            ?>
        </div>

        <div class="bott-container">
            <?php 
            $startRank = 4; // Start ranking from 4 for the bottom list
            foreach ($remainingTalents as $index => $talent) :
                $currentRank = $startRank + $index;
                $filename=$talent['Content'];
                    $extension=strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                    $audio_extensions=['mp3', 'wav', 'ogg', 'aac', 'flac'];

                    if(in_array($extension, $audio_extensions)){
                        $talentImagePath="images/audio_icon.png";
                    }else{
                        $talentImagePath='uploads/'.htmlspecialchars($filename);
                    }
                // $talentImagePath = !empty($talent['Content']) ? BASE_URL . 'uploads/' . htmlspecialchars($talent['Content']) : 'https://placehold.co/60x60/cccccc/333333?text=No+Img';
            ?>
                <div class="bott-talent-row">
                    <div class="rank-num">#<?= $currentRank ?></div>
                    <img src="<?= $talentImagePath ?>" alt="<?= htmlspecialchars($talent['TalentTitle']) ?> Image" class="talent-image">
                    <div class="talent-name">@<?= htmlspecialchars($talent['Username']) ?></div>
                    <div class="talent-likes">
                        <img class="likes-icon-small" src="<?= BASE_URL ?>images/likes_icon.png" alt="Likes Icon"> 
                        <?= htmlspecialchars($talent['TalentLikes']) ?>
                    </div>
                </div>
            <?php 
            endforeach;
            if (empty($top3Talents) && empty($remainingTalents)): ?>
                <p style="text-align: center; padding: 50px; color: #777;">No talents found for the selected criteria.</p>
            <?php endif; ?>
        </div>
    </div>
    
    <?php 
    # Include the footer file
    require_once __DIR__ . '/../../public/footer.php';
    ?>
</body>
</html>
