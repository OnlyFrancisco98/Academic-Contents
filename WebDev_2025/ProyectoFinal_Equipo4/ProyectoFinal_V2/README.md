# Proyecto Web Clash Royale

## Requisitos
- XAMPP (Apache, MySQL, PHP)
- PHP 7.4+
- MySQL 5.7+

## Pasos para probar la conexión con la BD
- Abrir XAMPP y levantar los servidores APACHE y MySQL, presionar al botón de Admin del servidor de MySQL para abrir "PhpMyAdmin"
- Una vez estes en PhpMyAdmin, vas a importar la BD y deberian de aparecer todas las tablas (estan vacias todas)
- El proyecto completo debe de estar en la carpeta "htdocs" (C:\xampp\htdocs), la BD importada se guardara en C:\xampp\mysql
- Una vez que esten levantados los servidores y tengas la BD, ir al navegador y poner algo como "http://localhost/ProyectoFinal_Equipo4/src/config/dbConexion.php" (puede ser necesario ajustarlo)
- Para confirmar q si se establecio la conexión, la pagina debe mostrar un comentario como: Conexión exitosa a la base de datos
Ejecutando consulta: SELECT * FROM products
No se encontraron productos
- Te confirma la conexión, intenta hacer una consulta pero como no hay nada en la BD devuelve q no encontro nada

## En caso de dudas
- preguntarle a una ia
- investigar

## Notas
- No se intento conectar la BD con el login porque creo q haria falta otro php como "registrar.php"
