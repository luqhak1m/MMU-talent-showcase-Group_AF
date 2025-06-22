<?php

# Import the necessary MODEL files
require_once __DIR__ . '/../Model/CatalogueModel.php';

# Encapsulate the controller logic in a class
# Name the class according to the function it serves
# Usage example:
#                   $functionController = new FunctionNameController();
#                   $functionController->function1();
class CatalogueController {
	private $catalogue_model;
	private $user_model;

    public function __construct($pdo){ // takes pdo instance as param to avoid reconnecting for every new model
        $this->catalogue_model=new CatalogueModel($pdo);
        $this->user_model=new CatalogueModel($pdo);
    }
	public function viewCatalogue(){
        // Get search and category from the URL query
        $search = $_GET['search'] ?? null;
        $category = $_GET['category'] ?? null;

        // Fetch the filtered/searched catalogue
        $catalogue=$this->catalogue_model->fetchAllCatalogue($search, $category);
        require_once __DIR__ . '/../View/catalogue.php';
	} 

    public function adminManageCatalogue() {
        $catalogueItems = $this->catalogue_model->fetchAllCatalogue(); // match variable name
        require_once __DIR__ . '/../View/admin/manage-catalogue.php';
    }


    public function editCatalogue($catalogueID) {
        $item = $this->catalogue_model->getCatalogueByID($catalogueID);
        require_once __DIR__ . '/../View/admin/edit-catalogue.php';
    }

    public function deleteCatalogue($catalogueID) {
        $this->catalogue_model->deleteCatalogueByID($catalogueID);
        header("Location: index.php?page=admin_manage_catalogue");
        exit;
    }
}