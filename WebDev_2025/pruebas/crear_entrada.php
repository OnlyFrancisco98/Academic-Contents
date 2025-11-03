<?php
session_start();
require 'db_conexion.php';

// 1. Seguridad: Verificar si es admin
if (!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado'] !== true) {
    die("Acceso no autorizado.");
}

// 2. Verificar que el método sea POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 3. Definir directorio de subidas
    $directorio_subidas = 'uploads/'; // Asegúrate de que esta carpeta exista y tenga permisos
    
    // Validar que el archivo se subió correctamente
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        
        // Crear un nombre de archivo único para evitar sobreescrituras
        $nombre_archivo = time() . '_' . basename($_FILES["imagen"]["name"]);
        $ruta_completa = $directorio_subidas . $nombre_archivo;
        
        // Mover el archivo temporal a la ubicación final
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_completa)) {
            
            // 4. Obtener datos del formulario
            $autor = $_POST['autor'];
            $texto_intro = $_POST['texto_introductorio'];
            $texto_completo = $_POST['texto_completo'];
            $ruta_db = $ruta_completa; // Esta es la ruta que se guarda en la BD

            // 5. Insertar en la Base de Datos
            try {
                $sql = "INSERT INTO entradas (autor, imagen_ruta, texto_introductorio, texto_completo) 
                        VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$autor, $ruta_db, $texto_intro, $texto_completo]);

                // 6. Redirigir al blog para ver la nueva entrada
                header("Location: blog.php");
                exit;

            } catch (PDOException $e) {
                die("Error al guardar en la base de datos: " . $e->getMessage());
            }

        } else {
            die("Error al mover la imagen subida. Verifica los permisos de la carpeta 'uploads'.");
        }
    } else {
        die("Error al subir la imagen. Código de error: " . $_FILES["imagen"]["error"]);
    }
}
?>