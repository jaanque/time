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


        <section class="security-section">
  <div class="solutions-grid">
    <h1 class="h1">Cómo Protegemos Tu Privacidad</h1>
    <br><br>
    <div class="grid-container">
      <div class="solution-card">
        <div class="solution-icon product-icon"></div>
        <h3>Mensajes Autodestructivos</h3>
        <p>Cada mensaje se elimina permanentemente de nuestros servidores inmediatamente después de ser leído, sin posibilidad de recuperación.</p>
      </div>
      
      <div class="solution-card">
        <div class="solution-icon agency-icon"></div>
        <h3>Sin Registros ni Historiales</h3>
        <p>No requerimos registro ni almacenamos datos personales. No hay rastros de quién envió o recibió los mensajes.</p>
      </div>
      
      <div class="solution-card">
        <div class="solution-icon software-icon"></div>
        <h3>Cifrado de Extremo a Extremo</h3>
        <p>Todos los mensajes están protegidos con cifrado avanzado, asegurando que solo el destinatario pueda acceder a su contenido.</p>
      </div>
      
      <div class="solution-card">
        <div class="solution-icon startup-icon"></div>
        <h3>Caducidad Programada</h3>
        <p>Aunque no se lean, los mensajes se eliminan automáticamente después de 7 días, garantizando que ninguna información permanezca en nuestros sistemas.</p>
      </div>
    </div>
  </div>
  
  <div class="milestone-section" style="background-color: var(--primary-color);">
    <div class="milestone-content">
      <h2>Comprometidos con tu Confidencialidad</h2>
      <p class="milestone-description">Nam3 no puede acceder al contenido de tus mensajes. Nuestro sistema está diseñado para que ni siquiera nosotros podamos leer lo que compartes. La verdadera privacidad significa que nadie, absolutamente nadie, puede acceder a tus mensajes excepto el destinatario autorizado.</p>
      <div class="milestone-actions">
        <a href="create.php" class="btn btn-primary">Crear mensaje seguro <span class="btn-icon">🔒</span></a>
      </div>
    </div>
  </div>
</section>


<!-- Preguntas Frecuentes Section -->
<section class="solutions-grid">
  <h1 class="h1">Preguntas Frecuentes</h1>
  <br><br>
  <div class="grid-container">
    <div class="solution-card">
      <h3>¿Es realmente anónimo este servicio?</h3>
      <p>Sí, completamente. No requerimos registro ni almacenamos información personal. No guardamos direcciones IP, identificadores de dispositivos ni ningún dato que pueda identificarte.</p>
    </div>
    
    <div class="solution-card">
      <h3>¿Qué sucede después de que se lee un mensaje?</h3>
      <p>Una vez que el destinatario abre y lee el mensaje, este se elimina permanentemente de nuestros servidores. No queda ninguna copia ni respaldo, garantizando la privacidad total.</p>
    </div>
    
    <div class="solution-card">
      <h3>¿Por cuánto tiempo se guarda un mensaje no leído?</h3>
      <p>Los mensajes no leídos se eliminan automáticamente después de 7 días. Esto asegura que ningún contenido permanezca en nuestros sistemas más tiempo del necesario.</p>
    </div>
    
    <div class="solution-card">
      <h3>¿Cómo comparto el mensaje con el destinatario?</h3>
      <p>Después de crear el mensaje, recibirás un código único. Comparte este código con el destinatario por cualquier medio que prefieras, y ellos podrán acceder al mensaje usando ese código en nuestra página de lectura.</p>
    </div>
    
    <div class="solution-card">
      <h3>¿Puedo recuperar un mensaje después de que se haya leído?</h3>
      <p>No, una vez que un mensaje ha sido leído, se elimina permanentemente y no puede ser recuperado. Esta es una característica de seguridad fundamental de nuestro servicio.</p>
    </div>
    
    <div class="solution-card">
      <h3>¿El mensaje está protegido con contraseña?</h3>
      <p>El mensaje está protegido mediante un código único de acceso. Opcionalmente, puedes añadir una contraseña adicional durante la creación del mensaje para mayor seguridad.</p>
    </div>
    
    <div class="solution-card">
      <h3>¿Hay algún límite de tamaño para los mensajes?</h3>
      <p>Sí, actualmente el límite es de 10,000 caracteres por mensaje para garantizar el rendimiento y seguridad del servicio.</p>
    </div>
    
    <div class="solution-card">
      <h3>¿Puedo adjuntar archivos a mis mensajes?</h3>
      <p>Por el momento, nuestro servicio solo admite mensajes de texto. Esta limitación existe para garantizar la máxima seguridad y privacidad en todas las comunicaciones.</p>
    </div>
  </div>
</section>



<!-- Testimonials Section -->
<section class="testimonials-section">
  <div class="testimonials-container">
    <div class="testimonials-header">
      <h2>Lo que dicen nuestros usuarios</h2>
      <p class="testimonials-subtitle">Miles de personas confían en Nam3.es para sus comunicaciones confidenciales</p>
    </div>
    
    <div class="testimonials-grid">
      <div class="testimonial-card">
        <div class="testimonial-rating">★★★★★</div>
        <p class="testimonial-text">"Nam3.es me salvó cuando necesitaba compartir información sensible con un cliente. Simple, rápido y realmente se autodestruye. Lo uso constantemente en mi trabajo."</p>
        <div class="testimonial-author">
          <div class="author-avatar">
            <span>#</span>
          </div>
          <div class="author-info">
            <h4>Anónimo</h4>
          </div>
        </div>
      </div>
      
      <div class="testimonial-card featured">
        <div class="testimonial-badge">Destacado</div>
        <div class="testimonial-rating">★★★★★</div>
        <p class="testimonial-text">"Como abogada, la confidencialidad es primordial. Nam3.es me ofrece la tranquilidad que necesito al compartir información delicada con mis clientes. El hecho de que los mensajes se destruyan después de ser leídos es exactamente lo que necesitábamos."</p>
        <div class="testimonial-author">
          <div class="author-avatar">
            <span>#</span>
          </div>
          <div class="author-info">
            <h4>Anónimo</h4>
          </div>
        </div>
      </div>
      
      <div class="testimonial-card">
        <div class="testimonial-rating">★★★★★</div>
        <p class="testimonial-text">"Increíblemente útil para compartir contraseñas temporales con mi equipo. Sin registro, sin complicaciones, simplemente funciona. La interfaz es intuitiva y el proceso es muy rápido."</p>
        <div class="testimonial-author">
          <div class="author-avatar">
            <span>#</span>
          </div>
          <div class="author-info">
            <h4>Anónimo</h4>
          </div>
        </div>
      </div>
      
      <div class="testimonial-card">
        <div class="testimonial-rating">★★★★☆</div>
        <p class="testimonial-text">"Lo uso para enviar información confidencial a mis colegas. La función de autodestrucción es justo lo que necesitaba. Simple, efectivo y sin complicaciones."</p>
        <div class="testimonial-author">
          <div class="author-avatar">
            <span>#</span>
          </div>
          <div class="author-info">
            <h4>Anónimo</h4>
          </div>
        </div>
      </div>
    </div>
    
    <div class="testimonials-summary">
      <div class="summary-stat">
        <span class="stat-number">4.9</span>
        <span class="stat-label">Valoración media</span>
        <div class="stat-stars">★★★★★</div>
      </div>
      
      <div class="summary-stat">
        <span class="stat-number">98%</span>
        <span class="stat-label">Recomendarían Nam3.es</span>
      </div>
      
      <div class="summary-stat">
        <span class="stat-number">100k+</span>
        <span class="stat-label">Usuarios activos</span>
      </div>
    </div>
    
    <div class="testimonials-cta">
      <a href="create.php" class="btn btn-primary">Únete a ellos <span class="btn-icon">→</span></a>
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