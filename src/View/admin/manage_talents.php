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
        <h1>Manage Talents</h1>
        <p>Here you can view and delete talent submissions from all users.</p>
        
        <table border="1" style="width:90%; margin: 2em auto; border-collapse: collapse; background-color: #fff;">
            <thead>
                <tr style="background-color: #E7E6F2;">
                    <th style="padding: 8px;">Talent Title</th>
                    <th style="padding: 8px;">Creator</th>
                    <th style="padding: 8px;">Category</th>
                    <th style="padding: 8px;">Price</th>
                    <th style="padding: 8px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($talents)): ?>
                    <?php foreach ($talents as $talent): ?>
                    <tr>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($talent['TalentTitle']); ?></td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($talent['Username']); ?></td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($talent['Category']); ?></td>
                        <td style="padding: 8px;">RM <?php echo htmlspecialchars($talent['Price']); ?></td>
                        <td style="padding: 8px; text-align: center;">
                            <a href="index.php?page=talent&id=<?php echo $talent['TalentID']; ?>" target="_blank">View</a> | 
                            <a href="index.php?page=admin_delete_talent&talent_id=<?php echo $talent['TalentID']; ?>" onclick="return confirm('Are you sure you want to delete this talent?');" style="color: red;">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="padding: 8px; text-align: center;">No talents found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php?page=admin_dashboard" class="button">Back to Dashboard</a>
    </div>

</body>
</html>
<?php require_once __DIR__ . '/../../../public/footer.php'; ?>