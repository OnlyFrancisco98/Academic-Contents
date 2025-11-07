<?php
    session_start();
    // Definir la ruta base para los assets
    define('BASE_URL', '../../../');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProyectoFinal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/styles.css">
</head>
<body>
    <header id="mi-header">
        <div class="container-fluid p-4">
            <div class="row align-items-center">
                <div class="col-md-4 list-unstyled">
                    <a href="index.php" class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3">INICIO</a>
                    <a class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3" href="catalogo.php">CATÁLOGO</a>
                    <a class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3" href="blog.php">BLOG</a>
                    <a class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3" href="sobreNosotros.php">SOBRE NOSOTROS</a>
                </div>

                <div class="col-md-4 d-flex align-items-center">
                    <a href="index.php" class="w-100 d-block">
                        <img src="<?php echo BASE_URL; ?>public/imagenes/logo.png" alt="Logo" class="img-fluid" style="max-width:100%; height:auto; object-fit:contain;">
                    </a>
                </div>

                <div class="col-md-4 text-end align-items-center ">
                    <a class="ms-3" href="#"><img src="<?php echo BASE_URL; ?>public/imagenes/lupa.svg" alt="Buscar" style="width:25px;"></a>
                    <a class="ms-3" href="#"><img src="<?php echo BASE_URL; ?>public/imagenes/ShoppingBag.svg" alt="Carrito" style="width:50px;"></a>
                    <a class="ms-3" href="#"><img src="<?php echo BASE_URL; ?>public/imagenes/hearth-svgrepo-com(1).svg" alt="Favoritos" style="width:25px;"></a>
                    <?php
                        // Esta lógica de sesión está ahora en UN solo lugar
                        if (isset($_SESSION['correo'])) {
                            echo '<a class="ms-4" href="../pages/pedidos.php"><img src="' . BASE_URL . 'public/imagenes/User.svg" alt="Mis Pedidos" style="width:25px;"></a>';
                        } else {
                            echo '<a class="ms-4" href="../autentificacion/login.php"><img src="' . BASE_URL . 'public/imagenes/User.svg" alt="Usuario" style="width:25px;"></a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <main> 
