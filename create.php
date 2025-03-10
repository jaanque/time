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
                <!-- Formulario mejorado para introducir el código -->
                <div class="form-container">
                    <div class="code-input-container">
                        <svg class="code-input-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 11H5C3.89543 11 3 11.8954 3 13V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V13C21 11.8954 20.1046 11 19 11Z" fill="#3561ff" opacity="0.2"/>
                            <path d="M19 11H5C3.89543 11 3 11.8954 3 13V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V13C21 11.8954 20.1046 11 19 11Z" stroke="#3561ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7 11V7C7 5.93913 7.42143 4.92172 8.17157 4.17157C8.92172 3.42143 9.93913 3 11 3C12.0609 3 13.0783 3.42143 13.8284 4.17157C14.5786 4.92172 15 5.93913 15 7V11" stroke="#3561ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 16C12.5523 16 13 15.5523 13 15C13 14.4477 12.5523 14 12 14C11.4477 14 11 14.4477 11 15C11 15.5523 11.4477 16 12 16Z" fill="#3561ff"/>
                        </svg>
                        
                        <h2 class="code-input-title">Accede a tu mensaje secreto</h2>
                        <p class="code-input-description">Introduce el código de 9 dígitos para ver el mensaje. El mensaje se destruirá después de ser leído.</p>
                        
                        <form action="view.php" method="get" class="code-input-form" id="codeForm">
                            <div class="code-segments">
                                <input type="text" class="code-segment" maxlength="3" id="segment1" placeholder="XXX" autocomplete="off">
                                <input type="text" class="code-segment" maxlength="3" id="segment2" placeholder="XXX" autocomplete="off">
                                <input type="text" class="code-segment" maxlength="3" id="segment3" placeholder="XXX" autocomplete="off">
                            </div>
                            <input type="hidden" name="code" id="fullCode">
                            
                            <button type="submit" class="code-input-button">Acceder al mensaje</button>
                        </form>
                    </div>
                </div>

                <!-- Script para manejar la entrada del código -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const segment1 = document.getElementById('segment1');
                        const segment2 = document.getElementById('segment2');
                        const segment3 = document.getElementById('segment3');
                        const fullCodeInput = document.getElementById('fullCode');
                        const form = document.getElementById('codeForm');
                        
                        // Auto focus first segment
                        segment1.focus();
                        
                        // Automatically move to next segment when filled
                        segment1.addEventListener('input', function() {
                            if (this.value.length === 3) {
                                segment2.focus();
                            }
                        });
                        
                        segment2.addEventListener('input', function() {
                            if (this.value.length === 3) {
                                segment3.focus();
                            }
                        });
                        
                        // Handle backspace to go back to previous segment
                        segment2.addEventListener('keydown', function(e) {
                            if (e.key === 'Backspace' && this.value.length === 0) {
                                segment1.focus();
                            }
                        });
                        
                        segment3.addEventListener('keydown', function(e) {
                            if (e.key === 'Backspace' && this.value.length === 0) {
                                segment2.focus();
                            }
                        });
                        
                        // Combine segments into full code on form submit
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            const fullCode = segment1.value + segment2.value + segment3.value;
                            
                            // Validate code length
                            if (fullCode.length !== 9) {
                                alert('Por favor introduce un código de 9 dígitos');
                                return;
                            }
                            
                            fullCodeInput.value = fullCode;
                            this.submit();
                        });
                    });
                </script>
            <?php elseif ($messageNotFound): ?>
                <!-- Message not found -->
                <div class="message-container not-found">
                    <h2>Mensaje no encontrado</h2>
                    <p>El mensaje que buscas no existe o ya ha sido leído.</p>
                    <div class="action-buttons">
                        <a href="index.php" class="button">Volver al inicio</a>
                        <a href="view.php" class="button secondary">Probar otro código</a>
                    </div>
                </div>
            <?php elseif ($passwordRequired): ?>
                <!-- Request password -->
                <div class="form-container">
                    <h2>Mensaje protegido con contraseña</h2>
                    <p>Este mensaje está protegido con una contraseña.</p>
                    
                    <?php if ($passwordIncorrect): ?>
                        <div class="error-message">Contraseña incorrecta. Por favor, inténtalo de nuevo.</div>
                    <?php endif; ?>
                    
                    <form method="post" action="view.php?code=<?php echo $code; ?>">
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" id="password" name="password" required autofocus>
                        </div>
                        
                        <div class="form-actions">
                            <a href="index.php" class="button secondary">Cancelar</a>
                            <button type="submit" class="button">Acceder al mensaje</button>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <!-- Show message -->
                <div class="message-container">
                    <div class="warning-banner">
                        <p><strong>¡Advertencia!</strong> Este mensaje será eliminado permanentemente después de que abandones esta página.</p>
                    </div>
                    
                    <div class="message-content">
                        <h2>Contenido del mensaje:</h2>
                        <div class="content">
                            <?php echo nl2br(htmlspecialchars($message['content'])); ?>
                        </div>
                        
                        <?php if (!empty($attachments)): ?>
                            <div class="attachments">
                                <h3>Archivos adjuntos:</h3>
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
                        <p class="created-at">Creado el: <?php echo date('j F, Y, g:i a', strtotime($message['created_at'])); ?></p>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="index.php" class="button">Volver al inicio</a>
                        <a href="create.php" class="button secondary">Crear nuevo mensaje</a>
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