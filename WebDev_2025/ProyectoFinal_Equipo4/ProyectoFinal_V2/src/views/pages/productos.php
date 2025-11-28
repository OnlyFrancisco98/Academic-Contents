<?php
// src/pages/productos.php
require_once '../../config/conexion.php';
require '../templates/header.php';

// 1. Obtener la categoría de la URL (si existe)
// Ejemplo de uso: productos.php?cat=1
$categoria_id = isset($_GET['cat']) ? (int)$_GET['cat'] : null;
$titulo_pagina = "Todos los Productos";

try {
    if ($categoria_id) {
        // A) Si hay categoría, filtramos
        $sql = "SELECT p.*, pi.image_path 
                FROM products p 
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = true 
                WHERE p.category_id = :cat AND p.is_deleted = false";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':cat' => $categoria_id]);
        
        // Obtener nombre de la categoría para el título
        $stmtCat = $pdo->prepare("SELECT name FROM categories WHERE id = :cat");
        $stmtCat->execute([':cat' => $categoria_id]);
        $catData = $stmtCat->fetch(PDO::FETCH_ASSOC);
        if($catData) $titulo_pagina = "Colección: " . $catData['name'];
        
    } else {
        // B) Si no hay categoría, mostramos todo
        $sql = "SELECT p.*, pi.image_path 
                FROM products p 
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = true 
                WHERE p.is_deleted = false";
        $stmt = $pdo->query($sql);
    }
    
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold"><?php echo htmlspecialchars($titulo_pagina); ?></h1>
        <p class="lead text-muted">Explora nuestros productos exclusivos.</p>
        <a href="catalogo.php" class="btn btn-outline-secondary btn-sm">← Volver a Categorías</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if (empty($productos)): ?>
            <div class="col-12 text-center">
                <div class="alert alert-warning">No hay productos disponibles en esta categoría.</div>
            </div>
        <?php else: ?>
            <?php foreach ($productos as $prod): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <a href="detalle_producto.php?id=<?php echo $prod['id']; ?>">
                            <div style="height: 250px; overflow: hidden;" class="position-relative">
                                <img src="<?php echo !empty($prod['image_path']) ? htmlspecialchars($prod['image_path']) : 'https://via.placeholder.com/300'; ?>" 
                                    class="card-img-top w-100 h-100" 
                                    style="object-fit: cover;" 
                                    alt="<?php echo htmlspecialchars($prod['name']); ?>">
                            </div>
                        </a>
                        
                        <div class="card-body d-flex flex-column">
                            <a href="detalle_producto.php?id=<?php echo $prod['id']; ?>" class="text-decoration-none text-dark">
                                <h5 class="card-title"><?php echo htmlspecialchars($prod['name']); ?></h5>
                            </a>

                            <span class="precio-card">
                                $<?php echo number_format($prod['price'], 2); ?> MXN
                            </span>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <button class="btn btn-dark w-100 btn-add-cart" 
                                        data-id="<?php echo $prod['id']; ?>">
                                    Agregar al Carrito
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- SCRIPT NECESARIO PARA QUE EL BOTÓN FUNCIONE -->
<script>
$(document).ready(function() {
    $('.btn-add-cart').click(function() {
        let pid = $(this).data('id');
        let btn = $(this);
        
        // Animación simple de carga
        btn.prop('disabled', true).text('Agregando...');

        $.ajax({
            url: '../../controllers/ajax_cart.php?action=add',
            method: 'POST',
            data: { product_id: pid, quantity: 1 },
            success: function(response) {
                // Si la respuesta es JSON, verifica status
                if(response.status === 'success' || response.status === undefined) {
                    // Recargar el carrito del header (función definida en header.php)
                    if(typeof cargarCarrito === 'function') {
                        cargarCarrito();
                    }
                    // Abrir el offcanvas automáticamente (opcional)
                    let myOffcanvas = document.getElementById('carritoLateral');
                    let bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
                    bsOffcanvas.show();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Error al agregar producto. Revisa si has iniciado sesión.');
            },
            complete: function() {
                btn.prop('disabled', false).text('Agregar +');
            }
        });
    });
});
</script>

<?php require '../templates/footer.php'; ?>