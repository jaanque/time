<?php
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Inicializar variables
$code = isset($_GET['code']) ? strtoupper(sanitizeInput($_GET['code'])) : null;
$message = null;
$attachments = [];
$passwordRequired = false;
$passwordIncorrect = false;
$messageNotFound = false;

// Verificar si se proporcionó un código
if ($code) {
    $db = new Database();
    
    // Verificar si el mensaje existe
    $message = $db->getMessageByCode($code);
    
    if (!$message) {
        $messageNotFound = true;
    } else {
        // Comprobar si requiere contraseña
        if ($message['password'] !== null) {
            $passwordRequired = true;
            
            // Si se envió la contraseña, verificarla
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
                if (verifyPassword($message, $_POST['password'])) {
                    // Contraseña correcta, mostrar mensaje
                    $passwordRequired = false;
                    
                    // Obtener archivos adjuntos
                    $attachments = $db->getAttachments($code);
                    
                    // Marcar como visto (solo se eliminará en la próxima visita)
                    $db->markMessageAsViewed($code);
                } else {
                    $passwordIncorrect = true;
                }
            }
        } else {
            // No requiere contraseña, obtener archivos adjuntos
            $attachments = $db->getAttachments($code);
            
            // Marcar como visto (solo se eliminará en la próxima visita)
            $db->markMessageAsViewed($code);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver mensaje - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/favicon.ico">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <a href="index.php">
                    <img src="assets/img/logo.svg" alt="<?php echo SITE_NAME; ?> Logo">
                    <h1><?php echo SITE_NAME; ?></h1>
                </a>
            </div>
        </header>
        
        <main>
            <?php if (empty($code)): ?>
                <!-- Formulario para ingresar código -->
                <div class="form-container">
                    <h2>Leer un mensaje</h2>
                    <p>Ingresa el código de 9 dígitos del mensaje que deseas leer.</p>
                    
                    <form action="view.php" method="get" class="search-form">
                        <input type="text" name="code" placeholder="Código de 9 dígitos" 
                               pattern="[A-Z0-9]{9}" maxlength="9" required>
                        <button type="submit" class="button">Acceder al mensaje</button>
                    </form>
                </div>
            <?php elseif ($messageNotFound): ?>
                <!-- Mensaje no encontrado -->
                <div class="message-container not-found">
                    <h2>Mensaje no encontrado</h2>
                    <p>El mensaje que buscas no existe o ya ha sido leído.</p>
                    <div class="action-buttons">
                        <a href="index.php" class="button">Volver al inicio</a>
                    </div>
                </div>
            <?php elseif ($passwordRequired): ?>
                <!-- Solicitar contraseña -->
                <div class="form-container">
                    <h2>Mensaje protegido</h2>
                    <p>Este mensaje está protegido con contraseña.</p>
                    
                    <?php if ($passwordIncorrect): ?>
                        <div class="error-message">Contraseña incorrecta. Inténtalo de nuevo.</div>
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
                <!-- Mostrar mensaje -->
                <div class="message-container">
                    <div class="warning-banner">
                        <p><strong>¡Atención!</strong> Este mensaje se eliminará una vez que salgas de esta página.</p>
                    </div>
                    
                    <div class="message-content">
                        <h2>Mensaje:</h2>
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
                        <p class="created-at">Creado el: <?php echo date('d/m/Y H:i', strtotime($message['created_at'])); ?></p>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="index.php" class="button">Volver al inicio</a>
                    </div>
                </div>
            <?php endif; ?>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> - Mensajes privados y temporales</p>
        </footer>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>