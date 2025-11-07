<?php
    require '../templates/header.php';
?>
<div class="container-md my-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card-body p-4 rounded-4" style="background-color: white;">
                <h3 class="card-title text-center"> Inicio de Sesión</h3>
                <br>
                <form action="valida.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="correo" placeholder="Correo" required>
                        <label for="floatingInput">Correo Electrónico</label>
                    </div>
                        
                    <div class="d-grid">
                        <button class="btn btn-secondary btn-lg" type="submit">Entrar</button>
                    </div>

                    <div class="mt-3 col-md-12 text-center">
                        <a href="loginAdmin.php">Ingresa como administrador</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require '../templates/footer.php';
?>