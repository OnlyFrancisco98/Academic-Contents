<?php require '../templates/header.php'; ?>

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold">Contáctanos</h1>

    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card h-100 p-4 border-0 rounded-4" style="background-color: rgba(223, 223, 223, 1);">
                <h3 class="mb-4">Información</h3>
                <p>¿Tienes dudas o comentarios? Estamos aquí para ayudarte.</p>
                
                <div class="mt-4">
                    <p class="mb-2"><strong>📍 Dirección:</strong></p>
                    <p>C 26c, Umán, Yucatán</p>
                </div>
                
                <div class="mt-4">
                    <p class="mb-2"><strong>📧 Email:</strong></p>
                    <p>contacto@mundoclash.com</p>
                </div>

                <div class="mt-4">
                    <p class="mb-2"><strong>📱 Teléfono:</strong></p>
                    <p>+52 (99) 9743 0265</p>
                </div>

                <div class="mt-auto pt-4">
                    <small>Horario de atención: Lunes a Viernes de 9am a 6pm</small>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card p-4 shadow-sm border-0 rounded-4">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="Tu nombre">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="nombre@ejemplo.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Asunto</label>
                            <select class="form-select">
                                <option>Consulta General</option>
                                <option>Soporte Técnico</option>
                                <option>Problema con un pedido</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mensaje</label>
                            <textarea class="form-control" rows="5" placeholder="¿En qué podemos ayudarte?"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Enviar Mensaje</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require '../templates/footer.php'; ?>