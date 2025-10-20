<?php
session_start();

$matricula = $_POST['matricula'] ?? '';

$estudiantes = [
    "A1" => ["nombre" => "Jesús", "apellidos" => "Aviles", "asignatura" => "Desarrollo web", "calificacion" => 100],
    "A2" => ["nombre" => "Frans", "apellidos" => "Montero", "asignatura" => "Desarrollo web", "calificacion" => 100],
    "A3" => ["nombre" => "K", "apellidos" => "M", "asignatura" => "Futbol", "calificacion" => 92],
    "A4" => ["nombre" => "Ana", "apellidos" => "García", "asignatura" => "Bases de datos", "calificacion" => 85],
    "A5" => ["nombre" => "Carlos", "apellidos" => "Martínez", "asignatura" => "Redes", "calificacion" => 78],
    "A6" => ["nombre" => "Sofía", "apellidos" => "López", "asignatura" => "Sistemas Operativos", "calificacion" => 95],
    "A7" => ["nombre" => "David", "apellidos" => "Hernández", "asignatura" => "Desarrollo web", "calificacion" => 88],
    "A8" => ["nombre" => "Laura", "apellidos" => "Pérez", "asignatura" => "Cálculo", "calificacion" => 72],
    "A9" => ["nombre" => "Miguel", "apellidos" => "Sánchez", "asignatura" => "Inteligencia Artificial", "calificacion" => 91]
];

$e = $estudiantes[$matricula] ?? null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles del Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="estilos/styles.css">
</head>

<body>

    <header>
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-md-6">
                    <h2><a href="index.html">Actividad de Aprendizaje 3: PHP</a></h2>
                </div>
                <div class="col-md-6">
                    <form action="" id="buscador" class="d-flex">
                        <input type="text" id="buscar" class="form-control me-2" placeholder="Buscar...">
                        <button type="submit" class="btn btn-light"> Buscar </button>
                    </form>
                </div>
            </div>
        </div>  
    </header>

    <main id="bienvenida" style="display:none;">
        <div class="container md-5 p-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></h3>
                <a href="cerrarSesion.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
            </div>

            <?php if ($e): ?>
                <h4 class="mb-3">Calificaciones</h4>
                <div class="card p-3 shadow-sm">
                    <p><strong>Nombre:</strong> <?php echo $e['nombre']; ?></p>
                    <p><strong>Apellidos:</strong> <?php echo $e['apellidos']; ?></p>
                    <p><strong>Asignatura:</strong> <?php echo $e['asignatura']; ?></p>
                    <p><strong>Calificación:</strong> <?php echo $e['calificacion']; ?></p>
                </div>
            <?php else: ?>
                <p class="text-danger">No se encontró el estudiante.</p>
            <?php endif; ?>

            <a href="lista.php" class="btn btn-secondary mt-3">Regresar</a>
        </div>
    </main>

    <footer>
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-md-4">
                    <img src="imagenes/logoUady.png" 
                         alt="Logo del Proyecto" 
                         class="img-fluid" 
                         style="max-height: 120px;">
                </div>
                <div class="col-md-4">
                    <br>   
                    <h5>Integrantes</h5>
                    <ul class="list-unstyled">
                        <li><p class="mb-1">Jose Francisco Montero Uc</p></li>
                        <li><p class="mb-1">Jesús Alberto Avilés Castillo</p></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Información</h5>
                    <ul class="list-unstyled">
                        <li><p class="mb-1">Desarrollo Web, ADA 3</p></li>
                        <li><p class="mb-1">Agosto - Diciembre 2025</p></li>
                        <li><p class="mb-1">Universidad Autónoma de Yucatán</p></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="copyrigth">
            © 2025 Copyright: Pónganos 10 profe plox
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#bienvenida").fadeIn(200);

        });
    </script>
</body>

</html>