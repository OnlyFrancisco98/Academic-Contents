<?php
    require '../templates/header.php';
?>

<div class="container-fluid p-5">
    <div class="row">
        <div class="col-md-12 p-1">
            <!-- ENLACE PARA TODOS LOS PRODUCTOS (Sin ?cat=...) -->
            <a href="productos.php" class="card-link h-auto">
                <div class="card text-bg-dark h-auto">
                    <!-- Ajusta la ruta de la imagen según tu proyecto -->
                    <img src="<?php echo BASE_URL; ?>public/imagenes/tstsbanner.webp" class="card-img h-auto" alt="CatalogoCompleto" style="object-fit: cover; max-height: 300px;">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.4);">
                        <h5 class="card-title display-4 fw-bold">TODA LA COLECCIÓN</h5>
                    </div>
                </div>
            </a>     
        </div>
    </div>
    
    <div class="row mt-2">
        <!-- CATEGORÍA 1: HOODIES (Ajustamos ID según BD, suponemos que es 2) -->
        <div class="col-md-4 p-1">
            <a href="productos.php?cat=2" class="card-link h-100">
                <div class="card text-bg-light h-100 border-0 shadow-sm">
                    <img src="<?php echo BASE_URL; ?>public/imagenes/img1.jpg" class="card-img h-100" alt="Hoodies" style="object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.2);">
                        <h5 class="card-title display-5 fw-bold text-white">Hoodies</h5>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- CATEGORÍA 2: T-SHIRTS (Suponemos ID 1) -->
        <div class="col-md-4 p-1">
            <a href="productos.php?cat=1" class="card-link h-100">
                <div class="card text-bg-light h-100 border-0 shadow-sm">
                    <img src="<?php echo BASE_URL; ?>public/imagenes/img2.jpg" class="card-img h-100" alt="Tshirts" style="object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.2);">
                        <h5 class="card-title display-5 fw-bold text-white">T-Shirts</h5>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- CATEGORÍA 3: VARIOS (Suponemos ID 3) -->
        <div class="col-md-4 p-1">
            <a href="productos.php?cat=3" class="card-link h-100">
                <div class="card text-bg-light h-100 border-0 shadow-sm">
                    <img src="<?php echo BASE_URL; ?>public/imagenes/img3.jpg" class="card-img h-100" alt="Varios" style="object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.2);">
                        <h5 class="card-title display-5 fw-bold text-white">Varios</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
    require '../templates/footer.php';
?>