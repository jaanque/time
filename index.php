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
                    <a href="index.php"><img src="assets/img/logo.svg" alt="<?php echo SITE_NAME; ?> Logo"></a>
                </div>
                <nav class="main-nav">
                    <ul>
                        <li class="dropdown">
                            <a href="#">Soluciones <span class="dropdown-arrow">▼</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="#">Plataforma <span class="dropdown-arrow">▼</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="#">Recursos <span class="dropdown-arrow">▼</span></a>
                        </li>
                        <li><a href="#">Precios</a></li>
                        <li><a href="#" class="more-menu">•••</a></li>
                    </ul>
                </nav>
                <div class="nav-actions">
                    <a href="#" class="btn btn-secondary">Programar una demo</a>
                    <a href="#" class="btn btn-text">Iniciar sesión</a>
                    <a href="#" class="btn btn-primary">Comenzar</a>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>El sistema operativo<br>de tu empresa</h1>
                    <p class="hero-description"><?php echo SITE_NAME; ?> es una plataforma de trabajo que reemplaza herramientas dispersas y conecta equipos. Elegida por expertos, apreciada por todos.*</p>
                    <div class="hero-actions">
                        <a href="create.php" class="btn btn-primary">Comenzar gratis <span class="btn-icon">✨</span></a>
                        <a href="#" class="btn btn-secondary">Programar una demo</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="assets/img/dashboard-preview.png" alt="Dashboard Preview">
                </div>
            </div>
        </section>

        <!-- Solutions Grid -->
        <section class="solutions-grid">
            <div class="grid-container">
                <div class="solution-card">
                    <div class="solution-icon product-icon"></div>
                    <h3>Producto</h3>
                    <p>Crea un flujo ininterrumpido desde la identificación de necesidades hasta la entrega.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon agency-icon"></div>
                    <h3>Agencia digital</h3>
                    <p>Colabora con clientes, gestiona proyectos y entrega resultados excepcionales.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon software-icon"></div>
                    <h3>Desarrollo de software</h3>
                    <p>Ejecuta sprints de la manera que prefieras con flexibilidad y visibilidad.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon startup-icon"></div>
                    <h3>Startup</h3>
                    <p>Inventa, construye y haz crecer tu empresa sin perder el rumbo.</p>
                    <span class="promo-tag">6 meses gratis</span>
                </div>
            </div>
        </section>

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