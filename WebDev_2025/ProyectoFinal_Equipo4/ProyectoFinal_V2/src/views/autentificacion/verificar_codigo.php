<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../config/conexion.php'; 

if (!isset($_SESSION['auth_email'])) {
    header("Location: login.php");
    exit;
}

$email_pendiente = $_SESSION['auth_email'];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_ingresado = trim($_POST['codigo']);

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND access_code = :codigo");
        $stmt->execute([
            ':email' => $email_pendiente,
            ':codigo' => $codigo_ingresado
        ]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre']     = $usuario['full_name'];
            $_SESSION['rol']        = $usuario['role_id'];
            $_SESSION['correo']     = $usuario['email'];

            $pdo->prepare("UPDATE users SET access_code = NULL WHERE id = :id")->execute([':id' => $usuario['id']]);

            unset($_SESSION['auth_email']);
            header("Location: ../pages/index.php");
            exit;

        } else {
            $error = "Código incorrecto o expirado.";
        }
    } catch (PDOException $e) {
        $error = "Error DB: " . $e->getMessage();
    }
}

require '../templates/header.php'; 
?>
<div class="container-md my-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card-body p-4 rounded-4" style="background-color: white;">
                <h3 class="card-title text-center">Verificación</h3>
                <p class="text-center text-muted">
                    Ingresa el código enviado a <strong><?php echo htmlspecialchars($email_pendiente); ?></strong>
                </p>

                <?php if ($error): ?>
                    <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text-center tracking-wider" 
                               style="font-size: 24px; letter-spacing: 5px;" 
                               id="codigo" name="codigo" maxlength="6" required autocomplete="off">
                        <label for="codigo">Código de 6 dígitos</label>
                    </div>
                        
                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-lg" type="submit">Verificar y Entrar</button>
                    </div>
                    
                    <div class="mt-3 text-center">
                        <a href="login.php" class="small text-muted">¿Correo incorrecto? Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require '../templates/footer.php'; ?>