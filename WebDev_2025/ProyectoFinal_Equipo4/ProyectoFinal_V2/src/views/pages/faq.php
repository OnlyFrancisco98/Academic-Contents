<?php require '../templates/header.php'; ?>

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold">Preguntas Frecuentes</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="accordion" id="faqAccordion">
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cuáles son los métodos de pago aceptados?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Aceptamos tarjetas de crédito y débito (Visa, Mastercard, American Express), PayPal y pagos en efectivo a través de Oxxo.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            ¿Cómo puedo cancelar mi pedido?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Puedes cancelar tu pedido desde la sección "Mis Pedidos" siempre y cuando el estatus sea "Pendiente". Si ya fue enviado, deberás iniciar un proceso de devolución.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            ¿Los productos son originales?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Sí, todos nuestros productos son oficiales o licenciados y cuentan con garantía de autenticidad.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require '../templates/footer.php'; ?>