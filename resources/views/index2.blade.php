<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Finca al Día - Frutas y Verduras Frescas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/NAV.css">
</head>
<body>
    <nav class="main-nav" aria-label="Navegación principal">
        <div class="nav-left">
            <a href="index2.html" class="logo-link">
                <img src="img/logo/icon.png" alt="Logo de La Finca al Día" width="150" height="50">
            </a>
        </div>
        <div class="nav-center">
            <ul class="nav-links" role="menubar">
                <li role="none"><a href="index2.html" role="menuitem">Inicio</a></li>
                <li role="none"><a href="PRODUCTO.html" role="menuitem">Productos</a></li>
                <li role="none"><a href="SERVICIOS.html" role="menuitem">Servicios</a></li>
                <li role="none"><a href="ACERCA_DE.html" role="menuitem">Acerca de</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <ul class="nav-actions" role="menubar">
                <li role="none">
                    <a href="pages/NOTIFICACION.html" role="menuitem" aria-label="Notificaciones">
                        <i class="fas fa-bell"></i>
                        <span class="visually-hidden">Notificaciones</span>
                    </a>
                </li>
                <li role="none">
                    <a href="productos/CARRITO_DE_COMPRAS.html" role="menuitem" aria-label="Carrito de Compras">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="visually-hidden">Carrito de Compras</span>
                    </a>
                </li>
                <li role="none">
                    <a href="pages/AYUDA_CLIENTE.html" role="menuitem" aria-label="Necesito Ayuda!">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>Necesito Ayuda!</span>
                    </a>
                </li>
                <li role="none">
                    <a href="{{ route('logout') }}" class="logout-button" role="menuitem">Cerrar Sesión</a>
                </li>
            </ul>
            <button class="menu-toggle" onclick="toggleMenu()" aria-expanded="false" aria-label="Menú">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    <main>
        <section data-aos="zoom-in-down" class="hero">
            <div data-aos="fade-down" data-aos-delay="100" class="container">
                <div class="hero-text">
                    <h2>La Finca al Día:</h2>
                    <h1>Bienvenido, <?php echo session('nombre_usuario') ? session('nombre_usuario') : 'Invitado'; ?></h1>
                </div>
                <div data-aos="fade-left" data-aos-delay="1000" class="hero-info">
                    <p>Descubre más productos</p>
                    <button class="button"><a href="PRODUCTO.html">Explorar Productos</a></button>
                </div>
            </div>
        </section>
        <section class="mas_para_ti">
            <div data-aos="fade-right"
            data-aos-offset="100"
            data-aos-easing="ease-in-sine"
            class="container">
                <h4>Lo Mejor para Ti</h4>
                <h1>Productos Seleccionados</h1>
                <p>Conoce los productos que hemos seleccionado especialmente para ti, combinando 
                estilo y frescura.</p>
                <div data-aos="fade-down-left"
                data-aos-delay="200"
                class="box">
                    <div class="item">
                        <h4><i class="fa-solid fa-star"></i> Calidad Garantizada</h4>
                        <p>Tus productos son seleccionados con los más altos estándares de calidad.</p>
                    </div>
                    <div class="item">
                        <h4><i class="fa-solid fa-truck-pickup"></i> Entrega Rápida</h4>
                        <p>Disfruta de un servicio de entrega eficiente para que tus productos lleguen a tiempo.</p>
                    </div>
                    <div class="item">
                        <h4><i class="fa-solid fa-check-to-slot"></i> Productos Destacados</h4>
                        <p>Puedes descubrir nuestra selección especial de productos que están marcando la diferencia este mes.</p>
                    </div>
                    <div class="item">
                        <h4><i class="fa-solid fa-people-carry-box"></i> Atención Personalizada</h4>
                        <p>Nuestro equipo está siempre disponible para ofrecerte una atención personalizada.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="products">
            <div data-aos="zoom-out" 
            data-aos-delay="100"
            class="container">
                <h2>Nuestras Galería de Productos</h2>
                <p>Descubre nuestra selección de frutas y verduras frescas.</p>
                <p>Explora y descubre cada producto con nuestra galería visual que temos solo para ti.</p>
                <div data-aos="zoom-in"
                data-aos-delay="450"
                class="product-grid">
                    <div class="product-item">
                        <img src="img/product/Tomate.png" alt="Tomates frescos">
                        <h3>Tomates Frescos</h3>
                        <p>Precio: $3000 por kg</p>
                    </div>
                    <div class="product-item">
                        <img src="img/product/lechuga.webp" alt="Lechuga orgánica">
                        <h3>Lechuga Orgánica</h3>
                        <p>Precio: $8000 por unidad</p>
                    </div>
                    <div class="product-item">
                        <img src="img/product/zha.jfif" alt="Zanahorias dulces">
                        <h3>Zanahorias Dulces</h3>
                        <p>Precio: $2000 por kg</p>
                    </div>
                    <div class="product-item">
                        <img src="img/product/naj.jfif" alt="Naranja Dulce">
                        <h3>Naranja</h3>
                        <p>Precio: $7000 por kg</p>
                    </div>
                    <div class="product-item">
                        <img src="img/product/Espinaca (2).png" alt="Pepino fresco">
                        <h3>Espinaca</h3>
                        <p>Precio: $3400 por unidad</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="offers">
            <div data-aos="zoom-out-up" class="container">
                <h2>Ofertas Especiales</h2>
                <div class="offer-grid">
                    <div class="offer-image">
                        <img src="img/es_de_frutas_y_verduras_1.webp" alt="Ofertas Especiales">
                    </div>
                    <div class="offer-info">
                        <div class="offer-item">
                            <h3>Descuento en Frutas</h3>
                            <p>20% de descuento en todas las frutas esta semana.</p>
                        </div>
                        <div class="offer-item">
                            <h3>Compra 2, Lleva 3</h3>
                            <p>Compra 2 lechugas y llévate la tercera gratis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section data-aos="zoom-out-up"
        data-aos-delay="100"
        class="testimonials">
            <div class="container">
                <h2>Testimonios</h2>
                <p>¿Aun tines dudas? Acercate a los demás para saber que piensan sobre nosotros.</p>
                <div class="testimonial-grid">
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p>"Los productos son siempre frescos y de alta calidad. ¡Recomiendo La Finca al Día!"</p>
                            <div class="testimonial-author">
                                <span class="author-name">Juan P.</span>
                            </div>
                        </div>
                        <div class="testimonial-image">
                            <img src="img/logo/icon.png" alt="Juan P.">
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p>"Excelente servicio al cliente y entrega rápida. ¡Estoy muy satisfecha!"</p>
                            <div class="testimonial-author">
                                <span class="author-name">María G.</span>
                            </div>
                        </div>
                        <div class="testimonial-image">
                            <img src="img/product/Carambola.png" alt="María G.">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="preguntas">
            <div class="container">
                <h2>Preguntas Frecuentes</h2>
                <p>¿Tienes alguna pregunta? Aquí te dejamos algunas respuestas a las preguntas más frecuentes.</p>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        ¿Cómo puedo contactarlos?
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Puedes contactarnos a través de nuestro fourmulario de contacto o por teléfono.</div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        ¿Cómo puedo pagar?
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Aceptamos pagos en efectivo ó transferencia bancaria.</div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        ¿Cuál es el tiempo de entrega?
                        </button>
                      </h2>
                      <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">El tiempo de entrega es de 1 a 2 días hábiles, dependiendo de tu ubicación.</div>
                      </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                          ¿Cada cuanto hacen ofertas?
                          </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">La mayoria de ofertas se realizan en eventos especiales.</div>
                        </div>
                      </div>
                  </div>
            </div>
        </section>
        <section data-aos="flip-up" class="blog">
            <div class="container">
                <h2>Últimos Artículos del Blog</h2>
                <hr>
                <div data-aos="fade-up"
                data-aos-delay="100"
                class="blog-grid">
                    <div class="blog-item">
                        <img src="img/verduras_frutas_y_hortalizas_5.webp" alt="">
                        <h3><a href="https://www.google.com/search?q=beneficios+de+comer+frutas&rlz=1C1GCEA_enCO1117CO1126&oq=beneficios+de+comer+frutas&gs_lcrp=EgZjaHJvbWUyCQgAEEUYORiABDIHCAEQABiABDIHCAIQABiABDIHCAMQABiABDIHCAQQABiABDIHCAUQABiABDIHCAYQABiABDIHCAcQABiABDIHCAgQABiABDIHCAkQABiABNIBCTExMzYyajBqN6gCALACAA&sourceid=chrome&ie=UTF-8">Beneficios de Comer Frutas Frescas</a></h3>
                        <p>Descubre por qué las frutas son esenciales para una dieta saludable.</p>
                    </div>
                    <div class="blog-item">
                        <img src="img/verduras_frutas_y_hortalizas_6.webp" alt="">
                        <h3><a href="https://www.google.com/search?q=10+beneficios+de+comer+verduras&sca_esv=c7459735fc04b658&rlz=1C1GCEA_enCO1117CO1126&sxsrf=AHTn8zrwI3Q-HQ8hEHg0TjzndM5w2BrFWg%3A1738192710510&ei=RreaZ53tHoaawbkPq9nduAY&oq=10+benfios+de+comer+verdu&gs_lp=Egxnd3Mtd2l6LXNlcnAiGTEwIGJlbmZpb3MgZGUgY29tZXIgdmVyZHUqAggAMgcQABiABBgNMgYQABgWGB4yBhAAGBYYHkiwLlAAWP0ncAF4AZABAJgBuAGgAd4ZqgEEMC4yNbgBA8gBAPgBAZgCGqACkhuoAhTCAgcQIxgnGOoCwgITEAAYgAQYQxi0AhiKBRjqAtgBAcICChAjGIAEGCcYigXCAgoQABiABBhDGIoFwgIFEAAYgATCAgsQABiABBixAxiDAcICCBAAGIAEGLEDwgILEC4YgAQYsQMY1ALCAgoQABiABBgUGIcCwgIIEAAYFhgKGB7CAgUQIRigAZgDF_EFlltSxCNuiXe6BgYIARABGAGSBwQxLjI1oAetrwE&sclient=gws-wiz-serp">Recetas Deliciosas con Verduras</a></h3>
                        <p>Explora recetas fáciles y deliciosas para incorporar más verduras en tu dieta.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
<footer data-aos="fade-up"
data-aos-duration="100"
class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">
                <!-- Sección de información de la empresa -->
                <div class="footer-section">
                    <img src="img/logo/icon.png" alt="Logo Finca al Día" class="footer-logo">
                    <p class="company-description">Llevamos los productos más frescos del campo a tu mesa, garantizando calidad y frescura en cada entrega.</p>
                    <div class="social-links">
                        <a href="" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <!-- Sección de enlaces rápidos -->
                <div class="footer-section">
                    <h3>Enlaces Rápidos</h3>
                    <ul class="footer-links">
                        <li><a href="PRODUCTO.html">Nuestros Productos</a></li>
                        <li><a href="index2.html">Recetas</a></li>
                        <li><a href="index2.html">Blog</a></li>
                        <li><a href="ACERCA_DE.html">Sobre Nosotros</a></li>
                        <li><a href="SERVICIOS.html">FAQ</a></li>
                    </ul>
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
                <img src="img/logo/visa.png" alt="Visa">
                <img src="img/logo/logo-Mastercard.png" alt="Mastercard">
                <img src="img/logo/nequi.png" alt="Nequi">
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/hamburguesa.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
</body>
</html>