<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Limpiar mensajes expirados
cleanupExpiredMessages();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Mensajes privados y temporales</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/favicon.ico">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="assets/img/logo.svg" alt="<?php echo SITE_NAME; ?> Logo">
                <h1><?php echo SITE_NAME; ?></h1>
            </div>
            <p class="tagline">Mensajes seguros que desaparecen después de ser leídos</p>
        </header>
        
        <main>
            <div class="card-container">
                <div class="card">
                    <h2>Crear un mensaje</h2>
                    <p>Crea un mensaje que se autodestruirá después de ser leído</p>
                    <a href="create.php" class="button">Crear mensaje</a>
                </div>
                
                <div class="card">
                    <h2>Leer un mensaje</h2>
                    <p>Lee un mensaje usando el código que has recibido</p>
                    <form action="view.php" method="get" class="search-form">
                        <input type="text" name="code" placeholder="Ingresa el código de 9 dígitos" 
                               pattern="[A-Z0-9]{9}" maxlength="9" required>
                        <button type="submit" class="button">Leer mensaje</button>
                    </form>
                </div>
            </div>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> - Mensajes privados y temporales</p>
        </footer>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>