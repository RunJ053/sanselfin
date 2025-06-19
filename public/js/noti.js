//para el sistema de busqueda de notificaciones'

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input');
    
    // Función para filtrar los productos
    function filterProducts() {
        // Obtener el valor del input en minúsculas
        const searchTerm = searchInput.value.toLowerCase().trim();
        
        // Obtener todas las tarjetas de productos
        const productCards = document.querySelectorAll('.purchase-card');
        
        productCards.forEach(card => {
            const productTitle = card.querySelector('.product-title').textContent.toLowerCase();
            const productPrice = card.querySelector('.product-meta')?.textContent.toLowerCase() || '';
            const productStatus = card.querySelector('.status-badge')?.textContent.toLowerCase() || '';
            
            // Combinar toda la información del producto para búsqueda
            const productInfo = `${productTitle} ${productPrice} ${productStatus}`;
            
            // Verificar si el término de búsqueda está en la información del producto
            if (productInfo.includes(searchTerm)) {
                // Mostrar la tarjeta con una transición suave
                card.style.display = 'block';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            } else {
                // Ocultar la tarjeta con una transición suave
                card.style.opacity = '0';
                card.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });

        // Mostrar mensaje si no hay resultados
        const allHidden = Array.from(productCards).every(card => card.style.display === 'none');
        let noResultsMessage = document.querySelector('.no-results');
        
        if (allHidden && searchTerm !== '') {
            if (!noResultsMessage) {
                noResultsMessage = document.createElement('div');
                noResultsMessage.className = 'no-results';
                noResultsMessage.style.textAlign = 'center';
                noResultsMessage.style.padding = '20px';
                noResultsMessage.style.color = '#666';
                productCards[0].parentNode.appendChild(noResultsMessage);
            }
            noResultsMessage.textContent = `No se encontraron resultados para "${searchTerm}"`;
            noResultsMessage.style.display = 'block';
        } else if (noResultsMessage) {
            noResultsMessage.style.display = 'none';
        }
    }

    // Agregar evento input al campo de búsqueda
    searchInput.addEventListener('input', debounce(filterProducts, 300));

    // Función debounce para mejorar el rendimiento
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Agregar estilos CSS necesarios
    const style = document.createElement('style');
    style.textContent = `
        .purchase-card {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .search-input {
            transition: box-shadow 0.3s ease;
        }
        .search-input:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }
        .no-results {
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    `;
    document.head.appendChild(style);
});

const tabs = document.querySelectorAll('.tab');
        
// Añadir event listener a cada tab
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        // Remover la clase active de todos los tabs
        tabs.forEach(t => t.classList.remove('active'));
        
        // Añadir la clase active al tab clickeado
        tab.classList.add('active');
        
        // Obtener el id de la sección correspondiente
        const targetId = tab.getAttribute('data-tab');
        
        // Ocultar todas las secciones
        document.querySelectorAll('.purchases-section').forEach(section => {
            section.classList.remove('active');
        });
        
        // Mostrar la sección seleccionada
        document.getElementById(targetId).classList.add('active');
    });
});

// Implementar la funcionalidad de búsqueda
const searchInput = document.querySelector('.search-input');
searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.purchase-card');
    
    cards.forEach(card => {
        const title = card.querySelector('.product-title').textContent.toLowerCase();
        if (title.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});