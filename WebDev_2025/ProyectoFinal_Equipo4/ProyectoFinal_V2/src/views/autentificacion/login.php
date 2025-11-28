<?php
    require '../templates/header.php';
    session_start();
    $mensaje  = $_SESSION['mensaje'] ?? '';
    unset($_SESSION['mensaje']);
?>
<div class="container-md my-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card-body p-4 rounded-4 shadow-sm" style="background-color: white;">
                <h3 class="card-title text-center mb-4">Acceso Seguro</h3>
                
                <?php if ($mensaje): ?>
                    <div class="alert alert-warning text-center" role="alert">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                <?php endif; ?>

                <p class="text-center text-muted mb-4">
                    Ingresa tu correo. Te enviaremos un código de validación.
                </p>

                <form action="valida_email.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="correoInput" name="correo" placeholder="nombre@correo.com" required>
                        <label for="correoInput">Correo Electrónico</label>
                    </div>
                        
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg" type="submit">
                            Enviar Código
                        </button>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="login_admin.php" class="text-decoration-none">Ingresa como administrador</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    require '../templates/footer.php';
?>