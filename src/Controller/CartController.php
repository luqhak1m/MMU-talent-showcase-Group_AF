<?php

# Import necessary MODEL files
require_once __DIR__ . '/../Model/CartModel.php';
require_once __DIR__ . '/../Model/TalentModel.php'; 
require_once __DIR__ . '/../Model/OfferModel.php'; 
require_once __DIR__ . '/../Model/UserModel.php'; 
require_once __DIR__ . '/../Model/ProfileModel.php'; 
require_once __DIR__ . '/../Model/CatalogueModel.php'; 

class CartController {
    private $cartModel;
    private $talentModel;
    private $catalogueModel; 
    private $offerModel;     
    private $profileModel;   
    private $userModel;      

    public function __construct($pdo) {

        $this->catalogueModel = new CatalogueModel($pdo); 
        $this->profileModel = new ProfileModel($pdo); 

        $this->userModel = new UserModel($pdo, $this->profileModel, $this->catalogueModel); 
        
        $this->cartModel = new CartModel($pdo);

        $this->talentModel = new TalentModel($pdo, $this->catalogueModel); 
        
        $this->offerModel = new OfferModel($pdo); 
    }


    public function addToCart() {

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login&error=login_required_to_add_to_cart');
            exit();
        }

        $userID = $_SESSION['user_id'];
        $talentID = $_GET['talent_id'] ?? null;


        if (!$talentID) {
            header('Location: ' . BASE_URL . 'index.php?page=catalogue&error=talent_not_specified');
            exit();
        }


        $talent = $this->talentModel->fetchTalentByTalentID($talentID);

        if (!$talent) {
            header('Location: ' . BASE_URL . 'index.php?page=catalogue&error=talent_not_found');
            exit();
        }

        $price = (float) $talent['Price']; 

 
        $userCart = $this->cartModel->getCartByUserId($userID);
        $cartID = null;

        if (!$userCart) {

            $cartID = $this->cartModel->createCart($userID);
            if (!$cartID) {
                error_log("Failed to create cart for user: " . $userID);
                header('Location: ' . BASE_URL . 'index.php?page=talent&id=' . htmlspecialchars($talentID) . '&error=failed_to_create_cart');
                exit();
            }
        } else {
            $cartID = $userCart['CartID'];
        }


        $cartItem = $this->cartModel->getCartItem($cartID, $talentID);
        $success = false;

        if ($cartItem) {

            $newQuantity = $cartItem['Quantity'] + 1;
            $success = $this->cartModel->updateCartItemQuantity($cartItem['ItemID'], $newQuantity, $price);
            if ($success) {
                $_SESSION['message'] = 'Quantity updated in cart!';
            } else {
                $_SESSION['error'] = 'Failed to update item quantity in cart.';
            }
        } else {

            $success = $this->cartModel->addCartItem($cartID, $talentID, $price, 1);
            if ($success) {
                $_SESSION['message'] = 'Talent added to cart successfully!';
            } else {
                $_SESSION['error'] = 'Failed to add talent to cart.';
            }
        }


        if (isset($_SESSION['message'])) {
            header('Location: ' . BASE_URL . 'index.php?page=talent&id=' . htmlspecialchars($talentID) . '&success_message=' . urlencode($_SESSION['message']));
            unset($_SESSION['message']);
        } elseif (isset($_SESSION['error'])) {
            header('Location: ' . BASE_URL . 'index.php?page=talent&id=' . htmlspecialchars($talentID) . '&error_message=' . urlencode($_SESSION['error']));
            unset($_SESSION['error']);
        } else {
            header('Location: ' . BASE_URL . 'index.php?page=talent&id=' . htmlspecialchars($talentID));
        }
        exit();
    }

    public function viewCart() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login&error=login_required_to_view_cart');
            exit();
        }

        $userID = $_SESSION['user_id'];
        $cart = $this->cartModel->getCartByUserId($userID);
        $cartItems = [];
        $cartTotal = 0.00;

        if ($cart) {
            $cartID = $cart['CartID'];
            $cartItems = $this->cartModel->getCartItemsWithDetails($cartID);
            $cartTotal = $this->cartModel->getCartTotal($cartID);
        }
        
        require_once __DIR__ . '/../View/cart.php';
    }


    public function deleteCartItem() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login&error=login_required_to_modify_cart');
            exit();
        }

        $itemID = $_GET['item_id'] ?? null;

        if (!$itemID) {
            header('Location: ' . BASE_URL . 'index.php?page=cart&error=item_not_specified');
            exit();
        }

        if ($this->cartModel->deleteCartItem($itemID)) {
            $_SESSION['message'] = 'Item removed from cart.';
        } else {
            $_SESSION['error'] = 'Failed to remove item from cart.';
        }

        header('Location: ' . BASE_URL . 'index.php?page=cart&success_message=' . urlencode($_SESSION['message'] ?? '') . '&error_message=' . urlencode($_SESSION['error'] ?? ''));
        unset($_SESSION['message'], $_SESSION['error']);
        exit();
    }

    public function sendMultipleOffers() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login&error=login_required_to_send_offers');
            exit();
        }

        $userID = $_SESSION['user_id'];
        $cart = $this->cartModel->getCartByUserId($userID);

        if (!$cart) {
            header('Location: ' . BASE_URL . 'index.php?page=cart&error=cart_empty');
            exit();
        }

        $cartID = $cart['CartID'];
        $cartItems = $this->cartModel->getCartItemsWithDetails($cartID);
        
        $offersSentCount = 0;
        $failedOffersCount = 0;

        foreach ($cartItems as $item) {
            $talentID = $item['TalentID'];
            $quantity = $item['Quantity']; 
            

            for ($i = 0; $i < $quantity; $i++) {

                $specificOfferDetails = $item['CartOfferDetails'] ?? ''; 

                $result = $this->offerModel->createOffer($userID, $talentID, $specificOfferDetails);

                if ($result) {
                    $offersSentCount++;
                } else {
                    $failedOffersCount++;
                    error_log("Failed to create offer for TalentID: " . $talentID . " (Unit " . ($i + 1) . ") for UserID: " . $userID . ". Details: " . $specificOfferDetails);
                }
            }
        }

        $this->cartModel->clearCart($cartID);

        $redirectParams = [];
        if ($offersSentCount > 0) {
            $redirectParams['success_message'] = "Successfully sent " . $offersSentCount . " offers. " . ($failedOffersCount > 0 ? " (" . $failedOffersCount . " failed). Please check logs for details." : "");
        } else {
            $redirectParams['error_message'] = "Failed to send any offers from your cart.";
        }

        header('Location: ' . BASE_URL . 'index.php?page=catalogue&' . http_build_query($redirectParams));
        exit();
    }


    public function updateCartItemOfferDetails() {
        header('Content-Type: application/json'); 

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Login required.']);
            exit();
        }

        $itemID = $_POST['item_id'] ?? null;
        $offerDetails = $_POST['offer_details'] ?? null;

        if (!$itemID || $offerDetails === null) { 
            echo json_encode(['success' => false, 'message' => 'Missing item ID or offer details.']);
            exit();
        }


        $success = $this->cartModel->updateCartItemOfferDetails($itemID, $offerDetails);

        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Offer details updated.']);
        } else {
            error_log("Failed to update offer details for ItemID: " . $itemID . " to '" . $offerDetails . "'");
            echo json_encode(['success' => false, 'message' => 'Failed to update offer details in database.']);
        }
        exit();
    }
}
