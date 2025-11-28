<?php
// pages/checkout.php
session_start();
require_once '../../config/conexion.php';
require '../templates/header.php'; // Tu header modificado

if (!isset($_SESSION['usuario_id'])) {
    echo "<script>window.location='../autentificacion/login.php';</script>";
    exit;
}

$user_id = $_SESSION['usuario_id'];

// Obtener items del carrito para mostrar resumen
// Nota: Deberías encapsular esta query en una función, pero por rapidez la pongo aquí
$sql = "SELECT ci.quantity, p.name, p.price, (p.price * ci.quantity) as subtotal 
        FROM cart_items ci
        JOIN products p ON ci.product_id = p.id
        JOIN carts c ON ci.cart_id = c.id
        WHERE c.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_global = 0;
foreach($items as $i) $total_global += $i['subtotal'];

if (empty($items)) {
    echo "<div class='container p-5'><h3>Tu carrito está vacío</h3></div>";
    require '../templates/footer.php';
    exit;
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-7">
            <h3 class="mb-4">Información de Envío</h3>
            <form action="../../controllers/procesar_compra.php" method="POST" id="checkoutForm">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label">Calle</label>
                        <input type="text" class="form-control" name="calle" required>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label">Num. Exterior</label>
                        <input type="text" class="form-control" name="num_ext" required>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label">Num. Interior</label>
                        <input type="text" class="form-control" name="num_int">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Colonia</label>
                        <input type="text" class="form-control" name="colonia" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="estado" required>
                            <option value="">Seleccionar...</option>
                            <option value="CDMX">CDMX</option>
                            <option value="Yucatan">Yucatán</option>
                            <option value="Jalisco">Jalisco</option>
                            </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">CP</label>
                        <input type="text" class="form-control" name="cp" required>
                    </div>
                </div>

                <hr class="my-4">

                <h4 class="mb-3">Método de Pago</h4>
                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="metodo_pago" type="radio" class="form-check-input" value="Tarjeta" checked required>
                        <label class="form-check-label" for="credit">Tarjeta de Crédito / Débito</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="metodo_pago" type="radio" class="form-check-input" value="PayPal">
                        <label class="form-check-label" for="paypal">PayPal</label>
                    </div>
                    <div class="form-check">
                        <input id="oxxo" name="metodo_pago" type="radio" class="form-check-input" value="Oxxo">
                        <label class="form-check-label" for="oxxo">Pago en Oxxo</label>
                    </div>
                </div>

                <hr class="my-4">
                <button class="w-100 btn btn-primary btn-lg" type="submit">Pagar $<?php echo number_format($total_global, 2); ?></button>
            </form>
        </div>

        <div class="col-md-5">
            <div class="p-4 bg-light rounded-3 shadow-sm">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Tu Orden</span>
                    <span class="badge bg-primary rounded-pill"><?php echo count($items); ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php foreach($items as $item): ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?php echo htmlspecialchars($item['name']); ?></h6>
                            <small class="text-muted">Cantidad: <?php echo $item['quantity']; ?></small>
                        </div>
                        <span class="text-muted">$<?php echo number_format($item['subtotal'], 2); ?></span>
                    </li>
                    <?php endforeach; ?>
                    
                    <li class="list-group-item d-flex justify-content-between bg-white fw-bold">
                        <span>Total (MXN)</span>
                        <span>$<?php echo number_format($total_global, 2); ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require '../templates/footer.php'; ?>