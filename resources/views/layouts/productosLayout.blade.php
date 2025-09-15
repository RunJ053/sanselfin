<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podructos - La Finca al Día</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href={{ asset('img/logo/icon.png') }} type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/PRODUCTO.CSS') }}">
    <link rel="stylesheet" href="{{ asset('css/NAV.CSS') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/hamburguesa.js') }}"></script>
    <script>
        // Variables y selectores iniciales
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
        const searchInput = document.getElementById("searchInput");
        const clearSearchButton = document.getElementById("clearSearch"); // Renombrado para mayor claridad
        const hiddenCategoryInput = document.getElementById("hiddenCategoryInput");
        const productsContainer = document.getElementById("productsContainer");
        const searchResultsInfo = document.getElementById("searchResultsInfo");
        const paginationContainer = document.querySelector(".paginador"); // Nuevo: Contenedor de la paginación

        // --- Funciones para la Carga de Productos y Paginación (NUEVAS / MODIFICADAS) ---

        /**
         * Carga los productos usando AJAX, aplicando filtros de categoría y búsqueda,
         * y actualiza la paginación.
         * @param {string} category - La categoría seleccionada.
         * @param {string} searchTerm - El término de búsqueda.
         * @param {string} pageUrl - La URL de la página de paginación (opcional, para clics en paginador).
         */
        async function loadProducts(category = "all", searchTerm = "", pageUrl = null) {
            // Mostrar spinner de carga
            productsContainer.innerHTML = `
            <div class="loading">
                <div class="spinner"></div> Cargando productos...
            </div>
        `;
            searchResultsInfo.style.display = "none"; // Ocultar info mientras carga

            let url = pageUrl || "{{ route('producto') }}";
            const params = new URLSearchParams();

            // Si no es un clic de paginación (es decir, una nueva búsqueda/filtro),
            // reiniciamos la página a 1 agregando los parámetros.
            // Si es un clic de paginación, la URL ya contendrá 'page'.
            if (!pageUrl) {
                if (category && category !== "all") {
                    params.append("categoria", category);
                }
                if (searchTerm) {
                    params.append("search", searchTerm);
                }
                // Adjuntar parámetros solo si no están ya en la URL de paginación
                if (params.toString()) {
                    url += "?" + params.toString();
                }
            }

            try {
                const response = await fetch(url, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest", // Para que Laravel sepa que es una petición AJAX
                    },
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                productsContainer.innerHTML = data.html; // Carga los productos renderizados por el parcial
                updateSearchResultsInfo(data.productCount, searchTerm, category); // Actualiza la información de resultados

                // Actualizar los enlaces de paginación
                if (paginationContainer) {
                    paginationContainer.innerHTML = data.pagination;
                    attachPaginationEvents(); // Volver a adjuntar eventos a los nuevos enlaces
                }
            } catch (error) {
                console.error("Error al cargar productos:", error);
                productsContainer.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-exclamation-triangle" style="color: #dc3545;"></i>
                    <h3>Error al cargar productos</h3>
                    <p>Por favor, inténtalo de nuevo más tarde.</p>
                </div>
            `;
                searchResultsInfo.style.display = "none";
                if (paginationContainer) {
                    paginationContainer.innerHTML = ""; // Limpiar paginación en caso de error
                }
            }
        }

        /**
         * Adjunta event listeners a todos los enlaces de paginación.
         */
        function attachPaginationEvents() {
            document.querySelectorAll(".paginador .pagination a").forEach((link) => {
                // Eliminar listeners existentes para evitar duplicados si la función se llama varias veces
                link.removeEventListener("click", handlePaginationClick);
                link.addEventListener("click", handlePaginationClick);
            });
        }

        /**
         * Maneja el clic en un enlace de paginación, cargando la nueva página con AJAX.
         * @param {Event} e - El evento de clic.
         */
        function handlePaginationClick(e) {
            e.preventDefault(); // Evita la navegación normal de la página
            const pageUrl = e.target.getAttribute("href"); // Obtiene la URL de la página a cargar
            // Obtenemos los valores actuales de búsqueda y categoría para persistirlos
            const currentCategory = hiddenCategoryInput.value;
            const currentSearchTerm = searchInput.value;
            // Cargar la nueva página con AJAX, manteniendo los filtros actuales
            loadProducts(currentCategory, currentSearchTerm, pageUrl);
        }
        // Delegación: un solo listener en el contenedor
        //arregla el click del paginador y evita re-adjuntar listeners (delegación)
        if (paginationContainer) {
            paginationContainer.addEventListener("click", function(e) {
                const a = e.target.closest('a[href*="page="]');
                if (!a) return;
                e.preventDefault();

                const currentCategory = hiddenCategoryInput.value;
                const currentSearchTerm = searchInput.value.trim();

                // Mezcla la URL del link con los filtros actuales por si el backend no los trae
                const u = new URL(a.href, window.location.origin);
                if (currentCategory && currentCategory !== "all")
                    u.searchParams.set("categoria", currentCategory);
                if (currentSearchTerm) u.searchParams.set("search", currentSearchTerm);

                loadProducts(currentCategory, currentSearchTerm, u.toString());
                // (Opcional) Mantener el scroll cerca del listado, no arriba
                const top = document.querySelector(".products-section")?.offsetTop ?? 0;
                window.scrollTo({
                    top,
                    behavior: "smooth",
                });
            });
        }

        // Arregla loadProducts para construir bien la URL cuando NO viene de un link
        async function loadProducts(category = "all", searchTerm = "", pageUrl = null) {
            productsContainer.innerHTML = `
        <div class="loading"><div class="spinner"></div> Cargando productos...</div>
        `;
            searchResultsInfo.style.display = "none";

            let url;
            if (pageUrl) {
                url = new URL(pageUrl, window.location.origin);
            } else {
                url = new URL("{{ route('producto') }}", window.location.origin);
                if (category && category !== "all")
                    url.searchParams.set("categoria", category);
                if (searchTerm) url.searchParams.set("search", searchTerm);
            }

            try {
                const response = await fetch(url.toString(), {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                    },
                });
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                const data = await response.json();

                productsContainer.innerHTML = data.html;
                updateSearchResultsInfo(data.productCount, searchTerm, category);
                if (paginationContainer)
                    paginationContainer.innerHTML = data.pagination;

                // (Opcional) Actualiza la barra de direcciones (sin recargar)
                history.replaceState({}, "", url.toString());
            } catch (err) {
                console.error(err);
                productsContainer.innerHTML = `
            <div class="empty-state">
            <i class="fas fa-exclamation-triangle" style="color:#dc3545;"></i>
            <h3>Error al cargar productos</h3>
            <p>Por favor, inténtalo de nuevo más tarde.</p>
            </div>`;
                searchResultsInfo.style.display = "none";
                if (paginationContainer) paginationContainer.innerHTML = "";
            }
        }

        const debounce = (fn, ms = 350) => {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), ms);
            };
        };

        searchInput.addEventListener(
            "input",
            debounce((e) => {
                const term = e.target.value.trim();
                term
                    ?
                    clearSearchButton.classList.add("visible") :
                    clearSearchButton.classList.remove("visible");
                loadProducts(hiddenCategoryInput.value, term);
            })
        );

        clearSearchButton.addEventListener("click", () => {
            searchInput.value = "";
            clearSearchButton.classList.remove("visible");
            searchInput.focus();
            loadProducts(hiddenCategoryInput.value, "");
        });

        /**
         * Actualiza el mensaje de información de resultados de búsqueda.
         * @param {number} count - Número total de productos.
         * @param {string} term - Término de búsqueda actual.
         * @param {string} category - Categoría actual.
         */
        function updateSearchResultsInfo(count, term, category) {
            let message = "";
            if (term && category !== "all") {
                message = `Se encontraron ${count} producto(s) que contienen "${term}" en la categoría "${category}"`;
            } else if (term) {
                message = `Se encontraron ${count} producto(s) que contienen "${term}"`;
            } else if (category !== "all") {
                message = `Mostrando ${count} producto(s) de la categoría "${category}"`;
            } else {
                message = `Se encontraron ${count} producto(s) en total.`;
            }
            searchResultsInfo.innerHTML = message;
            searchResultsInfo.style.display = "block";

            if (count === 0 && (term || category !== "all")) {
                // Si no hay resultados y hay filtros/búsqueda, mostrar el estado vacío
                productsContainer.innerHTML = `
                <div class="empty-state">
                    <i class="${
                        term ? "fas fa-search-minus" : "fas fa-box-open"
                    }" style="color: #ccc;"></i>
                    <h3>${
                        term
                            ? `No hay productos que coincidan con "${term}"`
                            : `No hay productos en la categoría "${category}"`
                    }</h3>
                    <p>Intenta con otros términos de búsqueda o categorías</p>
                </div>
            `;
                searchResultsInfo.style.display = "none"; // Ocultar el mensaje si el estado vacío ya explica
            }
        }

        // --- Lógica Existente para Búsqueda y Filtros ---

        // Mantiene el botón de limpiar visible si hay término de búsqueda inicial
        if (searchInput.value.trim() !== "") {
            clearSearchButton.classList.add("visible");
        }

        searchInput.addEventListener("input", (e) => {
            if (e.target.value.trim()) {
                clearSearchButton.classList.add("visible");
            } else {
                clearSearchButton.classList.remove("visible");
            }
            // En lugar de submit, ahora llamamos a loadProducts para manejarlo con AJAX
            // Esto permite ver los resultados en tiempo real mientras el usuario escribe
            loadProducts(hiddenCategoryInput.value, e.target.value.trim());
        });

        clearSearchButton.addEventListener("click", () => {
            searchInput.value = "";
            clearSearchButton.classList.remove("visible");
            searchInput.focus();
            // Cargar productos sin término de búsqueda
            loadProducts(hiddenCategoryInput.value, "");
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && searchInput.value.trim()) {
                searchInput.value = "";
                clearSearchButton.classList.remove("visible");
                // Cargar productos sin término de búsqueda
                loadProducts(hiddenCategoryInput.value, "");
            }
        });

        document.querySelectorAll(".filter-item a").forEach((link) => {
            link.addEventListener("click", (e) => {
                e.preventDefault();
                const category = e.currentTarget.dataset.category;
                hiddenCategoryInput.value = category; // Actualiza el campo oculto
                document
                    .querySelectorAll(".filter-item")
                    .forEach((f) => f.classList.remove("active"));
                e.currentTarget.closest(".filter-item").classList.add("active");

                // Cargar productos con la nueva categoría y el término de búsqueda actual
                loadProducts(category, searchInput.value);
            });
        });

        // --- Funciones del Carrito ---

        /**
         * Abre el modal de SweetAlert2 con los detalles del producto y la opción de cantidad.
         * @param {number} productId - El ID del producto.
         */
        async function showProductModal(productId) {
            try {
                const url = `{{ url('productos') }}/${productId}/details`;
                const response = await fetch(url);
                //const url = `{{ route('productos.details', ['id' => 'ID']) }}`.replace('ID', productId);

                //const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const product = await response.json(); // Asume que la ruta devuelve JSON

                Swal.fire({
                    title: product.nombre,
                    html: `<div style="text-align: left; margin: 1rem 0;">
                <img src="${product.imagen}" alt="${product.nombre}" style="display: block; margin: 0 auto 1rem; width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 10px;">
                <p style="color: #666; margin-bottom: 0.5rem;">${product.descripcion || "Sin descripción."}</p>
                <div style="color: #ffc107; margin-bottom: 0.5rem;">${"⭐".repeat(product.rating || 0)}</div>
                <h4 style="color: #4CAF50; font-size: 1.2rem; margin-bottom: 1rem;">$${parseFloat(product.valor.replace("$", "").replace(".", "")).toFixed(0)}</h4>
                <div style="margin-bottom: 1rem;">
                    <label for="quantity" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">
                        Cantidad disponible: ${product.stock ? product.stock : "No se ha encontrado la cantidad precisa"}
                    </label>
                    <input type="number" id="quantity" min="1" max="${product.stock}" value="1"
                    style="width: 100%; padding: 0.5rem; border: 2px solid #ddd; border-radius: 5px; font-size: 1rem;">
                </div>
            </div>`,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-cart-plus"></i> Añadir al carrito',
                    cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
                    focusConfirm: false, // Evita que se auto-enfoque en el botón y se cierre con Enter
                    didOpen: () => {
                        // Asegurarse de que el input de cantidad esté enfocado para el usuario
                        document.getElementById("quantity").focus();
                    },
                    preConfirm: () => {
                        const quantity = document.getElementById("quantity").value;
                        if (!quantity || parseInt(quantity) < 1) {
                            Swal.showValidationMessage(
                                "Por favor, introduce una cantidad válida"
                            );
                            return false;
                        }
                        if (!quantity || parseInt(quantity) > product.stock) {
                            Swal.showValidationMessage(
                                `La cantidad máxima disponible es ${product.stock}`
                            );
                            return false;
                        }
                        return parseInt(quantity);
                    },
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        await addToCart(product.id, result.value);
                    }
                });
            } catch (error) {
                console.error("Error al cargar detalles del producto:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "No pudimos cargar los detalles del producto.",
                });
            }
        }

        /**
         * Envía una solicitud AJAX para añadir un producto al carrito.
         * @param {number} productId - El ID del producto.
         * @param {number} quantity - La cantidad a añadir.
         */
        async function addToCart(productId, quantity) {
            try {
                const response = await fetch('{{ route("api.carrito.add") }}', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                    },
                    body: JSON.stringify({
                        producto_id: productId,
                        cantidad: quantity,
                    }),
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || "Error al añadir el producto al carrito."
                    );
                }

                // Actualizar el contador del carrito en la barra de navegación
                updateCartCount(data.cart_count);

                Swal.fire({
                    title: "¡Producto añadido!",
                    text: `${quantity} unidad(es) añadida(s) al carrito`,
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-shopping-cart"></i> Ver carrito',
                    cancelButtonText: '<i class="fas fa-shopping-bag"></i> Seguir comprando',
                    timer: 3000,
                    timerProgressBar: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("carrito.index") }}'; // Redirige a la vista del carrito
                    }
                });
            } catch (error) {
                console.error("Error al añadir al carrito:", error);
                Swal.fire({
                    title: "Error",
                    text: error.message || "No se pudo añadir el producto al carrito.",
                    icon: "error",
                });
            }
        }

        /**
         * Actualiza el contador visible del carrito en la interfaz.
         * @param {number} count - El número total de ítems en el carrito.
         */
        function updateCartCount(count) {
            const cartCountElement = document.querySelector(
                '.nav-actions a[href="/carrito"] .cart-count'
            );
            if (cartCountElement) {
                cartCountElement.textContent = count;
            }
        }

        // --- Inicialización al Cargar la Página ---
        document.addEventListener("DOMContentLoaded", async () => {
            // Inicializar el conteo del carrito
            try {
                const response = await fetch('{{ route("api.carrito.count") }}');
                if (response.ok) {
                    const data = await response.json();
                    updateCartCount(data.cart_count);
                }
            } catch (error) {
                console.error("Error al obtener el conteo del carrito:", error);
            }

            // --- Carga inicial de productos y configuración de paginación ---
            // Si la página se carga con parámetros iniciales de categoría o búsqueda,
            // necesitamos que loadProducts los recoja. Si no hay parámetros, cargará la primera página.
            const initialCategory = hiddenCategoryInput.value || "all";
            const initialSearchTerm = searchInput.value || "";
            loadProducts(initialCategory, initialSearchTerm); // Carga la primera página con los filtros iniciales

            // También adjuntar los eventos de paginación para la paginación inicial del servidor
            // Esto se ejecutará si la primera carga del servidor ya incluye enlaces de paginación
            attachPaginationEvents();

            // Lógica de visualización del botón de limpiar búsqueda
            if (searchInput.value.trim() !== "") {
                clearSearchButton.classList.add("visible");
            } else {
                clearSearchButton.classList.remove("visible");
            }
        });

        // Haz la función showProductModal global si la estás llamando desde el HTML directamente (onclick)
        window.showProductModal = showProductModal;
    </script>
</body>