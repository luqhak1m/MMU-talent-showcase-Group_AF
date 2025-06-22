<?php
?>

<div class="container-div" style="padding-top: 2em; height: auto; min-height: 100vh;">
    <h1 class="page-title" id="feedback-header-div">Feedback Management</h1>
    
    <table border="1" style="width:90%; margin: 2em auto; border-collapse: collapse; background-color: #fff;">
        <thead>
            <tr style="background-color: #E7E6F2;">
                <th style="padding: 8px;">User</th>
                <th style="padding: 8px;">Content</th>
                <th style="padding: 8px;">Status</th>
                <th style="padding: 8px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($feedbacks)): ?>
                <?php foreach ($feedbacks as $feedback): ?>
                    <tr>
                        <td style="padding: 8px;">
                            <?php if (!empty($feedback['ProfilePicture'])): ?>
                                <img src="<?= BASE_URL ?>uploads/<?php echo htmlspecialchars($feedback['ProfilePicture']); ?>" alt="PFP" style="width: 30px; height: 30px; border-radius: 50%; vertical-align: middle; margin-right: 5px;">
                            <?php else: ?>
                                <img src="<?= BASE_URL ?>images/profile.png" alt="Default PFP" style="width: 30px; height: 30px; border-radius: 50%; vertical-align: middle; margin-right: 5px;">
                            <?php endif; ?>
                            @<?php echo htmlspecialchars($feedback['Username'] ?? 'N/A'); ?>
                        </td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($feedback['Feedback'] ?? ''); ?></td>
                        <td style="padding: 8px;">
                            <form class="status-form" method="POST" action="<?= BASE_URL ?>index.php?page=admin_manage_feedback&id=<?php echo htmlspecialchars($feedback['FeedbackID'] ?? ''); ?>&action=update">
                                <label for="status-<?php echo htmlspecialchars($feedback['FeedbackID'] ?? ''); ?>" style="display: none;">Status for <?php echo htmlspecialchars($feedback['FeedbackID'] ?? ''); ?>:</label>
                                <select name="feedback_status" id="status-<?php echo htmlspecialchars($feedback['FeedbackID'] ?? ''); ?>" onchange="this.form.submit()">
                                    <option value="Pending" <?php echo ($feedback['FeedbackStatus'] === 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="InProgress" <?php echo ($feedback['FeedbackStatus'] === 'InProgress' ? 'selected' : ''); ?>>In Progress</option>
                                    <option value="Resolved" <?php echo ($feedback['FeedbackStatus'] === 'Resolved' ? 'selected' : ''); ?>>Resolved</option>
                                </select>
                            </form>
                        </td>
                        <td style="padding: 8px;">
                            <a href="<?= BASE_URL ?>index.php?page=admin_manage_feedback&id=<?php echo htmlspecialchars($feedback['FeedbackID'] ?? ''); ?>&action=delete" class="button" id="list-button" onclick="return confirm('Are you sure you want to delete this feedback?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 8px;">No feedback found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div style="text-align: center; margin-top: 20px;">
        <a href="index.php?page=admin_dashboard" class="button">Back to Dashboard</a>
    </div>
</div>