<?php
require_once 'config.php';
require_once 'db.php';

// Generar código único para el mensaje
function generateUniqueId($length = MESSAGE_ID_LENGTH) {
    $db = new Database();
    $conn = $db->getConnection();
    
    do {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $id = '';
        for ($i = 0; $i < $length; $i++) {
            $id .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        // Verificar que el ID no exista
        $stmt = $conn->prepare("SELECT COUNT(*) FROM messages WHERE message_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $exists = (int)$stmt->fetchColumn() > 0;
    } while ($exists);
    
    return $id;
}

// Validar extensión de archivo
function isValidFileExtension($filename) {
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($extension, ALLOWED_EXTENSIONS);
}

// Formatear tamaño de archivo
function formatFileSize($bytes) {
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = 0;
    while ($bytes >= 1024 && $i < count($units) - 1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 2) . ' ' . $units[$i];
}

// Sanear entrada de texto
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Obtener tipo MIME seguro
function getSecureMimeType($filePath) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $filePath);
    finfo_close($finfo);
    return $mimeType;
}

// Verificar contraseña
function verifyPassword($messageData, $password) {
    if ($messageData['password'] === null) {
        return true; // No password required
    }
    
    return password_verify($password, $messageData['password']);
}

// Limpiar caducados
function cleanupExpiredMessages() {
    $db = new Database();
    $db->deleteExpiredMessages();
}
?>