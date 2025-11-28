<?php
session_start();
require_once '../../config/conexion.php';
require '../templates/header.php';

// Validar que sea ADMIN (Rol 1)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    echo "<script>alert('Acceso denegado'); window.location='../autentificacion/login_admin.php';</script>";
    exit;
}

// Obtener categorías para el select
$cats = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
    <div class="row justify-content-center my-5">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"> Alta de Nuevos Productos</h4>
                </div>
                <div class="card-body p-4">
                    <form action="../../controllers/guardar_producto.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Nombre del Producto</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Categoría</label>
                                <select class="form-select" name="categoria_id" required>
                                    <option value="">Selecciona una...</option>
                                    <?php foreach($cats as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Precio (MXN)</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" name="precio" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Stock Inicial</label>
                                <input type="number" class="form-control" name="stock" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Descripción</label>
                                <textarea class="form-control" name="descripcion" rows="4" required></textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Imagen Principal</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*" required>
                                <div class="form-text">Formatos aceptados: JPG, PNG, WEBP.</div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">Guardar Producto</button>
                            <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../templates/footer.php'; ?>