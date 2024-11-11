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
 * cuando carge la pagina nos aparezca el loader
 * 
 
window.addEventListener("DOMContentLoaded", () => {
    showLoader();
  })
  
  window.addEventListener("load", () => {
    setTimeout(() => {
        hideLoader();
      }, 5000);
  })
  
  
  const loader = document.getElementById("loaderPagina");
  const showLoader = () => {
   loader.classList.add("show_loader");
  }
  const hideLoader = () => {
    loader.style.display='flex';
  }*/
