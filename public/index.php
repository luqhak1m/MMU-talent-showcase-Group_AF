<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
define('BASE_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/');
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
        $userController = new UserController($pdo);
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

	case 'admin_login':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->login();
        break;

    case 'admin_dashboard':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->dashboard();
        break;

    case 'admin_view_profile':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->viewUserProfile();
        break;

    case 'admin_edit_profile':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->editUserProfile();
        break;

	case 'talent':
		require_once __DIR__ . '/../src/Controller/TalentController.php';
		$talentController=new TalentController($pdo);

		if(isset($_GET['id'])){ // index.php?page=X&id=Y
			$talent_id=$_GET['id'];
			if(isset($_GET['action'])){
				if($_GET['action']=="del"){
					$talentController->deleteTalent($talent_id);
					break;
				}
				if($_GET['action']=="edit"){
					$talentController->editTalent($talent_id);
					break;
				}
			}
			$talentController->viewSpecificTalent($talent_id);
			break;
		}else{
			$talentController->viewTalent();
			break;
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


