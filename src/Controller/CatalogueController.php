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

    public function __construct($pdo){ // takes pdo instance as param to avoid reconnecting for every new model
        $this->catalogue_model=new CatalogueModel($pdo);
    }
	public function viewCatalogue(){
        $catalogue=$this->catalogue_model->fetchAllCatalogue();
        require_once __DIR__ . '/../View/catalogue.php';
	} 
}