<?php
session_start();
if (isset($_SESSION['admin_logueado']) && $_SESSION['admin_logueado'] === true) {
    header('Location: ../pages/panel_admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login de Admin</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>
<body>
    <div class="container" style="max-width: 400px;">
        <h2>Login de Administrador</h2>

        <?php
        // Mostrar error si la validación falló
        if (isset($_GET['error'])) {
            echo '<p class="error-msg">Usuario o contraseña incorrectos.</p>';
        }
        ?>

        <form action="validar_admin.php" method="POST">
            <div>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="admin" required>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" value="admin" required>
            </div>
            <button type="submit">Entrar</button>

        </form>
    </div>
</body>
</html>