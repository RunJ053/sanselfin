<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Centro de Ayuda</title>
  <link rel="stylesheet" href="../css/AYUDA_CLIENTE.CSS">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
</head>
<body>
  <button><a href="../index2.html">Volver al inicio</a></button>
  <section>
 
    <header class="text-center">
      <h1 class="title">Centro de Ayuda</h1>
      <p class="subtitle">¿Cómo podemos ayudarte hoy?</p>
    </header>

    <div class="search-bar">
      <input type="text" id="search" placeholder="Buscar en preguntas frecuentes">
      <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
        <path d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm6.293 2.707a1 1 0 0 1-1.414 0l-3.293-3.293a7.934 7.934 0 0 1-3.586.786A8 8 0 1 0 10 18a8 8 0 0 0 7.994-6.274 7.932 7.932 0 0 1 1.587 4.48l3.29 3.29a1 1 0 0 1 0 1.414z"/>
      </svg>
    </div>

    <div class="contact-options">
      <div class="card">
        <div class="card-content">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40">
              <path d="M14 2v4h-4v4h4v4h4v-4h4v-4h-4v-4h-4z"/>
            </svg>
          </div>
          <h3>Chat en Vivo</h3>
          <p>Tiempo de respuesta: 5 min</p>
          <button class="button">Iniciar Chat</button>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40">
              <path d="M6 2c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v20c0 1.1-.9 2-2 2H8c-1.1 0-2-.9-2-2V2zm2 0v20h8V2H8z"/>
            </svg>
          </div>
          <h3>Llamada Telefónica</h3>
          <p>Lun-Vie: 9am - 6pm</p>
          <button class="button">+34 900 123 456</button>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40">
              <path d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H4V6h16v12z"/>
            </svg>
          </div>
          <h3>Correo Electrónico</h3>
          <p>Respuesta en 24h</p>
          <button class="button">Enviar Email</button>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h2>Preguntas Frecuentes</h2>
        <p>Encuentra respuestas rápidas a las preguntas más comunes</p>
      </div>
      <div class="card-content">
        <div class="faq">
          <div class="faq-item">
            <button class="faq-button">¿Cuál es el tiempo de entrega?</button>
            <div class="faq-answer">Realizamos entregas en 24-48 horas dependiendo de tu ubicación. Para productos frescos, las entregas se realizan el mismo día en la mayoría de zonas.</div>
          </div>
          <div class="faq-item">
            <button class="faq-button">¿Cómo garantizan la frescura de las verduras?</button>
            <div class="faq-answer">Trabajamos directamente con agricultores locales y realizamos entregas diarias. Si no estás satisfecho con la calidad, te devolvemos el dinero.</div>
          </div>
          <div class="faq-item">
            <button class="faq-button">¿Cuál es la política de devoluciones?</button>
            <div class="faq-answer">Aceptamos devoluciones en las primeras 24 horas si no estás satisfecho con la calidad de los productos. El reembolso se realiza en 2-3 días hábiles.</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h2>Envíanos un mensaje</h2>
        <p>Cuéntanos tu consulta y te responderemos lo antes posible</p>
      </div>
      <div class="card-content">
        <form>
          <input type="text" placeholder="Nombre" class="input">
          <input type="email" placeholder="Email" class="input">
          <textarea placeholder="¿En qué podemos ayudarte?" class="textarea"></textarea>
          <button>Enviar mensaje</button>
        </form>
      </div>
    </div>
</section>
<footer class="footer">
  <div class="footer-top">
      <div class="container">
          <div class="footer-grid">
              <!-- Sección de información de la empresa -->
              <div class="footer-section">
                  <img src="../img/logo/icon.png" alt="Logo Finca al Día" class="footer-logo">
                  <p class="company-description">Llevamos los productos más frescos del campo a tu mesa, garantizando calidad y frescura en cada entrega.</p>
                  <div class="social-links">
                      <a href="" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                      <a href="" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                      <a href="" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                  </div>
              </div>
              <!-- Sección de contacto -->
              <div class="footer-section">
                  <h3>Contacto</h3>
                  <div class="contact-info">
                      <p><i class="fas fa-clock"></i> Lunes a Sábados, 8:00 a.m a 6:00 p.m</p>
                      <p><i class="fas fa-map-marker-alt"></i> [Tu dirección aquí]</p>
                      <p><i class="fas fa-envelope"></i> informacion@gmail.com</p>
                      <p><i class="fas fa-phone"></i> 300 123 4567</p>
                  </div>
              </div>
              <!-- Sección de newsletter -->
              <div class="footer-section">
                  <h3>Boletín Informativo</h3>
                  <p>Suscríbete para recibir ofertas especiales y noticias sobre productos frescos.</p>
                  <form class="newsletter-form">
                      <input type="email" placeholder="Tu correo electrónico" required>
                      <button type="submit">Suscribirse</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Footer Bottom -->
  <div class="footer-bottom">
      <div class="container">
          <p>&copy; 2024 Finca al Día. Todos los derechos reservados.</p>
          <div class="payment-methods">
              <img src="../img/logo/visa.png" alt="Visa">
              <img src="../img/logo/logo-Mastercard.png" alt="Mastercard">
              <img src="../img/logo/nequi.png" alt="Nequi">
          </div>
      </div>
  </div>
</footer>
</body>
</html>