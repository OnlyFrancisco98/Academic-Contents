<?php
    require '../templates/header.php';
    require '../../config/db_Conexion.php';

    $stmt = $pdo->query("SELECT id, autor, imagen_ruta, texto_introductorio, fecha_creacion 
                     FROM entradas 
                     ORDER BY fecha_creacion DESC");
?>

<div class="container-sm p-5 rounded-3 mb-5 mt-5" style="background-color: white;">
    <div class="row p-5">       
        <div class="col-sm-12 text-center">
            <h1 class="display-3">Mundo Clash Royale: Todo lo que debes de saber de Clash Royale</h1>
            <p class="mt-4">
                ¡Piérdete en el maravilloso mundo de Clash Royale con los siguientes artículos que detallan
                las más recientes noticias y novedades de esta excelente comunidad!
            </p>

            <?php while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                
                <article class="blog-card my-5">
                    <a href="ver_entrada.php?id=<?php echo $fila['id']; ?>">
                        <img src="/public/uploads/<?php echo htmlspecialchars($fila['imagen_ruta']); ?>" alt="Imagen de portada">
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
</div>      

<?php
    require '../templates/footer.php'
?>

 