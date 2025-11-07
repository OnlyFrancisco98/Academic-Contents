
<?php
    require '../templates/header.php';
?>

<div class="container-fluid p-5">
    <div class="row">
        <div class="col-md-12 p-1">
            <a href="#" class="card-link h-auto">
                <div class="card text-bg-dark h-auto">
                    <img src="../../../public/imagenes/tstsbanner.webp" class="card-img h-auto" alt="Hoodies" style="object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                        <h5 class="card-title display-4">TODA LA COLECCIÓN</h5>
                    </div>
                </div>
            </a>     
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 p-1">
            <a href="#" class="card-link h-100">
                <div class="card text-bg-light h-100">
                    <img src="<?php echo BASE_URL; ?>public/imagenes/img1.jpg" class="card-img h-100" alt="Hoodies" style="object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                        <h5 class="card-title display-4">Card title</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 p-1">
            <a href="#" class="card-link h-100">
                <div class="card text-bg-light h-100">
                    <img src="../../../public/imagenes/img2.jpg" class="card-img h-100" alt="Hoodies" style="object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                        <h5 class="card-title display-4">Card title</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 p-1">
            <a href="#" class="card-link h-100">
                <div class="card text-bg-light h-100">
                    <img src="../../../public/imagenes/img3.jpg" class="card-img h-100" alt="Hoodies" style="object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                        <h5 class="card-title display-4">Card title</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
    require '../templates/footer.php';
?>