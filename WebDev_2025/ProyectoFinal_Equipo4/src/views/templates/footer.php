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
                            <a href="#"><img src="../../../public/imagenes/facebook.svg" alt="Facebook" class="me-3" style="width: 60px;"></a>
                            <a href="#"><img src="../../../public/imagenes/icons8-x-logo-50.svg" alt="Twitter" class="me-3" style="width: 33px;"></a>
                            <a href="#"><img src="../../../public/imagenes/Instagram-Logo.wine.svg" alt="Instagram" class="me-3" style="width: 65px;"></a>     
                        </div>
                    </div> 
                </div>     
            </div>
                
            <div class="position-relative p-5">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <img src="../../../public/imagenes/visa.png" alt="Visa" class="me-4" style="width: 50px;">     
                    <img src="../../../public/imagenes/American Express_Logo_0.svg" alt="American Express" class="me-4" style="width: 130px;">
                    <img src="../../../public/imagenes/PayPal-Logo.wine.svg" alt="PayPal" style="width: 70px;">
                    <img src="../../../public/imagenes/mc_symbol.svg" alt="MasterCard" class="me-4" style="width: 50px;">
                    <img src="../../../public/imagenes/Apple_Card-Logo.wine.svg" alt="ApplePay" class="me-4" style="width: 65px;">
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