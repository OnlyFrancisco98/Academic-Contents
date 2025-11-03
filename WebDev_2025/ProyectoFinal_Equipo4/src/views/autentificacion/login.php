<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProyectoFinal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header id="mi-header">
        <div class="container-fluid p-4">
            <div class="row align-items-center">
                <div class="col-md-4 list-unstyled">
                    <a href="index.php" class="link-offset-3 link-underline-light link-underline-opacity-75 me-3">INICIO</a>
                    <a class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3" href="catalogo.php">CATÁLOGO</a>
                    <a class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3" href="blog.php">BLOG</a>
                    <a class="link-offset-2 link-offset-3-hover link-underline-light link-underline-opacity-0 link-underline-opacity-75-hover me-3" href="#">SOBRE NOSOTROS</a>
                </div>

                <div class="col-md-4 d-flex align-items-center">
                    <a href="index.html" class="w-100 d-block">
                        <img src="imagenes/logo.png" alt="Logo" class="img-fluid" style="max-width:100%; height:auto; object-fit:contain;">
                    </a>
                </div>

                <div class="col-md-4 text-end align-items-center ">
                    <a class="ms-3" href="#"><img src="imagenes/lupa.svg" alt="Buscar" style="width:25px;"></a>
                    <a class="ms-3" href="#"><img src="imagenes/ShoppingBag.svg" alt="Carrito" style="width:50px;"></a>
                    <a class="ms-3" href="#"><img src="imagenes/hearth-svgrepo-com(1).svg" alt="Buscar" style="width:25px;"></a>
                    <a class="ms-4" href="login.html"><img src="imagenes/User.svg" alt="Usuario" style="width:25px;"></a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container-md my-5">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card-body p-4 rounded-4" style="background-color: white;">
                        <h3 class="card-title text-center"> Inicio de Sesión</h3>
                        <br>
                        <form action="valida.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="correo" placeholder="Correo" required>
                                <label for="floatingInput">Correo Electrónico</label>
                            </div>
                                
                            <div class="d-grid">
                                <button class="btn btn-secondary btn-lg" type="submit">Entrar</button>
                            </div>

                            <div class="mt-3 col-md-12 text-center">
                                <a href="loginAdmin.php">Ingresa como administrador</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container-fluid p-4">
            <div class="row p-4"> 
                <div class="col-md-6">  
                    <h2>Legal</h2>
                    <ul class="list-unstyled">
                        <li><a class="link-offset-2 link-offset-3-hover link-underline-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">Aviso de Privacidad</a></li>
                        <li><a class="link-offset-2 link-offset-3-hover link-underline-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">Términos y Condiciones</a></li>
                        <li><a class="link-offset-2 link-offset-3-hover link-underline-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">Política de Envíos</a></li>
                        <li><a class="link-offset-2 link-offset-3-hover link-underline-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">Política de Garantía</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Información</h2>
                    <ul class="list-unstyled">
                        <li><a class="link-offset-2 link-offset-3-hover link-underline-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">Preguntas Frecuentes</a></li>
                        <li><a class="link-offset-2 link-offset-3-hover link-underline-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">Rastrear Pedido</a></li>
                        <li><a class="link-offset-2 link-offset-3-hover link-underline-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">Contáctanos</a></li>
                    </ul>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-12">
                    <h2 class="mb-4">¡Síguenos en nuestras redes sociales y sé parte de nuestra comunidad!</h2>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-dark" type="button">¡Inicia tu registro!</button>
                            </div>
                        </div>
                        <div class="col-md-6 ms-auto text-end">
                            <a href="#"><img src="imagenes/facebook.svg" alt="Facebook" class="me-3" style="width: 60px;"></a>
                            <a href="#"><img src="imagenes/icons8-x-logo-50.svg" alt="Twitter" class="me-3" style="width: 33px;"></a>
                            <a href="#"><img src="imagenes/Instagram-Logo.wine.svg" alt="Instagram" class="me-3" style="width: 65px;"></a>     
                        </div>
                    </div> 
                </div>     
            </div>
                
            <div class="position-relative p-5">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <img src="imagenes/visa.png" alt="Visa" class="me-4" style="width: 50px;">     
                    <img src="imagenes/American Express_Logo_0.svg" alt="American Express" class="me-4" style="width: 130px;">
                    <img src="imagenes/PayPal-Logo.wine.svg" alt="PayPal" style="width: 70px;">
                    <img src="imagenes/mc_symbol.svg" alt="MasterCard" class="me-4" style="width: 50px;">
                    <img src="imagenes/Apple_Card-Logo.wine.svg" alt="ApplePay" class="me-4" style="width: 65px;">
                </div>
            </div>
        </div>

        <div class="copyrigth">
            © 2025 Copyright: Mundo Clash Royale
        </div>
    </footer>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const header = document.getElementById('mi-header');
        const umbralScroll = 25; 
        window.addEventListener('scroll', function() {
            
            if (window.scrollY > umbralScroll) {
            header.classList.add('header-solido');
            } else {
            header.classList.remove('header-solido');
            }
        });
        });
    </script>
</body>
</html>