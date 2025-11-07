<?php
    require '../templates/header.php';
    require '../../config/db_Conexion.php';

    // 1. Obtener el ID de la URL de forma segura
    $id_entrada = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!$id_entrada) {
        die("Entrada no válida.");
    }

    // 2. Buscar esa entrada específica en la BD
    $sql = "SELECT autor, imagen_ruta, texto_introductorio, texto_completo, fecha_creacion 
            FROM entradas 
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_entrada]);
    $entrada = $stmt->fetch(PDO::FETCH_ASSOC);

    // 3. Si no se encuentra la entrada, mostrar error
    if (!$entrada) {
        die("La entrada solicitada no existe.");
    }
?>
    <div class="container">
        <div class="row">
            <article class="entrada-completa">
                
                <h1><?php echo htmlspecialchars($entrada['texto_introductorio']); ?></h1>
                <p>
                    <strong>Por: <?php echo htmlspecialchars($entrada['autor']); ?></strong> <br>
                    <small>Publicado el: <?php echo date('d \d\e F, Y', strtotime($entrada['fecha_creacion'])); ?></small>
                </p>
                
                <img src="<?php echo htmlspecialchars($entrada['imagen_ruta']); ?>" alt="Imagen de portada">
                
                <div class="contenido-principal">
                    <?php echo htmlspecialchars($entrada['texto_completo']); ?>
                </div>

                <hr>
                <a href="blog.php">← Volver al blog</a>
            </article>
        </div>
    </div>
<?php
    require '../templates/footer.php'
?>