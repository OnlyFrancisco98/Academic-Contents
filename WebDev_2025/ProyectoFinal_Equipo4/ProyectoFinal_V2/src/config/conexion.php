<?php
$host = "aws-0-us-west-2.pooler.supabase.com";
    $port = "6543"; // Usando el Connection Pooler (Transaction mode)
    $db   = "postgres";
    $user = "postgres.swgrrvbnscoctyklvlpy";
    $pass = "Laimlobering21";
    
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass;sslmode=require";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

try {
    $pdo =  new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Manejar errores de conexión
    die("Error al conectar o inicializar la base de datos: " . $e->getMessage());
}
?>
