<?php
require 'db_conexion.php'; // $pdo

// Consultar todas las entradas, de la más nueva a la más vieja
$stmt = $pdo->query("SELECT id, autor, imagen_ruta, texto_introductorio, fecha_creacion 
                     FROM entradas 
                     ORDER BY fecha_creacion DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuestro Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Blog</h1>
        <p>Últimas entradas de nuestro equipo.</p>
        
        <p><a href="login.php">Acceso Admin</a></p>

        <div class="blog-listado">
            
            <?php while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                
                <article class="blog-card">
                    <a href="ver_entrada.php?id=<?php echo $fila['id']; ?>">
                        <img src="<?php echo htmlspecialchars($fila['imagen_ruta']); ?>" alt="Imagen de portada">
                        <div class="blog-card-content">
                            <h3><?php echo htmlspecialchars($fila['texto_introductorio']); ?></h3>
                            <small>Por: <?php echo htmlspecialchars($fila['autor']); ?></small>
                        </div>
                    </a>
                </article>

            <?php endwhile; ?>

            <?php if ($stmt->rowCount() == 0): ?>
                <p>Aún no hay entradas en el blog. ¡Vuelve pronto!</p>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>