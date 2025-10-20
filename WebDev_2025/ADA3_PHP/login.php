<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - Consulta de Calificaciones</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="text-center mb-4">Inicio de sesión</h2>

    <form action="valida.php" method="post" class="card p-4 shadow-sm mx-auto" style="max-width:400px;">
      <div class="mb-3">
        <label for="usuario" class="form-label">Usuario:</label>
        <input type="text" name="usuario" id="usuario" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>
  </div>
</body>
</html>
