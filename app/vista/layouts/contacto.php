<?php
include('../layouts/headerFormularios.php');


?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Contacto</h1>
    <p class="h5 text-center mb-4">¿Tienes alguna consulta? Escríbenos y nos pondremos en contacto contigo.</p>
    <form class="mx-auto" style="max-width: 600px;">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" placeholder="nombre@ejemplo.com" required>
        </div>
        <div class="mb-3">
            <label for="asunto" class="form-label">Asunto</label>
            <input type="text" class="form-control" id="asunto" placeholder="¿De qué se trata tu consulta?" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" rows="4" placeholder="Escribe tu mensaje aquí..." required></textarea>
        </div>
        <div class="form-group text-center mt-4 d-flex justify-content-between">
            <button type="submit" class="btn btn-success w-25">Enviar</button>
            <button type="button" class="btn btn-secondary w-25" onclick="location.href='../../../public/index.php'" >Cancelar</button>
        </div>
    </form>
</div>
