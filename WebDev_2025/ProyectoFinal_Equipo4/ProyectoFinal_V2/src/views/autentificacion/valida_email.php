<?php
// pages/valida_email.php
session_start();
require_once '../../config/conexion.php';
require_once '../../config/mailer.php';

$correo = trim($_POST['correo'] ?? '');

// Validación básica
if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['mensaje'] = "Por favor ingresa un correo válido.";
    header("Location: login.php");
    exit;
}

try {
    // 1. Generar código de acceso (6 dígitos)
    $codigo = rand(100000, 999999);
    
    // 2. Verificar si el usuario ya existe
    $stmt = $pdo->prepare("SELECT id, email, full_name FROM users WHERE email = :email");
    $stmt->execute([':email' => $correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    $nombre_para_correo = "Nuevo Usuario";

    if ($usuario) {
        //  CASO 1: EL USUARIO YA EXISTE (LOGIN) 
        $updateStmt = $pdo->prepare("UPDATE users SET access_code = :codigo WHERE id = :id");
        $updateStmt->execute([
            ':codigo' => $codigo,
            ':id'     => $usuario['id']
        ]);
        
        // Usamos su nombre real si lo tiene
        if (!empty($usuario['full_name'])) {
            $nombre_para_correo = $usuario['full_name'];
        }

    } else {
        //  CASO 2: EL USUARIO NO EXISTE (REGISTRO) 

        $partes_correo = explode("@", $correo);
        $nombre_para_correo = $partes_correo[0]; 

        $rol_por_defecto = 1; // el ID 1 es el correspondiente a usuario convencional

        $insertSql = "INSERT INTO users (email, access_code, full_name, role_id, created_at) 
                      VALUES (:email, :codigo, :nombre, :rol, NOW())";
        
        $insertStmt = $pdo->prepare($insertSql);
        $insertStmt->execute([
            ':email'  => $correo,
            ':codigo' => $codigo,
            ':nombre' => $nombre_para_correo,
            ':rol'    => $rol_por_defecto
        ]);
    }

    // 3. Enviar el correo (funciona igual para ambos casos)
    $enviado = enviarCodigoAcceso($correo, $nombre_para_correo, $codigo);

    if ($enviado) {
        $_SESSION['auth_email'] = $correo;
        $_SESSION['mensaje_exito'] = "Código enviado correctamente.";
        
        header("Location: verificar_codigo.php");
        exit;
    } else {
        $_SESSION['mensaje'] = "Hubo un problema al enviar el correo. Intenta de nuevo.";
        header("Location: login.php");
        exit;
    }

} catch (PDOException $e) {

    // Si el error es de la base de datos se visualiza en los logs.
    error_log("Error DB: " . $e->getMessage());
    $_SESSION['mensaje'] = "Error del sistema. Por favor intenta más tarde.";
    header("Location: login.php");
    exit;
}
?>