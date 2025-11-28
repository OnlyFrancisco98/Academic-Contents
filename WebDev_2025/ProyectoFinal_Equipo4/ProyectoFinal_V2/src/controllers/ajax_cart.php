<?php
// controllers/ajax_cart.php
session_start();
require_once '../config/conexion.php'; // Tu archivo de conexión PDO

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'No logueado', 'items' => []]);
    exit;
}

$user_id = $_SESSION['usuario_id'];
$action = $_GET['action'] ?? '';

try {
    // 1. Verificar/Crear Carrito para el usuario
    $stmt = $pdo->prepare("SELECT id FROM carts WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cart) {
        $pdo->prepare("INSERT INTO carts (user_id, created_at) VALUES (?, NOW())")->execute([$user_id]);
        $cart_id = $pdo->lastInsertId();
    } else {
        $cart_id = $cart['id'];
    }

    // --- ACCIÓN: OBTENER CARRITO ---
    if ($action === 'get') {
        // Unimos cart_items con products y product_images
        $sql = "SELECT ci.quantity, p.id as product_id, p.name, p.price, pi.image_path 
                FROM cart_items ci
                JOIN products p ON ci.product_id = p.id
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = true
                WHERE ci.cart_id = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cart_id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode(['status' => 'success', 'items' => $items]);
    }

    // --- ACCIÓN: AGREGAR PRODUCTO ---
    if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $pid = $_POST['product_id'];
        $qty = $_POST['quantity'] ?? 1;

        // Verificar si ya existe en el carrito
        $check = $pdo->prepare("SELECT id, quantity FROM cart_items WHERE cart_id = ? AND product_id = ?");
        $check->execute([$cart_id, $pid]);
        $exists = $check->fetch();

        if ($exists) {
            $pdo->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE id = ?")->execute([$qty, $exists['id']]);
        } else {
            $pdo->prepare("INSERT INTO cart_items (cart_id, product_id, quantity, added_at) VALUES (?, ?, ?, NOW())")->execute([$cart_id, $pid, $qty]);
        }
        echo json_encode(['status' => 'success']);
    }

    // --- ACCIÓN: ELIMINAR PRODUCTO ---
    if ($action === 'remove' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $pid = $_POST['product_id'];
        $pdo->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?")->execute([$cart_id, $pid]);
        echo json_encode(['status' => 'success']);
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>