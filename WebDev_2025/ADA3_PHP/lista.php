<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

// Matriz de estudiantes
$estudiantes = [
  ["matricula" => "A001", "nombre" => "Jesús", "apellidos" => "Aviles", "asignatura" => "Desarrollo web", "calificacion" => 100],
  ["matricula" => "A002", "nombre" => "Frans", "apellidos" => "Montero", "asignatura" => "Desarrollo web", "calificacion" => 100],
  ["matricula" => "A003", "nombre" => "K", "apellidos" => "M", "asignatura" => "Futbol", "calificacion" => 92]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Estudiantes</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h3>
      <a href="cerrar_sesion.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
    </div>

    <h4 class="mb-3">Lista de estudiantes</h4>
    <form action="detalle.php" method="post">
      <table class="table table-striped">
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
</body>
</html>
