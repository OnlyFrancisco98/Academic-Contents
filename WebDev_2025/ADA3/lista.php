<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}

// Matriz de estudiantes
$estudiantes = [
    ["matricula" => "A001", "nombre" => "Jesús", "apellidos" => "Aviles", "asignatura" => "Desarrollo web", "calificacion" => 100],
    ["matricula" => "A002", "nombre" => "Frans", "apellidos" => "Montero", "asignatura" => "Desarrollo web", "calificacion" => 100],
    ["matricula" => "A003", "nombre" => "K", "apellidos" => "M", "asignatura" => "Futbol", "calificacion" => 92],
    ["matricula" => "A004", "nombre" => "Ana", "apellidos" => "García", "asignatura" => "Bases de datos", "calificacion" => 85],
    ["matricula" => "A005", "nombre" => "Carlos", "apellidos" => "Martínez", "asignatura" => "Redes", "calificacion" => 78],
    ["matricula" => "A006", "nombre" => "Sofía", "apellidos" => "López", "asignatura" => "Sistemas Operativos", "calificacion" => 95],
    ["matricula" => "A007", "nombre" => "David", "apellidos" => "Hernández", "asignatura" => "Desarrollo web", "calificacion" => 88],
    ["matricula" => "A008", "nombre" => "Laura", "apellidos" => "Pérez", "asignatura" => "Cálculo", "calificacion" => 72],
    ["matricula" => "A009", "nombre" => "Miguel", "apellidos" => "Sánchez", "asignatura" => "Inteligencia Artificial", "calificacion" => 91]
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Estudiantes</title>
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

    <main>
        <div class="container md-5 p-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h3>
                <a href="cerrarSesion.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
            </div>

            <h4 class="mb-3">Lista de estudiantes</h4>
            <div class="mb-3">
                <input type="text" id="filtroEstudiantes" class="form-control" placeholder="Filtrar estudiantes por datos...">
            </div>

            <form action="detalle.php" method="post">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estudiantes as $e): ?>
                            <tr>
                                <td><input type="radio" name="matricula" value="<?php echo $e['matricula']; ?>" required></td>
                                <td><?php echo $e['matricula']; ?></td>
                                <td><?php echo $e['nombre']; ?></td>
                                <td><?php echo $e['apellidos']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Consultar</button>
            </form>
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
            
            $("#filtroEstudiantes").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        });
    </script>
</body>

</html>