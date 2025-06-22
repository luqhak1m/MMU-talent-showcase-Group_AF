<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/ID-Generator.inc.php'; 

class CartModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function getCartByUserId(string $userID): ?array {
        $sql = "SELECT CartID, UserID FROM Cart WHERE UserID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    }


    public function createCart(string $userID) {
        $cartID = generateID(); 
        $sql = "INSERT INTO Cart (CartID, UserID) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute([$cartID, $userID])) {
            return $cartID;
        }
        return false;
    }


    public function getCartItem(string $cartID, string $talentID): ?array {
        $sql = "SELECT ItemID, CartID, TalentID, Price, Quantity, Total FROM CartItem WHERE CartID = ? AND TalentID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cartID, $talentID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    }


    public function addCartItem(string $cartID, string $talentID, float $price, int $quantity = 1): bool {
        $itemID = generateID(); 
        $total = $price * $quantity;

        $talentDetails = $this->pdo->prepare("SELECT TalentDescription FROM Talent WHERE TalentID = ?");
        $talentDetails->execute([$talentID]);
        $description = $talentDetails->fetchColumn();

        $sql = "INSERT INTO CartItem (ItemID, CartID, TalentID, Price, Quantity, Total, TalentDescription) VALUES (?, ?, ?, ?, ?, ?, ?)"; // Added TalentDescription
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$itemID, $cartID, $talentID, $price, $quantity, $total, $description]);
    }


    public function updateCartItemQuantity(string $itemID, int $newQuantity, float $newPrice): bool {
        $newTotal = $newPrice * $newQuantity;
        $sql = "UPDATE CartItem SET Quantity = ?, Total = ? WHERE ItemID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$newQuantity, $newTotal, $itemID]);
    }

    public function updateCartItemOfferDetails(string $itemID, string $newOfferDetails): bool {

        $sql = "UPDATE CartItem SET TalentDescription = ? WHERE ItemID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$newOfferDetails, $itemID]);
    }


    public function getCartItemsWithDetails(string $cartID): array {
        $sql = "SELECT 
                    ci.ItemID, ci.CartID, ci.TalentID, ci.Price AS CartItemPrice, ci.Quantity, ci.Total,
                    ci.TalentDescription AS CartOfferDetails,
                    t.TalentTitle, t.Content, t.Price AS TalentOriginalPrice,
                    u.Username AS SellerUsername,
                    p.ProfilePicture AS SellerProfilePicture
                FROM CartItem ci
                JOIN Talent t ON ci.TalentID = t.TalentID
                JOIN User u ON t.UserID = u.UserID
                LEFT JOIN Profile p ON u.UserID = p.UserID
                WHERE ci.CartID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cartID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getCartTotal(string $cartID): float {
        $sql = "SELECT SUM(Total) AS GrandTotal FROM CartItem WHERE CartID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cartID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (float) ($result['GrandTotal'] ?? 0.00);
    }


    public function deleteCartItem(string $itemID): bool {
        $sql = "DELETE FROM CartItem WHERE ItemID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$itemID]);
    }


    public function clearCart(string $cartID): bool {
        $sql = "DELETE FROM CartItem WHERE CartID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$cartID]);
    }
}
