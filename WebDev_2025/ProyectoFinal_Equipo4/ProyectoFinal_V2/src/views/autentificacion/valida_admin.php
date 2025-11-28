<?php
session_start();
require_once '../../config/conexion.php';

// 1. Recibimos username en lugar de email
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? ''; 

try {
    // 2. Buscamos en la BD coincidencia por USERNAME
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :user");
    $stmt->execute([':user' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    /* 3. VALIDACIÓN:
       - Que el usuario exista ($user)
       - Que la contraseña coincida con 'password_hash' (Asumimos comparación directa según tu contexto anterior)
       - Que el role_id sea 1 (Administrador)
    */
    if ($user && $user['password_hash'] === $password && $user['role_id'] == 1) {
        
        // Guardamos datos en sesión
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['nombre']     = $user['full_name']; // O usar $user['username'] si prefieres
        $_SESSION['rol']        = $user['role_id'];
        $_SESSION['correo']     = $user['email']; // Opcional, por si lo necesitas luego

        // Redirección al index (que mostrará el botón de Admin en el footer)
        header("Location: ../pages/index.php");
        exit;

    } else {
        // Si falla algo (usuario no existe, pass incorrecta o no es admin)
        echo "<script>
                alert('Usuario incorrecto o no tienes permisos de administrador.'); 
                window.location='login_admin.php';
              </script>";
    }

} catch (PDOException $e) {
    die("Error en el sistema: " . $e->getMessage());
}
?>