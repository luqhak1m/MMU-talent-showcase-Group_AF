<?php require_once __DIR__ . '/../../../public/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/home.css">
</head>
<body class="index-body">
    
    <div class="container-div" id="home-container-div">
        <h1>Admin Dashboard</h1>
        
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</p>
        
        <h2>All Users</h2>
        <table border="1" style="width:100%; border-collapse: collapse; background-color: #fff;">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['Username']); ?></td>
                        <td><?php echo htmlspecialchars($user['Email']); ?></td>
                        <td><?php echo htmlspecialchars($user['Role']); ?></td>
                        <td>
                            <a href="/talent-portal/public/index.php?page=admin_view_profile&user_id=<?php echo $user['UserID']; ?>">View</a> | 
                            <a href="/talent-portal/public/index.php?page=admin_edit_profile&user_id=<?php echo $user['UserID']; ?>">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
<?php require_once __DIR__ . '/../../../public/footer.php'; ?>