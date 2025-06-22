<?php

// echo "[INFO] Loaded register.php <br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MMU Talent Showcase</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/styles.css"> </head> </head>
<body>
    <div class="auth-container">
        <div class="auth-image-section">
            <div class="auth-image-placeholder">
                MMU Talent Portal
            </div>
        </div>
        <div class="auth-form-section">
            <div class="website-name"></div> <h1>Register</h1>
            <?php
            // Display errors if any
            if (!empty($errors)) {
                echo '<div class="error-message-box">';
                foreach ($errors as $error) {
                    echo '<p class="error-message">' . htmlspecialchars($error) . '</p>';
                }
                echo '</div>';
            }
            ?>
            <!-- route eeverything back to index.php?page=register with a POST request containing this form details-->
            <form action="<?= BASE_URL ?>index.php?page=register" method="POST" id="registerForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn-submit">Register</button>
            </form>
            <a href="login.php" class="form-link">Already have an account? Login</a>
        </div>
    </div>
    <script src="/js/script.js"></script> </body>
</html>