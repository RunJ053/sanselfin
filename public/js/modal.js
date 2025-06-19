document.addEventListener('DOMContentLoaded', () => {
    const productContainer = document.querySelector('.products_co'); // Contenedor de productos
    const modal = document.getElementById('productModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalValor = document.getElementById('modalValor');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.querySelector('.close-modal');
    const addToCart = document.getElementById('addToCart');
    const modalButtons = document.getElementById('modalButtons');
    const continueShopping = document.getElementById('continueShopping');
    const goToCart = document.getElementById('goToCart');
    const cart = [];

    fetch('./json/productos.json')
        .then(response => {
            if (!response.ok) throw new Error(`Error: ${response.status}`);
            return response.json();
        })
        .then(data => {
            productContainer.innerHTML = '';
            data.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('product');
                productDiv.setAttribute('data-name', product.nombre);
                productDiv.setAttribute('data-valor', product.valor);
                productDiv.setAttribute('data-description', product.descripcion);
                productDiv.setAttribute('data-image', product.imagen);
                productDiv.setAttribute('data-category', 'general');

                productDiv.innerHTML = `
                    <img class="image" src="${product.imagen}" alt="${product.nombre}">
                    <div class="info">
                        <h3>${product.nombre}</h3>
                        <p>${product.descripcion}</p>
                        <p>${product.valor}</p>
                    </div>
                `;
                productContainer.appendChild(productDiv);
            });
        })
        .catch(error => console.error('Error cargando productos:', error));

    productContainer.addEventListener('click', (e) => {
        const product = e.target.closest('.product');
        if (product) {
            const name = product.getAttribute('data-name');
            const description = product.getAttribute('data-description');
            const valor = product.getAttribute('data-valor');
            const image = product.getAttribute('data-image');

            if (name && description && valor && image) {
                modalTitle.textContent = name;
                modalDescription.textContent = description;
                modalValor.textContent = valor;
                modalImage.src = image;
                modal.style.display = 'flex';
                modalButtons.style.display = 'none'; // Ocultar botones al abrir el modal
            }
        }
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
        modalButtons.style.display = 'none'; // Ocultar botones al cerrar el modal
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
            modalButtons.style.display = 'none'; // Ocultar botones al cerrar el modal
        }
    });

    addToCart.addEventListener('click', () => {
        const quantityInput = document.getElementById('productQuantity');
        const quantity = parseInt(quantityInput.value, 10);

        if (isNaN(quantity) || quantity <= 0) {
            alert('Por favor, introduce una cantidad válida.');
            return;
        }

        const product = {
            name: modalTitle.textContent,
            description: modalDescription.textContent,
            valor: modalValor.textContent,
            quantity
        };

        cart.push(product);
        localStorage.setItem('cart', JSON.stringify(cart));
        alert(`${quantity} ${product.name}(s) añadido(s) al carrito`);

        modalButtons.style.display = 'flex';
    });

    continueShopping.addEventListener('click', () => {
        modal.style.display = 'none'; // Cerrar el modal
        modalButtons.style.display = 'none'; // Ocultar botones
    });

    goToCart.addEventListener('click', () => {
        window.location.href = './productos/CARRITO_DE_COMPRAS.html';
    });
});

function cargarProductos() {
    fetch('./json/productos.json')
        .then(response => {
            if (!response.ok) throw new Error(`Error: ${response.status}`);
            return response.json();
        })
        .then(data => {
            data.forEach((product, index) => {
                const nuevoProducto = new Producto(
                    index + 1,
                    product.nombre,
                    parseFloat(product.valor), // Asegúrate de que el valor sea un número
                    product.imagen,
                    product.descripcion
                );
                productos.push(nuevoProducto); // Agregar el nuevo producto al array de productos
            });
            renderizarProductos(); // Llamar a la función para renderizar los productos
        })
        .catch(error => console.error('Error cargando productos:', error));
}