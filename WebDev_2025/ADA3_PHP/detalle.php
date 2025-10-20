<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

$matricula = $_POST['matricula'] ?? '';

$estudiantes = [
  "A001" => ["nombre" => "Jesús", "apellidos" => "Aviles", "asignatura" => "Desarrollo web", "calificacion" => 100],
  "A002" => ["nombre" => "Frans", "apellidos" => "Montero", "asignatura" => "Desarrollo web", "calificacion" => 100],
  "A003" => ["nombre" => "K", "apellidos" => "M", "asignatura" => "Futbol", "calificacion" => 92]
];

$e = $estudiantes[$matricula] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalles del Estudiante</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></h3>
      <a href="cerrar_sesion.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
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
</body>
</html>
