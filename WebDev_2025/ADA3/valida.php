<?php
session_start();

// Credenciales fijas
$usuario_valido = "admin";
$contrasena_valida = "1234";

$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
    $_SESSION['usuario'] = $usuario;
    header("Location: lista.php");
    exit;
} else {
    echo "<script>alert('Usuario o contraseña incorrectos');window.location='index.html';</script>";
}

