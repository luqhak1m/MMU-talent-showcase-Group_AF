<?php

?>

<div class="container-div" style="padding-top: 2em; height: auto; min-height: 100vh;">
    <h1 class="page-title">Announcement Management</h1> <div style="text-align: right; margin-bottom: 1em;">
        <a href="<?= BASE_URL ?>index.php?page=admin_manage_announcement&action=create" class="button plus-button">+</a>
    </div>
    
    <table border="1" style="width:90%; margin: 2em auto; border-collapse: collapse; background-color: #fff;">
        <thead>
            <tr style="background-color: #E7E6F2;">
                <th style="padding: 8px;">Title</th>
                <th style="padding: 8px;">Content</th>
                <th style="padding: 8px;">Date Published</th>
                <th style="padding: 8px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($announcements)): ?>
                <?php foreach ($announcements as $announcement): ?>
                    <tr>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($announcement['AnnouncementTitle'] ?? ''); ?></td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($announcement['Announcement'] ?? ''); ?></td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($announcement['AnnouncementTimestamp'] ?? ''); ?></td>
                        <td style="padding: 8px;">
                            <a href="<?= BASE_URL ?>index.php?page=admin_manage_announcement&id=<?php echo htmlspecialchars($announcement['AnnouncementID'] ?? ''); ?>&action=edit" class="button" id="list-button">Edit</a>
                            <a href="<?= BASE_URL ?>index.php?page=admin_manage_announcement&id=<?php echo htmlspecialchars($announcement['AnnouncementID'] ?? ''); ?>&action=delete" class="button" id="list-button">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 8px;">No announcements found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>