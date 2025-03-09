<?php
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Verificar parámetros
if (!isset($_GET['id']) || !isset($_GET['code'])) {
    header('HTTP/1.0 400 Bad Request');
    exit('Solicitud inválida');
}

$attachmentId = (int)$_GET['id'];
$code = sanitizeInput($_GET['code']);

// Obtener información del mensaje
$db = new Database();
$message = $db->getMessageByCode($code);

if (!$message) {
    header('HTTP/1.0 404 Not Found');
    exit('El mensaje no existe o ya ha sido leído');
}

// Obtener información del archivo
$attachments = $db->getAttachments($code);
$attachment = null;

foreach ($attachments as $att) {
    if ((int)$att['id'] === $attachmentId) {
        $attachment = $att;
        break;
    }
}

if (!$attachment) {
    header('HTTP/1.0 404 Not Found');
    exit('Archivo no encontrado');
}

// Ruta completa al archivo
$filePath = UPLOAD_DIR . $attachment['file_path'];

// Verificar que el archivo exista
if (!file_exists($filePath)) {
    header('HTTP/1.0 404 Not Found');
    exit('Archivo no encontrado');
}

// Establecer encabezados para la descarga
header('Content-Description: File Transfer');
header('Content-Type: ' . $attachment['file_type']);
header('Content-Disposition: attachment; filename="' . $attachment['filename'] . '"');
header('Content-Length: ' . $attachment['file_size']);
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Enviar archivo
readfile($filePath);
exit;
?>