<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database_config.php';
$pdo=connectToDatabase($dbCredentials);
session_start();

if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page='home';
}

$viewPath = __DIR__ . '/../src/View/' . $page . '.php';


switch ($page) {
	case 'register':
        require_once __DIR__ . '/../src/Controller/AuthController.php';
		$userController=new UserController($pdo);
        $userController->register();
        break;
		
	case 'login':
		require_once __DIR__ . '/../src/Controller/AuthController.php';
		$userController=new UserController($pdo);
		$userController->login();
		break;
		
	case 'logout':
		require_once __DIR__ . '/../src/Controller/AuthController.php';
		$userController=new UserController($pdo);
		$userController->logout();
		break;

	case 'profile':
		require_once __DIR__ . '/../src/Controller/ProfileController.php';
		$profileController=new ProfileController($pdo);
		$profileController->viewProfile();
		break;
	case 'catalogue':
		require_once __DIR__ . '/../src/Controller/CatalogueController.php';
		$catalogueController=new CatalogueController($pdo);
		$catalogueController->viewCatalogue();
		break;
	case 'profile':
		require_once __DIR__ . '/../src/Controller/ProfileController.php';
		$profileController=new ProfileController($pdo);
		$profileController->viewProfile();
		break;

	case 'talent':
		require_once __DIR__ . '/../src/Controller/TalentController.php';
		$talentController=new TalentController($pdo);

		if(isset($_GET['id'])){ // index.php?page=X&id=Y
			$talent_id=$_GET['id'];
			$talentController->viewSpecificTalent($talent_id);
		}else{
			$talentController->viewTalent();
		}
		break;
		
	default:
		if(file_exists($viewPath)) {
			require_once $viewPath;
		}else {
			http_response_code(404);
			echo "<h1>404 - Page Not Found</h1>";
		}
}


