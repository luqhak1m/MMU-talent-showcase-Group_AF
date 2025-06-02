<?php
session_start();

$path = realpath(__DIR__ . '/../config/db.php');
if ($path && file_exists($path)) {
    echo "Found db.php at: $path";
} else {
    echo "db.php NOT found at: " . __DIR__ . '/../config/db.php';
}

require_once __DIR__ . '/../config/db.php';

if ($pdo) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed.";
}

$userId = 'TEMPUSER';

$uploadDir = __DIR__ . "/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

# media ID
function generateMediaId($length = 6) {
    return bin2hex(random_bytes($length / 2));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['mediaFile'])) {
    $mediaId = generateMediaId();
    $fileType = pathinfo($_FILES['mediaFile']['name'], PATHINFO_EXTENSION);
    $safeFileType = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $fileType));
    $fileName = "{$userId}_{$mediaId}.{$safeFileType}";
    $targetFile = $uploadDir . $fileName;
    $publicPath = "uploads/" . $fileName;

    if (move_uploaded_file($_FILES['mediaFile']['tmp_name'], $targetFile)) {
        echo "<p>File uploaded successfully as: <strong>$fileName</strong></p>";
        echo "<p>Preview:</p>";
        $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($safeFileType, $imageTypes)) {
            echo "<img src='$publicPath' style='max-width:300px;'><br>";
        } else {
            echo "<a href='$publicPath' download>Download File</a><br>";
        }
    } else {
		echo "<pre>";
		print_r($_FILES['mediaFile']);
		echo "</pre>";

		echo "<br>";
		echo "dir: $uploadDir <br>";
		echo "filename $fileName <br>";
		echo "target file $targetFile <br>";
		echo "public path $publicPath <br>";
        echo "<p>File upload failed.</p>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to My Website</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body class="index-body">

	<div>
		<h1>Welcome to MMU Talent Portal</h1>
		<p>Your one-stop portal for stuff.</p>
		<a href="login.php" class="button">Login</a>
		<a href="register.php" class="button">Register</a>
	</div>


	<br>

	<div>
		<h2>try upload a media</h2>
		<form method="post" enctype="multipart/form-data">
		<label for="mediaFile">Choose a file to upload:</label>
		<input type="file" name="mediaFile" required>
		<button type="submit" name="submit">Upload</button>
	</div>
</form>

</body>
</html>
