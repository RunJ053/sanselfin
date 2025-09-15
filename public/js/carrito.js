document.addEventListener("DOMContentLoaded", () => {
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    document.querySelectorAll(".btn-update").forEach((btn) => {
        btn.addEventListener("click", async () => {
            let itemId = btn.dataset.id;
            let cantidad = document.querySelector(
                `.cantidad-input[data-id="${itemId}"]`
            ).value;

            try {
                let url = window.routes.update.replace(':id', itemId);
                let response = await fetch(url, {
                    method: "PATCH",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                    },
                    body: JSON.stringify({ cantidad }),
                });

                let data = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: "success",
                        title: "Cantidad actualizada",
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(() => {
                        location.reload();
                    });
                } else if (response.status === 422) {
                    // ❌ Cuando sobrepasa stock o cantidad inválida
                    Swal.fire({
                        icon: "warning",
                        title: "Cantidad inválida",
                        text: data.message,
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data.message || "Ocurrió un error inesperado",
                    });
                }
            } catch (error) {
                console.error("Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ocurrió un error inesperado",
                });
            }
        });
    });

    // 🔹 Eliminar producto
    document.querySelectorAll(".btn-remove").forEach((btn) => {
        btn.addEventListener("click", async () => {
            let itemId = btn.dataset.id;

            Swal.fire({
                title: "¿Estás seguro?",
                text: "El producto se eliminará del carrito.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        let url = window.routes.remove.replace(':id', itemId);
                        let response = await fetch(url, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": token,
                            },
                        });

                        let data = await response.json();
                        if (response.ok) {
                            Swal.fire({
                                icon: "success",
                                title: "Eliminado",
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false,
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.message,
                            });
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Ocurrió un error inesperado",
                        });
                    }
                }
            });
        });
    });
});

// Animaciones adicionales
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -100px 0px",
};

const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
        }
    });
}, observerOptions);

document.querySelectorAll(".group").forEach((el) => {
    el.style.opacity = "0";
    el.style.transform = "translateY(20px)";
    el.style.transition = "all 0.6s ease-out";
    observer.observe(el);
});