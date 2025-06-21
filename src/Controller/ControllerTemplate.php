<?php

# Import the necessary MODEL files
require_once __DIR__ . '/../Model/ObjectModel.php';

# Encapsulate the controller logic in a class
# Name the class according to the function it serves
# Usage example:
#                   $functionController = new FunctionNameController();
#                   $functionController->function1();
class FunctionNameController {
	private $object_model;

    public function __construct($pdo){ // takes pdo instance as param to avoid reconnecting for every new model, no need to modify
        $object_model=new ObjectModel($pdo);
    }
	public function function1() {

	} 
}