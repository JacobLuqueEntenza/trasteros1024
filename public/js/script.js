/**
 * Funcionalidad para filtrar la lista de usuarios por la opción seleccionada del select.
 * 
 * Esta función se encarga de almacenar y recuperar el valor seleccionado del select del filtro
 * en el almacenamiento local del navegador. Cuando se selecciona una opción, se envía el formulario
 * para filtrar la lista de usuarios según la opción seleccionada.
 */
$(document).ready(function() {
    // Recupera el valor seleccionado desde localStorage
    var selectedOption = localStorage.getItem('selectedOption');
    
    if (selectedOption) {
        // Establece el valor seleccionado en el elemento select
        $('#tipoUsers').val(selectedOption);
    }

    // Maneja el cambio de opción en el select
    $("#tipoUsers").change(function() {
        // Guarda el valor seleccionado en localStorage
        var selectedValue = $(this).val();
        localStorage.setItem('selectedOption', selectedValue);
        
        // Envía el formulario
        $("#formUsers").submit();
    });
});



/**
 * Filtra y muestra solo los trasteros que están disponibles en la tabla de trasteros.
 * 
 * Esta función recorre todas las filas de la tabla de trasteros y oculta aquellas filas cuyo trastero no esté disponible.
 * La disponibilidad se determina verificando el contenido de la columna "Disponible".
 */
function mostrarTrasterosDisponibles() {

    var tabla = document.getElementById("tablaTrasteros");
    var filas = tabla.getElementsByTagName("tr");
    
    for (var i = 1; i < filas.length; i++) { // Empezamos desde 1 para evitar la fila de encabezado
        var celdaDisponible = filas[i].getElementsByTagName("td")[4]; // La columna "Disponible" es la quinta (índice 4)
        var disponible = celdaDisponible.textContent || celdaDisponible.innerText;
        
        if (disponible.trim() !== "Si") { // Si está disponible
            filas[i].style.display = "none"; // Ocultar la fila
        }
    }
}



/**
 * Refresca la página actual.
 * 
 * Esta función recarga la página actual, lo que permite actualizar su contenido.
 */

function refrescarPagina() {
    location.reload(true); // Esto recarga la página
    
};




/**
 * Función para seleccionar una opción de pago.
 * 
 * Esta función se ejecuta cuando se carga la ventana y asigna manejadores de eventos a los cambios en los elementos de selección.
 * Cuando se cambia la opción de pago, se asegura de que solo una opción esté seleccionada a la vez.
 */
window.onload = function seleccionarCheck(){
        
    $('#banco').on('change',function(ev){
        ev.preventDefault();
        $('#banco').prop('checked',true);
        $('#bizum').prop('checked',false);
        $('#efectivo').prop('checked',false);   
    });
    $('#bizum').on('change',function(ev){
        ev.preventDefault();
        $('#banco').prop('checked',false);
        $('#bizum').prop('checked',true);
        $('#efectivo').prop('checked',false);   
    });
    $('#efectivo').on('change',function(ev){
        ev.preventDefault();
        $('#banco').prop('checked',false);
        $('#bizum').prop('checked',false);
        $('#efectivo').prop('checked',true);   
    });
};

/**
 * resetear los campos de fecha de recibos
 */
function borrarFechas() {
    window.location='recibosLista.php';
  };


/**
 * mostrar los videos en la etiquita video
 */
function mostrarVideo(url) {
    var video = document.getElementById("video");
    video.src = url;
    video.style.display = "block";
    video.load();
    video.play();
};

/**
 * modal de asignar trastero
 */
document.addEventListener('DOMContentLoaded', () => {
    const rolSelect = document.getElementById('rolSelect');
    const modalAsignarTrastero = new bootstrap.Modal(document.getElementById('modalAsignarTrastero'));
    const numeroTrasteroModal = document.getElementById('numeroTrasteroModal');
    const numeroTrasteroOculto = document.getElementById('numeroTrasteroOculto');
    const modalUserId = document.getElementById('idCliente'); // Campo oculto en el modal
    const formUserId = document.getElementById('id'); // Campo del formulario
    
    // Mostrar el modal al seleccionar "Cliente"
    rolSelect.addEventListener('change', function () {
        if (this.value == 2) { // Valor de "Cliente"
            modalUserId.value = formUserId.value; // Pasar el ID del formulario al modal
            modalAsignarTrastero.show();
        }
    });

 /*    

    // Transferir el valor del modal al campo oculto al presionar "Guardar"
    document.getElementById('guardarTrastero').addEventListener('click', () => {
        const numeroTrastero = numeroTrasteroModal.value;
        if (numeroTrastero) {
            numeroTrasteroOculto.value = numeroTrastero;
            alert('Número de trastero asignado correctamente.');           
            modalAsignarTrastero.hide();
        } else {
            alert('Por favor, ingrese un número de trastero.');
        };
    });
     //rolSelect.value = "2"; // Valor asociado al rol de "Cliente"
*/

});

