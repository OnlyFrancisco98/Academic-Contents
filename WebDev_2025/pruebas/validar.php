<?php
session_start();
require 'db_conexion.php'; // Incluye la conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password_ingresada = $_POST['password'];

    // Buscar al usuario en la BD
    $stmt = $pdo->prepare("SELECT password FROM admin WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y la contraseña es correcta
    if ($admin && password_verify($password_ingresada, $admin['password'])) {
        // Contraseña correcta: Iniciar sesión
        $_SESSION['admin_logueado'] = true;
        $_SESSION['usuario'] = $usuario;
        header("Location: panel_admin.php"); // Redirigir al panel
        exit;
    } else {
        // Contraseña o usuario incorrecto
        header("Location: login.php?error=1");
        exit;
    }
}
?>