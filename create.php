<?php
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

$messageSaved = false;
$messageId = null;
$error = null;

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database();
        
        // Validar entrada
        if (empty($_POST['content'])) {
            throw new Exception("El mensaje no puede estar vacío");
        }
        
        $content = sanitizeInput($_POST['content']);
        $password = !empty($_POST['password']) ? $_POST['password'] : null;
        
        // Generar ID único
        $messageId = generateUniqueId();
        
        // Guardar mensaje en la base de datos
        if (!$db->createMessage($messageId, $content, $password)) {
            throw new Exception("Error al guardar el mensaje");
        }
        
        // Procesar archivos adjuntos si existen
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['attachment'];
            
            // Validar archivo
            if ($file['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Error al subir el archivo");
            }
            
            if ($file['size'] > MAX_FILE_SIZE) {
                throw new Exception("El archivo excede el tamaño máximo permitido (" . formatFileSize(MAX_FILE_SIZE) . ")");
            }
            
            if (!isValidFileExtension($file['name'])) {
                throw new Exception("Tipo de archivo no permitido");
            }
            
            // Generar nombre único para el archivo
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $newFilename = uniqid() . '.' . $fileExtension;
            $uploadPath = UPLOAD_DIR . $newFilename;
            
            // Mover archivo a directorio de uploads
            if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                throw new Exception("Error al guardar el archivo");
            }
            
            // Registrar archivo en la base de datos
            $db->addAttachment(
                $messageId,
                $file['name'],
                $newFilename,
                $file['size'],
                getSecureMimeType($uploadPath)
            );
        }
        
        $messageSaved = true;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear mensaje - <?php echo SITE_NAME; ?></title>
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
            <?php if ($messageSaved && $messageId): ?>
                <div class="success-container">
                    <h2>¡Mensaje creado con éxito!</h2>
                    <p>Tu mensaje ha sido guardado y estará disponible hasta que alguien lo lea.</p>
                    
                    <div class="code-container">
                        <h3>Tu código es:</h3>
                        <div class="message-code"><?php echo $messageId; ?></div>
                        <button class="button" id="copyCode" data-code="<?php echo $messageId; ?>">Copiar código</button>
                    </div>
                    
                    <p class="message-url">
                        Enlace directo: 
                        <a href="<?php echo "view.php?code=" . $messageId; ?>" target="_blank">
                            <?php echo $_SERVER['HTTP_HOST'] . "/view.php?code=" . $messageId; ?>
                        </a>
                    </p>
                    
                    <div class="action-buttons">
                        <a href="index.php" class="button">Volver al inicio</a>
                        <a href="create.php" class="button secondary">Crear otro mensaje</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="form-container">
                    <h2>Crear nuevo mensaje</h2>
                    <p>El mensaje se eliminará automáticamente después de ser leído.</p>
                    
                    <?php if ($error): ?>
                        <div class="error-message"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="content">Mensaje:</label>
                            <textarea id="content" name="content" rows="6" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Contraseña (opcional):</label>
                            <input type="password" id="password" name="password" 
                                   placeholder="Deja en blanco para no usar contraseña">
                            <small class="form-help">Si añades una contraseña, será requerida para leer el mensaje</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="attachment">Archivo adjunto (opcional):</label>
                            <input type="file" id="attachment" name="attachment">
                            <small class="form-help">
                                Tamaño máximo: <?php echo formatFileSize(MAX_FILE_SIZE); ?><br>
                                Formatos permitidos: <?php echo implode(', ', ALLOWED_EXTENSIONS); ?>
                            </small>
                        </div>
                        
                        <div class="form-actions">
                            <a href="index.php" class="button secondary">Cancelar</a>
                            <button type="submit" class="button">Crear mensaje</button>
                        </div>
                    </form>
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