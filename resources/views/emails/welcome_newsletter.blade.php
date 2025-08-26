<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finca al Día - Tu Supermercado Online</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #78ca6fff 0%, #458713ff 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            border-radius: 20px;
            overflow: hidden;
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(45deg, #4CAF50, #8BC34A);
            color: white;
            padding: 40px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% { transform: translateX(-50%) translateY(-50%) rotate(0deg); }
            100% { transform: translateX(-50%) translateY(-50%) rotate(360deg); }
        }

        .header h1 {
            font-size: 3em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .badge {
            background: #ff6b6b;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            margin: 15px 0;
            font-weight: bold;
            animation: pulse 2s infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .content {
            padding: 40px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section h2 {
            color: #4CAF50;
            font-size: 2.2em;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }

        .section h2::after {
            content: '';
            width: 80px;
            height: 4px;
            background: linear-gradient(45deg, #4CAF50, #8BC34A);
            display: block;
            margin: 10px auto;
            border-radius: 2px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .product-card {
            background: linear-gradient(145deg, #f0f9ff, #e0f2fe);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(76, 175, 80, 0.3);
            border-color: #4CAF50;
        }

        .product-emoji {
            font-size: 3em;
            margin-bottom: 15px;
            display: block;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .product-card h3 {
            color: #2196F3;
            font-size: 1.1em;
            font-weight: bold;
        }

        .features {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 20px;
            margin: 30px 0;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .feature-item {
            background: rgba(255,255,255,0.15);
            padding: 25px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255,255,255,0.25);
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2.5em;
            margin-bottom: 15px;
            display: block;
        }

        .cta {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 40px;
            text-align: center;
            border-radius: 20px;
            margin: 30px 0;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.4);
        }

        .cta h2 {
            font-size: 2.5em;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .cta p {
            font-size: 1.3em;
            margin-bottom: 25px;
            opacity: 0.95;
        }

        .btn {
            background: white;
            color: #ff6b6b;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            background: #f8f8f8;
        }

        .contact-info {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin: 20px 0;
        }

        .contact-info h3 {
            color: #4CAF50;
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .contact-item {
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .discount-banner {
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            border-radius: 15px;
            font-size: 1.3em;
            font-weight: bold;
            animation: glow 3s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { box-shadow: 0 5px 20px rgba(240, 147, 251, 0.4); }
            to { box-shadow: 0 5px 30px rgba(245, 87, 108, 0.6); }
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2.2em; }
            .section h2 { font-size: 1.8em; }
            .products-grid { grid-template-columns: repeat(2, 1fr); }
            .content { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>🛒 Finca al Día</h1>
            <p>Tu supermercado online de confianza</p>
            <div class="badge">🚚 Entrega a Domicilio</div>
        </header>

        <main class="content">
            <div class="discount-banner">
                ✨ ¡GRAN APERTURA! puede que tu compra venga con algo maravilloso ✨
            </div>

            <section class="section">
                <h2>🌟 Nuestros Productos</h2>
                <div class="products-grid">
                    <div class="product-card">
                        <span class="product-emoji">🥬</span>
                        <h3>Frutas y Verduras Frescas</h3>
                    </div>
                    <div class="product-card">
                        <span class="product-emoji">🥤</span>
                        <h3>Bebidas y Gaseosas</h3>
                    </div>
                    <div class="product-card">
                        <span class="product-emoji">🍞</span>
                        <h3>Víveres y Alimentos</h3>
                    </div>
                    <div class="product-card">
                        <span class="product-emoji">🧴</span>
                        <h3>Productos de Higiene</h3>
                    </div>
                    <div class="product-card">
                        <span class="product-emoji">📦</span>
                        <h3>Paquetes Especiales</h3>
                    </div>
                    <div class="product-card">
                        <span class="product-emoji">🛍️</span>
                        <h3>¡Y mucho más!</h3>
                    </div>
                </div>
            </section>

            <section class="features">
                <h2 style="color: white; text-align: center; margin-bottom: 20px;">¿Por qué elegirnos?</h2>
                <div class="features-grid">
                    <div class="feature-item">
                        <span class="feature-icon">⚡</span>
                        <h3>Entrega Rápida</h3>
                        <p>Recibe tus productos en máximo 2 horas</p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🌱</span>
                        <h3>Productos Frescos</h3>
                        <p>Calidad garantizada directo del productor</p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">💰</span>
                        <h3>Mejores Precios</h3>
                        <p>Los precios más competitivos del mercado</p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">📱</span>
                        <h3>Fácil de Usar</h3>
                        <p>Plataforma intuitiva y amigable</p>
                    </div>
                </div>
            </section>

            <section class="cta">
                <h2>¡Haz tu primera compra!</h2>
                <p>Descubre la comodidad de comprar desde casa</p>
                <a href="#" class="btn">Comprar Ahora</a>
            </section>

            <div class="contact-info">
                <h3>📞 Información de Contacto</h3>
                <div class="contact-grid">
                    <div class="contact-item">
                        <strong>📱 WhatsApp</strong><br>
                        +57 300 123 4567
                    </div>
                    <div class="contact-item">
                        <strong>📧 Email</strong><br>
                        fincaaldia25@gmail.com
                    </div>
                    <div class="contact-item">
                        <strong>🕒 Horarios</strong><br>
                        Lun - Sab: 8:00 AM - 6:00 PM
                    </div>
                    <div class="contact-item">
                        <strong>🌐 Cobertura</strong><br>
                        Suba
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Animación suave al hacer scroll
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.product-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });

            // Efecto de click en el botón
            const btn = document.querySelector('.btn');
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                    alert('¡Gracias por tu interés! Inicia sesión y realiza tu compra.');
                }, 150);
            });
        });
    </script>
</body>
</html>