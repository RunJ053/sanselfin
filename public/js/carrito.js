class Producto {
    constructor(id, nombre, precio, imagen, descripcion) {
        this.id = id;
        this.nombre = nombre;
        this.precio = precio;
        this.imagen = imagen;
        this.descripcion = descripcion;
        this.cantidad = 0;
    }
}

class Carrito {
    constructor() {
        this.productos = [];
        this.descuentos = {
            'VERANO2024': 0.1,
            'FRESH': 0.15,
            'VERDE10': 0.10
        };
        this.descuentoAplicado = 0;
    }

    agregarProducto(producto) {
        const existe = this.productos.find(p => p.id === producto.id);
        if (existe) {
            existe.cantidad++;
        } else {
            producto.cantidad = 1;
            this.productos.push(producto);
        }
        this.actualizarCarrito();
    }

    eliminarProducto(id) {
        const index = this.productos.findIndex(p => p.id === id);
        if (index !== -1) {
            this.productos[index].cantidad--;
            if (this.productos[index].cantidad === 0) {
                this.productos.splice(index, 1);
            }
        }
        this.actualizarCarrito();
    }

    calcularTotal() {
        const subtotal = this.productos.reduce((total, p) => total + (p.precio * p.cantidad), 0);
        return subtotal * (1 - this.descuentoAplicado);
    }

    aplicarDescuento(codigo) {
        if (this.descuentos[codigo]) {
            this.descuentoAplicado = this.descuentos[codigo];
            this.actualizarCarrito();
            return true;
        }
        return false;
    }

    actualizarCarrito() {
        const listaItems = document.getElementById('items-carrito');
        const totalElemento = document.getElementById('total-compra');
        
        listaItems.innerHTML = this.productos.map(p => 
            `<div class="item-carrito">
                <img src="${p.imagen}" alt="${p.nombre}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                <div style="flex-grow: 1;">
                    <strong>${p.nombre}</strong>
                    <div>COP ${p.precio.toFixed(2)} x ${p.cantidad}</div>
                </div>
                <div>
                    <button onclick="carrito.eliminarProducto(${p.id})">-</button>
                </div>
            </div>`
        ).join('');

        totalElemento.textContent = `COP ${this.calcularTotal().toFixed(2)}`;
    }
}

const carrito = new Carrito();

const productos = [
    new Producto(1, 'Tomates', 2.50, '../img/product/Tomate.png', 'Tomates orgánicos frescos'),
    new Producto(2, 'Zanahorias', 1.80, '../img/product/zha.jfif', 'Zanahorias de agricultura local'),
    new Producto(3, 'Espinacas', 3.20, '../img/product/Espinaca (2).png', 'Espinacas de cultivo ecológico'),
    new Producto(4, 'Manzanas', 2.75, '../img/product/Manzana roja.png', 'Manzanas rojas deliciosas')
];

function renderizarProductos() {
    const contenedor = document.getElementById('lista-productos');
    contenedor.innerHTML = productos.map(p => 
        `<div class="producto">
            <img src="${p.imagen}" alt="${p.nombre}">
            <h3>${p.nombre}</h3>
            <p>${p.descripcion}</p>
            <p>COP ${p.precio.toFixed(2)}</p>
            <button onclick="carrito.agregarProducto(productos[${p.id-1}])">Añadir</button>
        </div>`
    ).join('');
}

function aplicarDescuento() {
    const codigo = document.getElementById('codigo-descuento').value;
    if (carrito.aplicarDescuento(codigo)) {
        alert('¡Descuento aplicado con éxito!');
    } else {
        alert('Código de descuento inválido');
    }
}

renderizarProductos();