<?php
session_start();

// Credenciales fijas
$correo_valido = "fmu.movil@gmail.com";

$correo = $_POST['correo'] ?? '';
if ($correo === $correo_valido) {
    $_SESSION['correo'] = $correo;
    header("Location: index.php");
    exit;
} else {
    echo "<script>alert('Usuario o contraseña incorrectos');window.location='login.html';</script>";
}

?>
