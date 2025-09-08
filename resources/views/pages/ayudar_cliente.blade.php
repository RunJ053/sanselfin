<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Centro de Ayuda</title>
  <link rel="stylesheet" href="{{asset('css/AYUDA_CLIENTE.CSS')}}">
  <link rel="stylesheet" href="{{asset('/css/footer.css')}}">
  <link rel="shortcut icon" href="{{asset('img/logo/icon.png')}}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div class="p-4">
    <a href="{{route('login')}}" class="inline-block bg-green-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-300">
        Volver al inicio
    </a>
</div>

<section class="max-w-4xl mx-auto px-4 py-8 space-y-8">
    
    <header class="text-center space-y-2">
        <h1 class="text-4xl font-extrabold text-green-700">Centro de Ayuda</h1>
        <p class="text-lg text-gray-600">¿Cómo podemos ayudarte hoy?</p>
    </header>

    <div class="relative w-full max-w-lg mx-auto">
        <input type="text" id="search" placeholder="Buscar en preguntas frecuentes" class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300">
        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm6.293 2.707a1 1 0 0 1-1.414 0l-3.293-3.293a7.934 7.934 0 0 1-3.586.786A8 8 0 1 0 10 18a8 8 0 0 0 7.994-6.274 7.932 7.932 0 0 1 1.587 4.48l3.29 3.29a1 1 0 0 1 0 1.414z"/>
        </svg>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform transform hover:scale-105">
            <div class="p-3 bg-green-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M14 2v4h-4v4h4v4h4v-4h4v-4h-4v-4h-4z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-1">Chat en Vivo</h3>
            <p class="text-gray-500 text-sm mb-4">Tiempo de respuesta: 5 min</p>
            <button class="bg-green-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-green-700 transition-colors duration-300">Iniciar Chat</button>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform transform hover:scale-105">
            <div class="p-3 bg-green-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6 2c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v20c0 1.1-.9 2-2 2H8c-1.1 0-2-.9-2-2V2zm2 0v20h8V2H8z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-1">Llamada Telefónica</h3>
            <p class="text-gray-500 text-sm mb-4">Lun-Vie: 9am - 6pm</p>
            <button class="bg-green-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-green-700 transition-colors duration-300">+34 900 123 456</button>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform transform hover:scale-105">
            <div class="p-3 bg-green-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H4V6h16v12z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-1">Correo Electrónico</h3>
            <p class="text-gray-500 text-sm mb-4">Respuesta en 24h</p>
            <button class="bg-green-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-green-700 transition-colors duration-300">Enviar Email</button>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Preguntas Frecuentes</h2>
            <p class="text-gray-500">Encuentra respuestas rápidas a las preguntas más comunes</p>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="faq-item">
                    <button class="w-full text-left p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors duration-200 text-gray-800 font-medium focus:outline-none">
                        ¿Cuál es el tiempo de entrega?
                    </button>
                    <div class="faq-answer hidden mt-2 p-4 bg-gray-100 rounded-lg border-l-4 border-green-500 text-gray-600">
                        Realizamos entregas en 24-48 horas dependiendo de tu ubicación. Para productos frescos, las entregas se realizan el mismo día en la mayoría de zonas.
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="w-full text-left p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors duration-200 text-gray-800 font-medium focus:outline-none">
                        ¿Cómo garantizan la frescura de las verduras?
                    </button>
                    <div class="faq-answer hidden mt-2 p-4 bg-gray-100 rounded-lg border-l-4 border-green-500 text-gray-600">
                        Trabajamos directamente con agricultores locales y realizamos entregas diarias. Si no estás satisfecho con la calidad, te devolvemos el dinero.
                    </div>
                </div>

                <div class="faq-item">
                    <button class="w-full text-left p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors duration-200 text-gray-800 font-medium focus:outline-none">
                        ¿Cuál es la política de devoluciones?
                    </button>
                    <div class="faq-answer hidden mt-2 p-4 bg-gray-100 rounded-lg border-l-4 border-green-500 text-gray-600">
                        Aceptamos devoluciones en las primeras 24 horas si no estás satisfecho con la calidad de los productos. El reembolso se realiza en 2-3 días hábiles.
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Envíanos un mensaje</h2>
            <p class="text-gray-500">Cuéntanos tu consulta y te responderemos lo antes posible</p>
        </div>
        <div class="p-6">
            <form class="space-y-4">
                <input type="text" placeholder="Nombre" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500">
                <input type="email" placeholder="Email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500">
                <textarea placeholder="¿En qué podemos ayudarte?" class="w-full h-32 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 resize-none"></textarea>
                <button type="submit" class="w-full bg-green-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-700 transition-colors duration-300">Enviar mensaje</button>
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
<script>
    document.querySelectorAll('.faq-item button').forEach(button => {
        button.addEventListener('click', () => {
            const answer = button.nextElementSibling;
            const isExpanded = button.getAttribute('aria-expanded') === 'true' || false;
            button.setAttribute('aria-expanded', !isExpanded);
            
            if (isExpanded) {
                answer.style.display = 'none';
            } else {
                answer.style.display = 'block';
            }
        });
    });
</script>
</html>