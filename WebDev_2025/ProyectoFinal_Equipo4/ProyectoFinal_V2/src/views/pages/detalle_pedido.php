<?php
// src/views/pages/detalle_pedido.php
session_start();

// AJUSTA ESTAS RUTAS SI ES NECESARIO (Basado en que estás en src/views/pages/)
require_once '../../config/conexion.php'; 
require_once '../templates/header.php';

// 1. Validar que el usuario esté logueado y haya un ID en la URL
if (!isset($_SESSION['usuario_id']) || !isset($_GET['id'])) {
    // Si falta algo, redirigimos a la lista de pedidos
    echo "<script>window.location='pedidos.php';</script>";
    exit;
}

$pedido_id = (int)$_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

try {
    // 2. Obtener Info General del Pedido
    // VALIDACIÓN DE SEGURIDAD: AND user_id = :uid asegura que no veas pedidos ajenos
    $sqlOrder = "SELECT * FROM orders WHERE id = :id AND user_id = :uid";
    $stmt = $pdo->prepare($sqlOrder);
    $stmt->execute([':id' => $pedido_id, ':uid' => $usuario_id]);
    $orden = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$orden) {
        echo "<div class='container p-5 text-center'>
                <h3>No se encontró el pedido o no tienes permiso.</h3>
                <a href='pedidos.php' class='btn btn-dark mt-3'>Volver a Mis Pedidos</a>
              </div>";
        require '../templates/footer.php';
        exit;
    }

    // 3. Obtener los Productos (Items) del Pedido
    $sqlItems = "SELECT oi.quantity, oi.unit_price, p.name, pi.image_path 
                 FROM order_items oi
                 JOIN products p ON oi.product_id = p.id
                 LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = true
                 WHERE oi.order_id = :oid";
    $stmtItems = $pdo->prepare($sqlItems);
    $stmtItems->execute([':oid' => $pedido_id]);
    $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error de BD: " . $e->getMessage());
}

// Lógica de colores para el estado
$badgeColor = match($orden['status']) {
    'completed', 'entregado' => 'success',
    'pending', 'pendiente'   => 'warning',
    'cancelled', 'cancelado' => 'danger',
    default => 'secondary'
};
?>

<div class="container my-5">
    <div class="mb-4">
        <a href="pedidos.php" class="text-decoration-none text-muted">&larr; Volver a Mis Pedidos</a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 text-primary">Contenido del Pedido</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="padding-left: 20px;">Producto</th>
                                    <th class="text-center">Cant.</th>
                                    <th class="text-end">Precio</th>
                                    <th class="text-end" style="padding-right: 20px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): 
                                    $subtotal = $item['quantity'] * $item['unit_price'];
                                ?>
                                <tr>
                                    <td style="padding-left: 20px;">
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo !empty($item['image_path']) ? htmlspecialchars($item['image_path']) : 'https://via.placeholder.com/60'; ?>" 
                                                 class="rounded border me-3" 
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <span class="fw-bold d-block text-dark"><?php echo htmlspecialchars($item['name']); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo $item['quantity']; ?></td>
                                    <td class="text-end text-muted">$<?php echo number_format($item['unit_price'], 2); ?></td>
                                    <td class="text-end fw-bold" style="padding-right: 20px;">$<?php echo number_format($subtotal, 2); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 fw-bold">Resumen #<?php echo $orden['id']; ?></h5>
                    
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Estado:</span>
                            <span class="badge bg-<?php echo $badgeColor; ?>"><?php echo strtoupper($orden['status']); ?></span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Fecha:</span>
                            <span><?php echo date("d/m/Y", strtotime($orden['created_at'])); ?></span>
                        </li>
                        <li class="mt-3">
                            <span class="text-muted d-block mb-1">Dirección de entrega:</span>
                            <small class="fw-bold d-block p-2 bg-white rounded border">
                                <?php echo htmlspecialchars($orden['address']); ?>
                            </small>
                        </li>
                    </ul>

                    <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0">Total Pagado</span>
                        <span class="h3 mb-0 text-primary fw-bold">$<?php echo number_format($orden['total'], 2); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../templates/footer.php'; ?>