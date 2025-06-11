<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MMU Talent Showcase</title>
    <link rel="stylesheet" href="/css/auth_style.css"> </head>
<body>
    <div class="auth-container">
        <div class="auth-image-section">
            <div class="auth-image-placeholder">
                MMU Talent Portal
            </div>
        </div>
        <div class="auth-form-section">
            <div class="website-name"></div> <h1>User Login</h1>
            <?php
            if (isset($_GET['registration']) && $_GET['registration'] === 'success') {
                echo '<p style="color: green; text-align: center;">Registration successful! Please login.</p>';
            }
            if (!empty($login_error)) {
                echo '<p class="error-message" style="text-align:center;">' . htmlspecialchars($login_error) . '</p>';
            }
            ?>
            <form action="/talent-portal/public/index.php?page=login" method="POST">
                <div class="form-group">
                    <label for="email">Email</label> <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-submit">Login</button>
            </form>
            <a href="register.php" class="form-link">Don't have an account? Register</a>
            </div>
    </div>
</body>
</html>