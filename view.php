<?php
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Initialize variables
$code = isset($_GET['code']) ? strtoupper(sanitizeInput($_GET['code'])) : null;
$message = null;
$attachments = [];
$passwordRequired = false;
$passwordIncorrect = false;
$messageNotFound = false;

// Check if a code was provided
if ($code) {
    $db = new Database();
    
    // Check if message exists
    $message = $db->getMessageByCode($code);
    
    if (!$message) {
        $messageNotFound = true;
    } else {
        // Check if password is required
        if ($message['password'] !== null) {
            $passwordRequired = true;
            
            // If password was submitted, verify it
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
                if (verifyPassword($message, $_POST['password'])) {
                    // Password correct, show message
                    $passwordRequired = false;
                    
                    // Get attachments
                    $attachments = $db->getAttachments($code);
                    
                    // Mark as viewed (will be deleted on next visit)
                    $db->markMessageAsViewed($code);
                } else {
                    $passwordIncorrect = true;
                }
            }
        } else {
            // No password required, get attachments
            $attachments = $db->getAttachments($code);
            
            // Mark as viewed (will be deleted on next visit)
            $db->markMessageAsViewed($code);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/view.css">
    <link rel="icon" href="assets/img/favicon.ico">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <a href="index.php">
                    <img src="assets/img/logo.png" alt="<?php echo SITE_NAME; ?> Logo">
                    <h1><?php echo SITE_NAME; ?></h1>
                </a>
            </div>
            <p class="tagline">Secure, temporary messages that self-destruct after reading</p>
        </header>
        
        <main>
            <?php if (empty($code)): ?>
                <!-- Form to enter code -->
                <div class="form-container">
                    <h2>Read a Message</h2>
                    <p>Enter the 9-digit code of the message you want to read.</p>
                    
                    <form action="view.php" method="get" class="search-form">
                        <div class="form-group">
                            <input type="text" name="code" placeholder="9-digit code" 
                                   pattern="[A-Za-z0-9]{9}" maxlength="9" required autofocus>
                        </div>
                        <button type="submit" class="button">Access Message</button>
                    </form>
                </div>
            <?php elseif ($messageNotFound): ?>
                <!-- Message not found -->
                <div class="message-container not-found">
                    <h2>Message Not Found</h2>
                    <p>The message you're looking for doesn't exist or has already been read.</p>
                    <div class="action-buttons">
                        <a href="index.php" class="button">Back to Home</a>
                        <a href="view.php" class="button secondary">Try Another Code</a>
                    </div>
                </div>
            <?php elseif ($passwordRequired): ?>
                <!-- Request password -->
                <div class="form-container">
                    <h2>Password Protected Message</h2>
                    <p>This message is protected with a password.</p>
                    
                    <?php if ($passwordIncorrect): ?>
                        <div class="error-message">Incorrect password. Please try again.</div>
                    <?php endif; ?>
                    
                    <form method="post" action="view.php?code=<?php echo $code; ?>">
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required autofocus>
                        </div>
                        
                        <div class="form-actions">
                            <a href="index.php" class="button secondary">Cancel</a>
                            <button type="submit" class="button">Access Message</button>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <!-- Show message -->
                <div class="message-container">
                    <div class="warning-banner">
                        <p><strong>Warning!</strong> This message will be permanently deleted after you leave this page.</p>
                    </div>
                    
                    <div class="message-content">
                        <h2>Message Content:</h2>
                        <div class="content">
                            <?php echo nl2br(htmlspecialchars($message['content'])); ?>
                        </div>
                        
                        <?php if (!empty($attachments)): ?>
                            <div class="attachments">
                                <h3>Attachments:</h3>
                                <ul class="attachment-list">
                                    <?php foreach ($attachments as $attachment): ?>
                                        <li>
                                            <a href="download.php?id=<?php echo $attachment['id']; ?>&code=<?php echo $code; ?>" 
                                               class="attachment-link" target="_blank">
                                                <?php echo htmlspecialchars($attachment['filename']); ?>
                                                <span class="file-size">(<?php echo formatFileSize($attachment['file_size']); ?>)</span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="message-meta">
                        <p class="created-at">Created on: <?php echo date('F j, Y, g:i a', strtotime($message['created_at'])); ?></p>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="index.php" class="button">Back to Home</a>
                        <a href="create.php" class="button secondary">Create New Message</a>
                    </div>
                </div>
            <?php endif; ?>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> - Secure Temporary Messages</p>
        </footer>
    </div>
</body>
</html>