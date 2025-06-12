<?php

# Import the necessary MODEL files
require_once __DIR__ . '/Model/ObjectModel.php';

# Encapsulate the controller logic in a class
# Name the class according to the function it serves
# Usage example:
#                   $functionController = new FunctionNameController();
#                   $functionController->function1();
class FunctionNameController {
	private $object_model;

    public function __construct($dbCredentials){
        $object_model=new ObjectModel($dbCredentials);
    }
	public function function1() {

	} 
}