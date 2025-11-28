<?php
// src/views/pages/index.php
session_start();
require_once '../../config/conexion.php'; 
require '../templates/header.php';

// 1. Obtener una muestra de productos (Por ejemplo, los 4 más recientes)
try {
    // Seleccionamos 4 productos activos, ordenados por fecha de creación descendente
    $sql = "SELECT p.*, pi.image_path 
            FROM products p 
            LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = true 
            WHERE p.is_deleted = false 
            ORDER BY p.created_at DESC 
            LIMIT 4";
    $stmt = $pdo->query($sql);
    $productos_destacados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $productos_destacados = [];
}
?>

<main>
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <div class="alert alert-success text-center rounded-0 mb-0 border-0" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
            <strong>¡Bienvenido de vuelta!</strong> Esperamos que encuentres lo que buscas hoy.
        </div>
    <?php endif; ?>

    <div id="carruselPrincipal" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../../../public/imagenes/img10.png" 
                     class="d-block w-100" 
                     alt="Banner 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Nueva Colección 2025</h5>
                    <p>Descubre los estilos más épicos de la temporada.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../../../public/imagenes/img11.png" 
                     class="d-block w-100" 
                     alt="Banner 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Envío Gratis</h5>
                    <p>En todas las compras mayores a $999 MXN.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../../../public/imagenes/img12.png" 
                     class="d-block w-100" 
                     alt="Banner 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Ofertas Exclusivas</h5>
                    <p>Regístrate y obtén beneficios únicos.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-4 fw-bold">Lo que dicen nuestros clientes</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-3 text-center">
                    <div class="card-body">
                        <div class="text-warning mb-2">★★★★★</div>
                        <h5 class="card-title">Excelente Calidad</h5>
                        <p class="card-text text-muted">"Las playeras tienen una tela increíble y el estampado no se cae con las lavadas. ¡Súper recomendado!"</p>
                        <footer class="blockquote-footer mt-2">Carlos R.</footer>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-3 text-center">
                    <div class="card-body">
                        <div class="text-warning mb-2">★★★★★</div>
                        <h5 class="card-title">Envío Rápido</h5>
                        <p class="card-text text-muted">"Pedí un hoodie el lunes y me llegó el miércoles. El empaque venía muy cuidado."</p>
                        <footer class="blockquote-footer mt-2">Mariana L.</footer>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-3 text-center">
                    <div class="card-body">
                        <div class="text-warning mb-2">★★★★☆</div>
                        <h5 class="card-title">Atención de 10</h5>
                        <p class="card-text text-muted">"Tuve dudas con mi talla y me ayudaron por el chat muy rápido. Todo me quedó perfecto."</p>
                        <footer class="blockquote-footer mt-2">Jorge M.</footer>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Novedades</h2>
            <a href="catalogo.php" class="btn btn-outline-primary rounded-pill">Ver todo</a>
        </div>
        
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($productos_destacados as $prod): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <a href="detalle_producto.php?id=<?php echo $prod['id']; ?>">
                            <div style="height: 200px; overflow: hidden;" class="position-relative">
                                <img src="<?php echo !empty($prod['image_path']) ? htmlspecialchars($prod['image_path']) : 'https://via.placeholder.com/300'; ?>" 
                                     class="card-img-top w-100 h-100" 
                                     style="object-fit: cover;" 
                                     alt="<?php echo htmlspecialchars($prod['name']); ?>">
                            </div>
                        </a>
                        
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-truncate"><?php echo htmlspecialchars($prod['name']); ?></h6>
                            <span class="text-primary fw-bold mb-2">$<?php echo number_format($prod['price'], 2); ?></span>
                            
                            <div class="mt-auto">
                                <a href="detalle_producto.php?id=<?php echo $prod['id']; ?>" class="btn btn-dark btn-sm w-100">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php require '../templates/footer.php'; ?>