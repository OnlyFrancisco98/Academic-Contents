<?php
    // CORRECCIÓN DEL LOG: Solo iniciar sesión si no hay una activa
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // Definir la ruta base si no está definida
    if (!defined('BASE_URL')) {
        define('BASE_URL', '../../../'); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProyectoFinal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/styles.css">
    
    <style>
        .cart-item-img { width: 60px; height: 60px; object-fit: cover; }
        .cart-total { font-weight: bold; font-size: 1.2rem; }
    </style>
</head>
<body>
    <header id="mi-header">
        <div class="container-fluid p-4">
            <div class="row align-items-center">
                <div class="col-md-4 list-unstyled">
                    <a href="index.php" class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3">INICIO</a>
                    <a href="catalogo.php" class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3">CATÁLOGO</a>
                    <a class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3" href="sobreNosotros.php">SOBRE NOSOTROS</a>

                    </div>

                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <a href="index.php">
                        <img src="<?php echo BASE_URL; ?>public/imagenes/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
                    </a>
                </div>

                <div class="col-md-4 text-end align-items-center">
                    <a class="ms-3 position-relative" href="#" data-bs-toggle="offcanvas" data-bs-target="#carritoLateral">
                        <img src="<?php echo BASE_URL; ?>public/imagenes/ShoppingBag.svg" alt="Carrito" style="width:50px;">
                        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem; display:none;">0</span>
                    </a>

                    <?php
                        if (isset($_SESSION['correo'])) {
                            echo '<a class="ms-4" href="../pages/pedidos.php"><img src="' . BASE_URL . 'public/imagenes/User.svg" alt="Mis Pedidos" style="width:25px;"></a>';
                        } else {
                            echo '<a class="ms-4" href="../autentificacion/login.php"><img src="' . BASE_URL . 'public/imagenes/User.svg" alt="Usuario" style="width:25px;"></a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="carritoLateral" aria-labelledby="carritoLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="carritoLabel">Tu Carrito</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div id="cart-items-container" class="flex-grow-1 overflow-auto mb-3">
                <p class="text-center text-muted">Cargando carrito...</p>
            </div>

            <div class="border-top pt-3">
                <div class="d-flex justify-content-between mb-3">
                    <span class="h5">Total:</span>
                    <span class="h5" id="cart-total-amount">$0.00</span>
                </div>
                <div class="d-grid gap-2">
                    <a href="../pages/checkout.php" id="btn-pagar-carrrito" class="btn btn-dark btn-lg">Realizar Pago</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    // 1. Definimos la función de manera GLOBAL usando window.
    window.cargarCarrito = function() {
        // Usamos una ruta relativa dinámica o fija según te funcionó antes
        // Asegúrate que esta ruta apunte correctamente a tu ajax_cart.php
        const urlController = '<?php echo BASE_URL; ?>src/controllers/ajax_cart.php?action=get';

        $.ajax({
            url: urlController, 
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let html = '';
                let total = 0;
                let count = 0;
                let items = response.items || [];

                if(items.length === 0) {
                    html = '<div class="text-center mt-5"><p>Tu carrito está vacío.</p></div>';
                    $('#btn-pagar-carrito').addClass('disabled'); 
                } else {
                    $('#btn-pagar-carrito').removeClass('disabled');
                    
                    items.forEach(item => {
                        let precio = parseFloat(item.price);
                        let subtotal = precio * item.quantity;
                        total += subtotal;
                        count += item.quantity;

                        // Imagen por defecto si falla
                        let img = item.image_path ? item.image_path : 'https://via.placeholder.com/60';

                        html += `
                            <div class="d-flex mb-3 align-items-center border-bottom pb-2">
                                <img src="${img}" class="cart-item-img rounded me-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-truncate" style="max-width: 150px;">${item.name}</h6>
                                    <small class="text-muted">$${precio.toFixed(2)} x ${item.quantity}</small>
                                </div>
                                <div class="text-end">
                                    <span class="d-block fw-bold">$${subtotal.toFixed(2)}</span>
                                    <button class="btn btn-sm btn-outline-danger remove-item" onclick="eliminarItem(${item.product_id})">&times;</button>
                                </div>
                            </div>
                        `;
                    });
                }

                $('#cart-items-container').html(html);
                $('#cart-total-amount').text('$' + total.toFixed(2));
                
                if(count > 0){
                    $('#cart-count').text(count).show();
                } else {
                    $('#cart-count').hide();
                }
            },
            error: function(xhr, status, error) {
            console.log("Error cargando carrito: " + error);
            }
        });
    };

    // 2. Función global para eliminar items (así evitamos conflictos de eventos)
    window.eliminarItem = function(id) {
        const urlRemove = '<?php echo BASE_URL; ?>src/controllers/ajax_cart.php?action=remove';
        $.ajax({
            url: urlRemove,
            method: 'POST',
            data: { product_id: id },
            success: function() {
                cargarCarrito(); // Recargamos visualmente
            }
        });
    };

    // 3. Ejecutamos la carga inicial cuando el documento esté listo
    $(document).ready(function() {
        cargarCarrito();
    });
    </script>

    <main> 
