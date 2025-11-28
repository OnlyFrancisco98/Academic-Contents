<?php
// src/pages/detalle_producto.php
require_once '../../config/conexion.php';
require '../templates/header.php';

// 1. Validar ID
if (!isset($_GET['id'])) {
    echo "<script>window.location='catalogo.php';</script>";
    exit;
}
$id = (int)$_GET['id'];

try {
    // 2. Obtener info del producto
    $sql = "SELECT p.*, pi.image_path 
            FROM products p 
            LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = true 
            WHERE p.id = :id AND p.is_deleted = false";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo "<div class='container p-5'><h2>Producto no encontrado</h2></div>";
        require '../templates/footer.php';
        exit;
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<div class="container my-5">
    <a href="productos.php" class="text-decoration-none text-muted mb-4 d-inline-block">&larr; Volver al catálogo</a>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0">
                <img src="<?php echo !empty($producto['image_path']) ? htmlspecialchars($producto['image_path']) : 'https://via.placeholder.com/600'; ?>" 
                     class="img-fluid rounded shadow-sm" 
                     alt="<?php echo htmlspecialchars($producto['name']); ?>"
                     style="width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="display-5 fw-bold mb-3"><?php echo htmlspecialchars($producto['name']); ?></h1>
            
            <h3 class="text-primary mb-4">$<?php echo number_format($producto['price'], 2); ?> MXN</h3>

            <div class="mb-4">
                <p class="text-muted" style="line-height: 1.8;">
                    <?php echo nl2br(htmlspecialchars($producto['description'])); ?>
                </p>
                <ul class="text-muted small">
                    <li>100% Calidad Garantizada</li>
                    <li>Envío calculado al finalizar compra</li>
                    <li>Stock disponible: <?php echo $producto['stock']; ?> unidades</li>
                </ul>
            </div>

            <div class="p-4 bg-light rounded-3">
                <div class="mb-3">
                    <label for="cantidad" class="form-label fw-bold">Cantidad</label>
                    <div class="input-group" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="btn-minus">-</button>
                        <input type="number" class="form-control text-center" id="cantidad" value="1" min="1" max="<?php echo $producto['stock']; ?>">
                        <button class="btn btn-outline-secondary" type="button" id="btn-plus">+</button>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-dark btn-lg" id="btn-agregar-detalle" data-id="<?php echo $producto['id']; ?>">
                        AGREGAR AL CARRITO
                    </button>
                    
                    <button class="btn btn-primary btn-lg" id="btn-comprar-ahora" data-id="<?php echo $producto['id']; ?>" style="background-color: #5a31f4; border:none;">
                        COMPRAR AHORA
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    
    // 1. Lógica de botones +/-
    const stockMax = <?php echo $producto['stock']; ?>;
    
    $('#btn-plus').click(function() {
        let val = parseInt($('#cantidad').val());
        if(val < stockMax) {
            $('#cantidad').val(val + 1);
        }
    });

    $('#btn-minus').click(function() {
        let val = parseInt($('#cantidad').val());
        if(val > 1) {
            $('#cantidad').val(val - 1);
        }
    });

    // 2. Lógica de Agregar al Carrito (AJAX)
    $('#btn-agregar-detalle').click(function() {
        let pid = $(this).data('id');
        let qty = $('#cantidad').val();
        let btn = $(this);

        // Animación de carga
        let originalText = btn.text();
        btn.prop('disabled', true).text('Agregando...');

        $.ajax({
            url: '../../controllers/ajax_cart.php?action=add',
            method: 'POST',
            data: { 
                product_id: pid, 
                quantity: qty 
            },
            success: function(response) {
                // Actualizar el carrito del header
                if(typeof cargarCarrito === 'function') {
                    cargarCarrito();
                }
                
                // Abrir el panel lateral automáticamente
                var myOffcanvas = document.getElementById('carritoLateral');
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
                bsOffcanvas.show();
            },
            error: function() {
                alert('Error al agregar. Asegúrate de haber iniciado sesión.');
            },
            complete: function() {
                btn.prop('disabled', false).text(originalText);
            }
        });
    });

    $('#btn-comprar-ahora').click(function() {
        let pid = $(this).data('id');
        let qty = $('#cantidad').val();
        let btn = $(this);

        // Feedback visual
        let textoOriginal = btn.text();
        btn.prop('disabled', true).text('Procesando...');

        $.ajax({
            url: '../../controllers/ajax_cart.php?action=add',
            method: 'POST',
            data: { 
                product_id: pid, 
                quantity: qty 
            },
            success: function(response) {
                // Verificamos si hubo error de sesión
                if(response.status === 'error' && response.message === 'No logueado') {
                    window.location.href = '../autentificacion/login.php';
                    return;
                }

                // SI TODO SALIÓ BIEN: Redirigir al Checkout inmediatamente
                window.location.href = 'checkout.php';
            },
            error: function() {
                alert('Ocurrió un error al procesar la solicitud.');
                btn.prop('disabled', false).text(textoOriginal);
            }
        });
    });
});
</script>

<?php require '../templates/footer.php'; ?>