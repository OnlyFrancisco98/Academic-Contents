<?php
    session_start();
    require_once '../../config/conexion.php';
   
    if (!isset($_SESSION['correo'])) {
        header("Location: login.html");
        exit();
   }

   $usuario_id = $_SESSION['usuario_id'];

   try{
       $sql = "SELECT * FROM orders WHERE user_id = :uid ORDER BY created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':uid' => $usuario_id]);
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
   } catch(PDOException $e){
        $error  = "Error al cargar pedidos: " . $e->getMessage();
   }
    require '../templates/header.php'
?>

<div class="espacio-pedidos container-sm p-5 rounded-4 mb-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Mis Pedidos</h1>
            <p class="lead">Hola, <?php echo htmlspecialchars($_SESSION['nombre'] ?? $_SESSION['correo']); ?>.</p>
            <hr>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
        </div>

        <div class="col-md-12 mt-4">
            <?php if (empty($pedidos)): ?>
                <div class="alert alert-info text-center">
                    No has realizado ningún pedido todavía.
                </div>
            <?php else: ?>
                
                <?php foreach ($pedidos as $pedido): ?>
                    
                    <?php 
                        // Lógica simple para color del estado (opcional)
                        $badgeColor = match($pedido['status']) {
                            'completed', 'entregado' => 'success',
                            'pending', 'pendiente'   => 'warning',
                            'cancelled', 'cancelado' => 'danger',
                            default => 'secondary'
                        };
                    ?>

                    <div class="card mb-3 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-2 d-flex align-items-center justify-content-center bg-light">
                                <div style="font-size: 3rem; color: #ccc;">📦</div>
                            </div>
                            
                            <div class="col-md-10">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Pedido #<?php echo $pedido['id']; ?></h5>
                                        <span class="badge bg-<?php echo $badgeColor; ?>">
                                            <?php echo strtoupper(htmlspecialchars($pedido['status'])); ?>
                                        </span>
                                    </div>
                                    
                                    <p class="card-text mt-2 text-truncate">
                                        <small class="text-muted">Enviado a:</small> <?php echo htmlspecialchars($pedido['address']); ?>
                                    </p>
                                    
                                    <div class="d-flex justify-content-between align-items-end mt-3">
                                        <div>
                                            <p class="card-text mb-0"><small class="text-body-secondary">Fecha: <?php echo date("d/m/Y", strtotime($pedido['created_at'])); ?></small></p>
                                            <h4 class="mb-0 text-primary">$<?php echo number_format($pedido['total'], 2); ?></h4>
                                        </div>
                                        
                                        <div>
                                            <a href="detalle_pedido.php?id=<?php echo $pedido['id']; ?>" class="btn btn-primary btn-sm">
                                                Ver Detalles &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    require '../templates/footer.php'
?>