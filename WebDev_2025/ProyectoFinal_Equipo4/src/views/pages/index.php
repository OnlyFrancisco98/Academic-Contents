<?php
    require '../templates/header.php';
?>

<div class="espacio-pedidos container-sm p-5 rounded-4 mb-5 mt-5">
    <div class="row">       
        <div class="col-md-12 text-center">
            
                <?php
                    if (isset($_SESSION['correo'])) {
                        echo '<div class="container text-center my-5">';
                        echo '<h2>¡Bienvenido de vuelta, ' . htmlspecialchars($_SESSION['correo']) . '!</h2>';
                        echo '</div>';
                    } else {
                         echo '<div class="container text-center my-5">';
                         echo '<h2>Bienvenido a la tienda</h2>';
                         echo '</div>';
                    }
                ?>
        </div>
    </div>
</div>      

<?php
    require '../templates/footer.php';
?>