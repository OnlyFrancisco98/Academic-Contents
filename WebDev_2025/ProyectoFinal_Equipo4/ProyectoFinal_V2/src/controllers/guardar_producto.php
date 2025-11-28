<?php
session_start();
require_once '../config/conexion.php';

// Validar ADMIN
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../views/pages/index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $pdo->beginTransaction();

        // 1. Recibir datos
        $nombre = $_POST['nombre'];
        $cat_id = $_POST['categoria_id'];
        $precio = $_POST['precio'];
        $stock  = $_POST['stock'];
        $desc   = $_POST['descripcion'];

        // 2. Insertar Producto
        $sqlProd = "INSERT INTO products (category_id, name, description, price, stock, created_at, is_deleted) 
                    VALUES (?, ?, ?, ?, ?, NOW(), false)";
        $stmt = $pdo->prepare($sqlProd);
        $stmt->execute([$cat_id, $nombre, $desc, $precio, $stock]);
        $prod_id = $pdo->lastInsertId();

        // 3. Manejo de la Imagen
        $ruta_imagen_bd = ''; // Valor por defecto si falla
        
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombre_archivo = "prod_" . $prod_id . "_" . time() . "." . $ext;
            
            // Ruta física donde se guardará (ajusta según tu estructura)
            // Asumiendo que estamos en src/controllers y queremos ir a public/imagenes
            $ruta_fisica = "../../public/imagenes/" . $nombre_archivo;
            
            // Ruta relativa para guardar en BD (como se usa en el <img src>)
            $ruta_imagen_bd = "../../../public/imagenes/" . $nombre_archivo;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_fisica)) {
                // Insertar en tabla de imágenes
                $sqlImg = "INSERT INTO product_images (product_id, image_path, is_main) VALUES (?, ?, true)";
                $pdo->prepare($sqlImg)->execute([$prod_id, $ruta_imagen_bd]);
            }
        }

        $pdo->commit();

        echo "<script>
                alert('Producto guardado correctamente');
                window.location.href = '../views/pages/index.php';
              </script>";

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>