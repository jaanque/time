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


          <!-- Milestone Section -->
          <section class="milestone-section">
            <div class="milestone-content">
                <h2>Más de 100.000 mensajes enviados 🥰</h2>
                <p class="milestone-description"> Cada día, más personas eligen Nam3.es para enviar mensajes sin dejar rastro. Sin registros, sin almacenamiento, solo privacidad total y mensajes efímeros que desaparecen tras ser leídos. </p>
                <div class="milestone-actions">
                    <a href="create.php" class="btn btn-primary"> Crear mensaje <span class="btn-icon">✨</span></a>
                </div>
            </div>
        </section>


        <!-- Social Proof Section -->
<section class="testimonials-section">
    <div class="testimonials-container">
        <h2 class="testimonials-title">The simplest way to create forms</h2>
        <p class="testimonials-subtitle">Say goodbye to boring forms. Meet Tally — the free, intuitive form builder you've been looking for.</p>
        
        <div class="testimonials-cta">
            <a href="create.php" class="btn btn-primary">Create a free form <span class="btn-icon">→</span></a>
            <p class="no-signup">No signup required</p>
        </div>
        
        <div class="testimonials-illustrations">
            <div class="illustration-left">
                <div class="speech-bubble">
                    <p>¡Genial!</p>
                </div>
                <div class="avatar-icon"></div>
            </div>
            
            <div class="form-preview">
                <div class="form-header"></div>
                <div class="form-content">
                    <h3>Register now</h3>
                    <p>Claim your spot for our annual no-code conference on October 12th, 2023. Get ready to be inspired by the industry-leading speakers and learn from the best. We're starting at 7pm!</p>
                </div>
            </div>
            
            <div class="illustration-right">
                <div class="speech-bubble">
                    <p>Yes!</p>
                </div>
                <div class="avatar-icon"></div>
            </div>
        </div>
    </div>
</section>


        <!-- Footer -->
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-main">
            <div class="footer-logo">
                <img src="assets/img/logo.png" alt="<?php echo SITE_NAME; ?> Logo">
                <h3>Nam3.es</h3>
                <p>Mensajería temporal y segura sin registros ni datos personales.</p>
            </div>
            
            <div class="footer-links">
                <div class="footer-column">
                    <h4>Navegación</h4>
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="#como-funciona">Cómo Funciona</a></li>
                        <li><a href="create.php">Crear Mensaje</a></li>
                        <li><a href="view.php">Leer Mensaje</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="privacidad.php">Política de Privacidad</a></li>
                        <li><a href="terminos.php">Términos de Uso</a></li>
                        <li><a href="cookies.php">Política de Cookies</a></li>
                        <li><a href="aviso-legal.php">Aviso Legal</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Contacto</h4>
                    <ul>
                        <li><a href="contacto.php">Formulario de Contacto</a></li>
                        <li><a href="faq.php">Preguntas Frecuentes</a></li>
                        <li><a href="soporte.php">Soporte</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> - Todos los derechos reservados</p>
            <div class="social-links">
                <a href="#" aria-label="Github"><i class="social-icon">📘</i></a>
            </div>
        </div>
    </div>
</footer>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>