 <?php


class TrasterosControlador{


 /**
 * Muestra el listado de trasteros.
 *
 * Esta función carga el listado de trasteros desde el modelo y lo devuelve.
 *
 * @return array El listado de trasteros.
 */
public function listaTrasteros(){
    require_once "../../../config/conexion.php";
    require_once "../../modelo/trasterosModelo.php";
    
    // Instancia del modelo de trasteros
    $trastero = new TrasterosModelo();
    
    // Obtiene el listado de trasteros
    $trasteros = $trastero->getListaTrasteros();
        
    // Devuelve el listado de trasteros
    return $trasteros;
}

/**
 * Muestra el listado de trasteros.
 *
 * Esta función carga el listado de trasteros desde el modelo y lo devuelve.
 *
 * @return array El listado de trasteros.
 */
public function listaTrasterosAdmin(){
    require_once "../../../config/conexion.php";
    require_once "../../modelo/trasterosModelo.php";
    
    // Instancia del modelo de trasteros
    $trastero = new TrasterosModelo();
    
    // Obtiene el listado de trasteros
    $trasteros = $trastero->getListaTrasterosAdmin();

    // Carga la vista del listado de trasteros
    require_once "trasteros.php";
    
    // Devuelve el listado de trasteros
    return $trasteros;
}

}

    