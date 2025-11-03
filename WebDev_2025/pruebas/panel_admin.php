<?php
session_start();
// Seguridad: Si no está logueado, lo saca al login
if (!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Panel de Administrador</h2>
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>.</p>
        
        <hr>

        <h3>Añadir Nueva Entrada al Blog</h3>
        
        <form action="crear_entrada.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required>
            </div>
            <div>
                <label for="imagen">Imagen de portada:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" required>
            </div>
            <div>
                <label for="texto_intro">Texto Introductorio (extracto):</label>
                <textarea id="texto_intro" name="texto_introductorio" rows="4" required></textarea>
            </div>
            <div>
                <label for="texto_full">Texto Completo:</label>
                <textarea id="texto_full" name="texto_completo" rows="10" required></textarea>
            </div>
            <button type="submit">Confirmar y Publicar Entrada</button>
        </form>

        <br>
        <a href="logout.php" class="logout-link">Cerrar Sesión</a>
    </div>
</body>
</html>