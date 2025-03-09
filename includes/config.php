<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'time');

// Configuración de la aplicación
define('SITE_NAME', 'TempMessage');
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'txt', 'zip']);
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('MESSAGE_ID_LENGTH', 9);
?>