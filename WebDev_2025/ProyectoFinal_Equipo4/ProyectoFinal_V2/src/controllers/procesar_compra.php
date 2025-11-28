<?php
// controllers/procesar_compra.php
session_start();
require_once '../config/conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$user_id = $_SESSION['usuario_id'];

// 1. Construir la dirección completa como string
$direccion = $_POST['calle'] . " #" . $_POST['num_ext'];
if(!empty($_POST['num_int'])) $direccion .= " Int " . $_POST['num_int'];
$direccion .= ", Col. " . $_POST['colonia'];
$direccion .= ", " . $_POST['ciudad'] . ", " . $_POST['estado'];
$direccion .= ". CP: " . $_POST['cp'];

$metodo_pago = $_POST['metodo_pago'];

try {
    // INICIAR TRANSACCIÓN
    $pdo->beginTransaction();

    // 2. Obtener items del carrito (con stock actual para validar)
    $sqlCart = "SELECT ci.id as cart_item_id, ci.product_id, ci.quantity, p.price, p.stock 
                FROM cart_items ci
                JOIN products p ON ci.product_id = p.id
                JOIN carts c ON ci.cart_id = c.id
                WHERE c.user_id = ?";
    $stmtCart = $pdo->prepare($sqlCart);
    $stmtCart->execute([$user_id]);
    $items = $stmtCart->fetchAll(PDO::FETCH_ASSOC);

    if (empty($items)) {
        throw new Exception("El carrito está vacío.");
    }

    $total = 0;

    // 3. Crear la Orden (Tabla 'orders')
    // Nota: Agrego 'metodo_pago' si tienes la columna, si no, quítalo.
    // 'status' inicial = 'completed' o 'pending'
    $sqlOrder = "INSERT INTO orders (user_id, total, status, address, created_at) 
                 VALUES (:uid, 0, 'pending', :addr, NOW())"; // Ponemos 0 temporalmente
    $stmtOrder = $pdo->prepare($sqlOrder);
    $stmtOrder->execute([':uid' => $user_id, ':addr' => $direccion]);
    $order_id = $pdo->lastInsertId();

    // 4. Procesar Items
    foreach ($items as $item) {
        // Validar Stock
        if ($item['quantity'] > $item['stock']) {
            throw new Exception("No hay suficiente stock para el producto ID: " . $item['product_id']);
        }

        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;

        // Insertar en 'order_items'
        $sqlItem = "INSERT INTO order_items (order_id, product_id, quantity, unit_price) 
                    VALUES (?, ?, ?, ?)";
        $pdo->prepare($sqlItem)->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);

        // Restar Stock en 'products'
        $sqlUpdateStock = "UPDATE products SET stock = stock - ? WHERE id = ?";
        $pdo->prepare($sqlUpdateStock)->execute([$item['quantity'], $item['product_id']]);
    }

    // 5. Actualizar total de la orden
    $pdo->prepare("UPDATE orders SET total = ? WHERE id = ?")->execute([$total, $order_id]);

    // 6. Vaciar Carrito (Borrar items del carrito de este usuario)
    // Primero obtenemos el cart_id
    $cart_id_stmt = $pdo->prepare("SELECT id FROM carts WHERE user_id = ?");
    $cart_id_stmt->execute([$user_id]);
    $cart_id_row = $cart_id_stmt->fetch();
    
    if($cart_id_row) {
        $pdo->prepare("DELETE FROM cart_items WHERE cart_id = ?")->execute([$cart_id_row['id']]);
    }

    // CONFIRMAR TRANSACCIÓN
    $pdo->commit();

    // Redirigir a éxito o mis pedidos
    $_SESSION['mensaje_exito'] = "¡Compra realizada con éxito!";
    header("Location: ../views/pages/pedidos.php");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    die("Error al procesar la compra: " . $e->getMessage());
}
?>