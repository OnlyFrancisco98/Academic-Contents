<?php
    session_start();

    // Proteger la página: Si el usuario no ha iniciado sesión,
    // lo regresamos al login.
    //if (!isset($_SESSION['correo'])) {
    //    header("Location: login.html");
     //   exit();
   // }

    require '../templates/header.php'
?>

<div class="espacio-pedidos container-sm p-5 rounded-4 mb-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Mis Pedidos</h1>
            <p class="lead">Hola, <?php echo htmlspecialchars($_SESSION['correo']); ?>.</p>
            <hr>
            <a href="cerrarSesion.php" class="btn btn-outline-danger">Cerrar Sesión</a>
        </div>

        <div class="card mt-3">
            <div class="row g-0">
                <div class="col-md-2">
                <img src="..." class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="row g-0">
                <div class="col-md-2">
                <img src="..." class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php
    require '../templates/footer.php'
?>