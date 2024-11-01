<?php 
    // Incluir el header 
    include '../app/vista/layouts/header.php';  
?>
<div id="loaderPagina" class="section_loader">
    <div class="loader">
      <div class="loader_1"></div>
      <div class="loader_2"></div>
    </div>
  </div>
<section class="principal">        
        <h2 id="titulo">tutrasteroenhuelva.es</h2>
        <h3 id="parrafo">Simplifica tu almacenamiento y mantén tus pertenencias seguras con nuestros trasteros en alquiler.</h3>
        <div class="botones">            
            <button onclick="window.location.href='/proyecto-daw/app/vista/trasteros/trasteros.php#situacionTrasteros' ">Explorar Trasteros</button>
        </div>
</section>
<section class="catalogo">
        <h1>Alquiler de Trasteros</h1>
        <div class="contenedorTarjetas">
            <div class="tarjeta">
                <h3>Tamaños Disponibles</h3>
                <p>Desde pequeños hasta extra grandes, tenemos una variedad de trasteros para cubrir todas tus necesidades de almacenamiento.</p>
            </div>
            <div class="tarjeta">
                <h3>Ubicaciones Estratégicas</h3>
                <p>Nuestros trasteros están ubicados en lugares convenientes y de fácil acceso en toda la ciudad.</p>
            </div>
            <div class="tarjeta">
                <h3>Seguridad Garantizada</h3>
                <p>Tus pertenencias estarán protegidas con nuestros sistemas de vigilancia y acceso controlado.</p>
            </div>
        </div>
</section>

<section class="alquiler">        
        <h2>Proceso de Alquiler</h2> 
        <div class="divAlquiler">
            <div class="tarjeta" id="tarj-1">1</div>            
            <div class="tarjeta">            
                <h3>Selección</h3>            
                <p>Elige el trastero que mejor se ajuste a tus necesidades y presupuesto.</p>
            </div>
            <img src="img/flechaAbj.png" alt="flechaDerecha">
            <div class="tarjeta" id="tarj-2">2</div>            
            <div class="tarjeta" >            
                <h3>Registro</h3>            
                <p>Completa el formulario de registro y firma el contrato de alquiler.</p>
            </div>
            <img src="img/flechaAbj.png" alt="flechaDerecha">
            <div class="tarjeta" id="tarj-3">3</div>            
            <div class="tarjeta" >            
                <h3>Seguridad Garantizada</h3>            
                <p>Recibe tu llave y comienza a utilizar tu trastero de manera segura.</p>
            </div>
        </div>    
</section>
<section class="cobros">
        <h2>Cobro de Recibos y Facturación</h2>
        <div class="divCobros">
            <div class="tarjeta">
                <h3>Pagos Automáticos</h3>
                <p>Configura el pago automático de tus recibos para evitar retrasos.</p>
            </div>
            <div class="tarjeta">
                <h3>Recordatorios de Vencimiento</h3>
                <p>Recibe notificaciones oportunas sobre tus próximos pagos.</p>
            </div>
            <div class="tarjeta">
                <h3>Historial de Pagos</h3>
                <p>Accede fácilmente a tus registros de pagos en línea.</p>
            </div>
            <div class="tarjeta">
                <h3>Opciones de Pago</h3>
                <p>Paga en efectivo, tarjeta de crédito, bizum o transferencia bancaria.</p>
            </div>
        </div>
</section>

<section class="contactos">
        <h1>Contacto y Soporte</h1>
        <div class="divContacto">
            <div class="tarjeta">
                <div class="divImg">
                    <img src="img/gmail.png" alt="gmail">
                    <img src="img/outlook.png" alt="outlook">
                </div>    
                <h3>Correo Electrónico</h3>
                <p>Envíanos tus consultas y solicitudes a tutrasteroenhuelva@gmail.com</p>
            </div>
            <div class="tarjeta">
                <div class="divImg">
                    <img src="img/telefono.png" alt="telefono">
                    <img src="img/whatapp.png" alt="whatapp">
                </div>
                <h3>Línea de Atención</h3>
                <p>Llámanos al 555-1234 para obtener asistencia personalizada.</p>
            </div>
        </div>
</section>

<section class="mapa">
        <h2>Donde Estamos:</h2>
        <div class="tarjeta">
            <p>Nuestras instalaciones se encuantra ubicada en local comercial con salida a dos calles, de fácil acceso.</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2618.5861172929244!2d-6.943239264047862!3d37.281381421458924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd11cfc22776e743%3A0x827feb3310ef61c!2sC.%20Legi%C3%B3n%20Espa%C3%B1ola%2C%206%2C%2021005%20Huelva!5e0!3m2!1ses!2ses!4v1714458476831!5m2!1ses!2ses"style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div> 
</section>

<?php 
    // Incluir el header 
    include '../app/vista/layouts/footer.php';    
?>

