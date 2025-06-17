<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="/talent-portal/public/css/styles.css"> </head>
<body>
    <div class="auth-container">
        <div class="auth-form-section">
            <h1>Admin Login</h1>
            <?php if (isset($login_error)): ?>
                <p style="color:red; text-align:center;"><?php echo htmlspecialchars($login_error); ?></p>
            <?php endif; ?>
            
            <form action="/talent-portal/public/index.php?page=admin_login" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>