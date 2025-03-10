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
    <title><?php echo SITE_NAME; ?> - La plataforma de trabajo que unifica equipos</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Header/Navigation -->
        <header class="site-header">
            <div class="nav-container">
                <div class="logo">
                    <a href="index.php"><img src="assets/img/logo.png" alt="<?php echo SITE_NAME; ?> Logo">Nam3.es</a>
                </div>
                <nav class="main-nav">
                    <ul>
                        <li class="dropdown">
                            <a href="#como-funciona">xxx <span class="dropdown-arrow">▼</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="#">xxx <span class="dropdown-arrow">▼</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="#">xxx <span class="dropdown-arrow">▼</span></a>
                        </li>
                        <li><a href="#">xxx</a></li>
                    </ul>
                </nav>
                <div class="nav-actions">
                    <a href="view.php" class="btn btn-secondary"> Leer un mensaje <span class="btn-icon">📚</span></a>
                    <a href="create.php" class="btn btn-primary"> Crear mensaje <span class="btn-icon">✨</span></a>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Mensajería 💬 <br>Temporal y Segura</h1>
                    <p class="hero-description">En <?php echo SITE_NAME; ?> ofrecemos mensajería sin registros ni datos personales. Nuestros mensajes se autodestruyen al ser leídos, garantizando privacidad total. La manera más discreta y confiable de comunicarte.</p>
                    <div class="hero-actions">
                        <a href="create.php" class="btn btn-primary"> Crear mensaje <span class="btn-icon">✨</span></a>
                        <a href="view.php" class="btn btn-secondary"> Leer un mensaje <span class="btn-icon">📚</span></a>
                    </div>
                </div>
                <div class="hero-image">
                    <img draggable="false" src="assets/img/diseño.png" alt="backend image preview">
                </div>
            </div>
        </section>

        <!-- Solutions Grid -->
         <div id="#como-funciona">
        <section class="solutions-grid">
            <h1 class="h1">¿Cómo Funciona?</h1>
            <br><br>
            <div class="grid-container">
                <div class="solution-card">
                    <div class="solution-icon product-icon"></div>
                    <h3>Crea un mensaje</h3>
                    <p>Escribe tu mensaje sin necesidad de registrarte.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon agency-icon"></div>
                    <h3>Envía el mensaje</h3>
                    <p>Comparte el código generado con quien desees, de forma segura.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon software-icon"></div>
                    <h3>El destinatario lo lee</h3>
                    <p>El mensaje se muestra solo una vez que se abre.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon startup-icon"></div>
                    <h3>Desaparece sin rastro</h3>
                    <p>El mensaje se elimina automáticamente después de ser leído.</p>
                </div>
            </div>
        </section>
        </div>

        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-content">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> - Todos los derechos reservados</p>
            </div>
        </footer>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>