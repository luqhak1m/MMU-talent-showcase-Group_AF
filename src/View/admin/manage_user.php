<?php require_once __DIR__ . '/../../../public/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Talents</title>
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/styles.css">
</head>
<body class="index-body">
    
    <div class="container-div" style="padding-top: 2em; height: auto; min-height: 100vh;">
        <h1>Manage User</h1>
        
        <table border="1" style="width:90%; margin: 2em auto; border-collapse: collapse; background-color: #fff;">
            <thead>
                <tr style="background-color: #E7E6F2;">
                    <th style="padding: 8px;">Username</th>
                    <th style="padding: 8px;">Email</th>
                    <th style="padding: 8px;">Action</th>
                </tr>
            </thead>
            <!--Author:Sabrina-->
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['Username']); ?></td>
                            <td><?php echo htmlspecialchars($user['Email']); ?></td>
                            <td>
                                <a href="talent-portal/public/index.php?page=admin_view_profile&user_id=<?php echo $user['UserID']; ?>" class="button" id="list-button">View</a>
                                <a href="talent-portal/public/index.php?page=admin_manage_user&action=delete&user_id=<?= $user['UserID']; ?>" class="button" id="list-button" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="talent-portal/public/index.php?page=admin_dashboard" class="button">Back to Dashboard</a>
    </div>

</body>
</html>
<?php require_once __DIR__ . '/../../../public/footer.php'; ?>
