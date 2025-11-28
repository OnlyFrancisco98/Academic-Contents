<?php
session_start();
require '../../config/conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password_ingresada = $_POST['password'];

    $stmt = $pdo->prepare("SELECT password FROM admin WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password_ingresada, $admin['password'])) {
        $_SESSION['admin_logueado'] = true;
        $_SESSION['usuario'] = $usuario;
        header("Location: ../pages/panel_admin.php"); 
        exit;
    } else {
        header("Location: login.php?error=1");
        exit;
    }
}
?>