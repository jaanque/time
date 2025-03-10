<?php
require_once 'config.php';

class Database {
    private $conn;
    
    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function getMessageByCode($code) {
        $stmt = $this->conn->prepare("SELECT * FROM messages WHERE message_id = :code AND viewed = 0");
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getAttachments($code) {
        $stmt = $this->conn->prepare("SELECT * FROM attachments WHERE message_id = :code");
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function createMessage($messageId, $content, $password = null) {
        $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
        
        $stmt = $this->conn->prepare("
            INSERT INTO messages (message_id, content, password) 
            VALUES (:message_id, :content, :password)
        ");
        
        $stmt->bindParam(':message_id', $messageId);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':password', $hashedPassword);
        
        return $stmt->execute();
    }
    
    public function addAttachment($messageId, $filename, $filePath, $fileSize, $fileType) {
        $stmt = $this->conn->prepare("
            INSERT INTO attachments (message_id, filename, file_path, file_size, file_type) 
            VALUES (:message_id, :filename, :file_path, :file_size, :file_type)
        ");
        
        $stmt->bindParam(':message_id', $messageId);
        $stmt->bindParam(':filename', $filename);
        $stmt->bindParam(':file_path', $filePath);
        $stmt->bindParam(':file_size', $fileSize);
        $stmt->bindParam(':file_type', $fileType);
        
        return $stmt->execute();
    }
    
    public function markMessageAsViewed($messageId) {
        $stmt = $this->conn->prepare("UPDATE messages SET viewed = 1 WHERE message_id = :message_id");
        $stmt->bindParam(':message_id', $messageId);
        
        return $stmt->execute();
    }
    
    public function deleteExpiredMessages() {
        // Eliminar mensajes que ya han sido vistos o que han expirado
        $stmt = $this->conn->prepare("DELETE FROM messages WHERE viewed = 1 OR (expires_at IS NOT NULL AND expires_at < NOW())");
        return $stmt->execute();
    }
}
?>