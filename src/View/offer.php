<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/header.php';

$profilePicturePath = 'images/profile.png'; 
if (isset($talent['ProfilePicture']) && !empty($talent['ProfilePicture'])) {
    $profilePicturePath = BASE_URL . 'uploads/' . htmlspecialchars($talent['ProfilePicture']);
}

$talentImagePath = ''; 
if (isset($talent['Content']) && !empty($talent['Content'])) {
    $talentImagePath = BASE_URL . 'uploads/' . htmlspecialchars($talent['Content']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Offer for <?= htmlspecialchars($talent['TalentTitle'] ?? 'Talent') ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/offer.css">

</head>
<body>
    <div class="offer-page-container">
        <?php if (isset($talent) && $talent): ?>
            <div class="offer-form-column">
                <h2>Make offer for a service or product</h2>

                <div class="seller-info-card">
                    <img class="seller-profile-picture" src="<?= $profilePicturePath ?>" alt="Seller Profile Picture">
                    <div class="seller-details-text">
                        <p>@<?= htmlspecialchars($talent['Username']) ?></p>
                        <p class="talent-title"><?= htmlspecialchars($talent['TalentTitle']) ?></p>
                        <p class="talent-price">RM<?= htmlspecialchars($talent['Price']) ?></p>
                    </div>
                </div>

                <form action="<?= BASE_URL ?>index.php?page=offer&action=submit_offer&talent_id=<?= htmlspecialchars($talent['TalentID'] ?? '') ?>" method="POST">
                    
                    <div class="form-group">
                        <input type="text" id="email" name="email" placeholder="<?=$_SESSION['username']?>" readonly>
                    </div>

                    <div class="form-group">
                        <input type="text" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <textarea id="offerDetails" name="offerDetails" placeholder="Please type your request here..." rows="5"></textarea>
                    </div>
                    
                    <input type="hidden" name="talent_id" value="<?= htmlspecialchars($talent['TalentID'] ?? '') ?>">

                    <button type="submit" class="btn-submit-offer">Send Offer</button>
                </form>
            </div>

            <div class="talent-image-column">
                <?php if (!empty($talentImagePath)): ?>
                    <img src="<?= $talentImagePath ?>" alt="Talent Image">
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Talent details could not be loaded. Please go back to the <a href="<?= BASE_URL ?>index.php?page=catalogue">catalogue</a> and select a talent.</p>
        <?php endif; ?>
    </div>

<?php 

# Include the header and footer files for the login page
require_once __DIR__ . '/../../public/footer.php';

?>