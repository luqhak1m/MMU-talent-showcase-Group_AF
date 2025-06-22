<div class="container-div" style="padding-top: 2em;">
    <h1 style="text-align: center" class="page-title">Catalogue Management</h1> 

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="success-message"><?= htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?></div>
    <?php endif; ?>

    <table border="1" style="width: 90%; margin: 2em auto; border-collapse: collapse; background: #fff;">
        <thead>
            <tr style="background-color: #E7E6F2;">
                <th style="padding: 8px;">Media</th>
                <th style="padding: 8px;">Title</th>
                <th style="padding: 8px;">Price</th>
                <th style="padding: 8px;">Category</th>
                <th style="padding: 8px;">Description</th>
                <th style="padding: 8px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($catalogueItems)): ?>
            <?php foreach ($catalogueItems as $item): ?>
                <tr>
                    <!-- Media (image or audio icon) -->
                    <td style="padding: 8px; text-align: center;">
                        <?php 
                            $filename = $item['Content'];
                            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                            $audio_extensions = ['mp3', 'wav', 'ogg', 'aac', 'flac'];

                            if (in_array($extension, $audio_extensions)) {
                                echo '<img src="images/audio_icon.png" alt="Audio" style="width: 50px;">';
                            } else {
                                echo '<img src="uploads/' . htmlspecialchars($filename) . '" alt="Media" style="width: 80px; height: auto;">';
                            }
                        ?>
                    </td>

                    <!-- Talent Title -->
                    <td style="padding: 8px;"><?php echo htmlspecialchars($item['TalentTitle'] ?? ''); ?></td>

                    <!-- Category -->
                    <td style="padding: 8px;"><?php echo htmlspecialchars($item['Category'] ?? ''); ?></td>

                    <!-- Price -->
                    <td style="padding: 8px;">RM <?php echo htmlspecialchars($item['Price'] ?? ''); ?></td>

                    <!-- Actions -->
                    <td style="padding: 8px;">
                        <a href="index.php?page=admin_manage_catalogue&action=edit&id=<?php echo htmlspecialchars($item['TalentID']); ?>" class="button" id="list-button">Edit</a>
                        <a href="index.php?page=admin_manage_catalogue&action=delete&id=<?php echo htmlspecialchars($item['TalentID']); ?>" class="button" id="list-button" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center; padding: 8px;">No catalogue items found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
    </table>
</div>
