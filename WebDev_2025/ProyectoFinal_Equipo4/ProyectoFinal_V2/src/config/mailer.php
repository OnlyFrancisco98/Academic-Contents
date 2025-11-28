<?php

require __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function enviarCodigoAcceso($destinatario, $nombre, $codigo) {
    $mail = new PHPMailer(true);

    try {
        // --- Configuración del Servidor (Gmail) ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'fmu.movil@gmail.com';
        $mail->Password   = 'ikiv yywc pxsp npxu';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // --- Remitente y Destinatario ---
        $mail->setFrom('fmu.movil@gmail.com', 'Sistemas Mundo Clash Royale');
        $mail->addAddress($destinatario, $nombre);

        // --- Contenido ---
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Tu Código de Acceso - MundoClashRoyale';
        
        $cuerpo = "
            <div style='font-family: sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 5px;'>
                <h2>Hola, $nombre</h2>
                <p>Has solicitado ingresar al sistema. Usa el siguiente código:</p>
                <h1 style='color: #2c3e50; letter-spacing: 5px;'>$codigo</h1>
                <p><small>Si no fuiste tú, ignora este mensaje.</small></p>
            </div>
        ";
        
        $mail->Body    = $cuerpo;
        $mail->AltBody = "Hola $nombre. Tu código de acceso es: $codigo";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>