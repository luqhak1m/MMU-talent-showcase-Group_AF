<?php
# Include the header and footer files for the page
require_once __DIR__ . '/../../public/header.php';

if (isset($_GET['success_message'])) {
    echo '<div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin: 10px auto; max-width: 800px; border-radius: 5px;">' . htmlspecialchars($_GET['success_message']) . '</div>';
}
if (isset($_GET['error_message'])) {
    echo '<div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin: 10px auto; max-width: 800px; border-radius: 5px;">' . htmlspecialchars($_GET['error_message']) . '</div>';
}


if (!isset($cartItems)) {
    $cartItems = [];
}
if (!isset($cartTotal)) {
    $cartTotal = 0.00;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/cart.css?v=<?= time() ?>">
</head>
<body>
    <div class="cart-page-wrapper">
        <h2 class="cart-title">Cart</h2>

        <?php if (!empty($cartItems)): ?>
            <div class="cart-headers">
                <div class="cart-headers-left">Talent</div>
                <div class="cart-headers-center">Offer Detail</div>
                <div class="cart-headers-right">Price (RM)</div>
            </div>

            <div class="cart-item-list">
                <?php 
                foreach ($cartItems as $item): 
                    $sellerProfilePicturePath = !empty($item['SellerProfilePicture']) ? BASE_URL . 'uploads/' . htmlspecialchars($item['SellerProfilePicture']) : BASE_URL . 'images/profile.png';
                ?>
                    <div class="cart-item-card" data-item-id="<?= htmlspecialchars($item['ItemID']) ?>">
                        <div class="cart-item-talent-info">

                            <img class="seller-profile-picture" src="<?= $sellerProfilePicturePath ?>" alt="<?= htmlspecialchars($item['SellerUsername']) ?>'s Profile">
                            <p class="seller-username">@<?= htmlspecialchars($item['SellerUsername']) ?></p>
                        </div>

                        <div class="cart-item-offer-details">
                            <p class="offer-detail-text" data-field="cart_offer_details"><?= htmlspecialchars($item['CartOfferDetails'] ?? '') ?></p>
                            <textarea class="offer-detail-textarea hidden" data-field="cart_offer_details_edit"><?= htmlspecialchars($item['CartOfferDetails'] ?? '') ?></textarea>
                            
                            <div class="cart-item-buttons">
                                <a href="#" class="button edit-button">Edit Offer</a>
                                <a href="#" class="button save-button hidden">Save</a>
                                <a href="#" class="button cancel-button hidden">Cancel</a>
                                <a href="<?= BASE_URL ?>index.php?page=cart&action=delete_item&item_id=<?= htmlspecialchars($item['ItemID']) ?>" class="button delete-button">Delete Item</a>
                            </div>
                        </div>

                        <div class="cart-item-price-column">
                            <p class="cart-item-price">RM<?= number_format($cartTotal, 2) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary-section">
                <div class="cart-total-display">Total (RM) <?= number_format($cartTotal, 2) ?></div>
                <form action="<?= BASE_URL ?>index.php?page=cart&action=send_multiple_offers" method="POST" class="send-offers-form">
                    <button type="submit" class="btn-send-offers">Send Offers</button>
                </form>
            </div>
        <?php else: ?>
            <p class="empty-cart-message">Your cart is empty. Start adding some talents!</p>
            <div style="text-align: center; margin-top: 20px;">
                <a href="<?= BASE_URL ?>index.php?page=catalogue" class="browse-talents-btn">Browse Talents</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        const BASE_URL = '<?= BASE_URL ?>';
    </script>
    <script src="<?= BASE_URL ?>js/cart.js"></script>
</body>
</html>
