<?php

require_once __DIR__ . '/../Model/OfferModel.php';
require_once __DIR__ . '/../Model/TalentModel.php';
require_once __DIR__ . '/../Model/UserModel.php'; 
require_once __DIR__ . '/../Model/ProfileModel.php'; 
require_once __DIR__ . '/../Model/CatalogueModel.php';


class OfferController {
	private $offerModel;
    private $talentModel;
    private $userModel;
    private $profileModel;   
    private $catalogueModel; 

    public function __construct($pdo){ 
        $this->offerModel = new OfferModel($pdo);
        $this->catalogueModel = new CatalogueModel($pdo);
        $this->profileModel = new ProfileModel($pdo);
        $this->talentModel = new TalentModel($pdo, $this->catalogueModel);
        $this->userModel = new UserModel($pdo, $this->profileModel, $this->catalogueModel);
    }

	public function viewOfferForm() {
        $talent = null;
        $talentID = $_GET['talent_id'] ?? null;

        // Fetch talent details to display on the form
        if ($talentID) {
            $talent = $this->talentModel->fetchTalentByTalentID($talentID);
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'submit_offer') {
            
            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {

                header('Location: ' . BASE_URL . 'index.php?page=login&error=not_logged_in_for_offer');
                exit();
            }

            $userID = $_SESSION['user_id']; 
            $submittedTalentID = $_POST['talent_id'] ?? null;
            $offerDetails = trim($_POST['offerDetails'] ?? '');

            // Validate input
            if (!$submittedTalentID || empty($offerDetails)) {

                error_log("Error: Missing talent ID or offer details during offer submission.");

                header('Location: ' . BASE_URL . 'index.php?page=talent&id=' . htmlspecialchars($talentID) . '&error=missing_offer_details');
                exit();
            }


            if ($talentID !== $submittedTalentID) {
                error_log("Security Alert: Talent ID mismatch between GET and POST for offer.");
                header('Location: ' . BASE_URL . 'index.php?page=talent&id=' . htmlspecialchars($talentID) . '&error=talent_id_mismatch');
                exit();
            }

            // Create the offer
            $result = $this->offerModel->createOffer($userID, $submittedTalentID, $offerDetails);

            if ($result) {

                header('Location: ' . BASE_URL . 'index.php?page=talent&id=' . htmlspecialchars($submittedTalentID) . '&success=offer_sent');
                exit();
            } else {

                error_log("Error: Failed to create offer in database.");

                header('Location: ' . BASE_URL . 'index.php?page=offer&talent_id=' . htmlspecialchars($submittedTalentID) . '&error=offer_failed');
                exit();
            }
	    } 

        require_once __DIR__ . '/../View/offer.php';
    }
}