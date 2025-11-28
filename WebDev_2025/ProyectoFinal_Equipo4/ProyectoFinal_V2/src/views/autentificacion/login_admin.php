<?php
    require '../templates/header.php';
?>
<div class="container-md my-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-danger text-white text-center py-3 rounded-top-4">
                    <h3 class="card-title mb-0">Acceso Administrativo</h3>
                </div>
                <div class="card-body p-4 bg-white">
                    <p class="text-center text-muted mb-4">Ingresa con tu usuario de administrador</p>
                    
                    <form action="valida_admin.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required>
                            <label for="username">Nombre de Usuario</label>
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                            <label for="password">Contraseña</label>
                        </div>
                            
                        <div class="d-grid gap-2">
                            <button class="btn btn-danger btn-lg" type="submit">Entrar al Panel</button>
                            <a href="login.php" class="btn btn-outline-secondary">Volver al login de usuarios</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require '../templates/footer.php';
?>