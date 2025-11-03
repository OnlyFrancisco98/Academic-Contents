<?php
try {
    // 1. Crear (o conectar) a la base de datos SQLite
    $pdo = new PDO('sqlite:blog.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Crear tabla de administradores si no existe
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS admin (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            usuario TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL
        )
    ");

    // 3. Crear tabla de entradas del blog si no existe
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS entradas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            autor VARCHAR(100) NOT NULL,
            imagen_ruta VARCHAR(255) NOT NULL,
            texto_introductorio TEXT NOT NULL,
            texto_completo TEXT NOT NULL,
            fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // 4. Insertar el usuario admin/admin (solo si no existe)
    // Usamos password_hash para guardar la contraseña de forma segura
    $usuario_admin = 'admin';
    $password_admin = 'admin';
    $hashed_password = password_hash($password_admin, PASSWORD_DEFAULT);

    // 'INSERT OR IGNORE' es específico de SQLite para evitar duplicados
    $stmt = $pdo->prepare("INSERT OR IGNORE INTO admin (usuario, password) VALUES (?, ?)");
    $stmt->execute([$usuario_admin, $hashed_password]);

} catch (PDOException $e) {
    // Manejar errores de conexión
    die("Error al conectar o inicializar la base de datos: " . $e->getMessage());
}
?>