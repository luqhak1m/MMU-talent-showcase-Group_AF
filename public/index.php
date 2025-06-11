<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config/database.php';

if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page='home';
}

$viewPath = __DIR__ . '/../src/View/' . $page . '.php';


switch ($page) {
	case 'register':
        require_once __DIR__ . '/../src/Controller/AuthController.php';
		$userController=new UserController($dbCredentials);
        $userController->register();
        break;
		
	case 'login':
		require_once __DIR__ . '/../src/Controller/AuthController.php';
		$userController=new UserController($dbCredentials);
		$userController->login();
		break;
		
	default:
		if (file_exists($viewPath)) {
			require_once $viewPath;
		} else {
			http_response_code(404);
			echo "<h1>404 - Page Not Found</h1>";
		}
}

// $userId = 'TEMPUSER';

// $uploadDir = __DIR__ . "/uploads/";
// if (!is_dir($uploadDir)) {
//     mkdir($uploadDir, 0755, true);
// }

// # media ID
// function generateMediaId($length = 6) {
//     return bin2hex(random_bytes($length / 2));
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['mediaFile'])) {
//     $mediaId = generateMediaId();
//     $fileType = pathinfo($_FILES['mediaFile']['name'], PATHINFO_EXTENSION);
//     $safeFileType = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $fileType));
//     $fileName = "{$userId}_{$mediaId}.{$safeFileType}";
//     $targetFile = $uploadDir . $fileName;
//     $publicPath = "uploads/" . $fileName;

//     if (move_uploaded_file($_FILES['mediaFile']['tmp_name'], $targetFile)) {
//         echo "<p>File uploaded successfully as: <strong>$fileName</strong></p>";
//         echo "<p>Preview:</p>";
//         $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
//         if (in_array($safeFileType, $imageTypes)) {
//             echo "<img src='$publicPath' style='max-width:300px;'><br>";
//         } else {
//             echo "<a href='$publicPath' download>Download File</a><br>";
//         }
//     } else {
// 		echo "<pre>";
// 		print_r($_FILES['mediaFile']);
// 		echo "</pre>";

// 		echo "<br>";
// 		echo "dir: $uploadDir <br>";
// 		echo "filename $fileName <br>";
// 		echo "target file $targetFile <br>";
// 		echo "public path $publicPath <br>";
//         echo "<p>File upload failed.</p>";
//     }
// }


