<?php
class RecibosControlador
{

    /**
     * Función que muestra el listado de recibos con paginación.
     *
     * @param int $pagina Número de la página actual.
     * @param string $id_usuario Condición de filtrado para el usuario (e.g., 'id_user=1').
     * @param string $fechas Condición de filtrado para el rango de fechas (e.g., 'AND fecha BETWEEN "2023-01-01" AND "2023-12-31"').
     * @return array Listado de recibos para la página especificada.
     */
    public function listaRecibos($pagina, $id_usuario, $fechas)
    {
        // Incluir los archivos necesarios
        require_once "../../../config/conexion.php";
        require_once "../../modelo/recibosModelo.php";
        // Instanciar el modelo de recibos
        $recibos = new RecibosModelo();
        // Obtener el número total de recibos con los filtros aplicados
        $totalRecibos = $recibos->filasLista($id_usuario, $fechas);
        // Calcular el número total de páginas
        $filasPorPagina = 10; // ajustar este valor según necesidades, en un futuro ponerlo a elegir
        $totalPaginas = max(1, ceil($totalRecibos / $filasPorPagina));
        // Calcular el índice de inicio para la paginación
        $paginaInicio = ($pagina - 1) * $filasPorPagina;
        // Obtener el listado de recibos para la página actual
        $listaRecibos = $recibos->getListaRecibos($paginaInicio, $filasPorPagina, $id_usuario, $fechas);
        // Incluir la vista para mostrar los recibos
        require_once "recibosLista.php";
        // Devolver el listado de recibos
        return $listaRecibos;
    }//fin listaRecibos

    /**
     * Calcula el número total de páginas basado en la cantidad de recibos y filas por página.
     *
     * @param string $id_usuario Condición para filtrar por usuario.
     * @param string $fechas Condición para filtrar por fechas.
     * @return int El número total de páginas.
     */

    public function numeroPaginas($id_usuario, $fechas)
    {
        $filasxPagina = 10;
        $recibo = new RecibosModelo();
        $totalRecibos = $recibo->filasLista($id_usuario, $fechas);
        $totalPaginas = ($totalRecibos > 0) ? ceil($totalRecibos / $filasxPagina) : 1;

        return $totalPaginas;
    }//fin numeroPaginas




    /**
     * Obtiene los datos de un usuario por su ID para crear un recibo nuevo.
     *
     * @param int $id El ID del usuario.
     * @return array|false Un array asociativo con los datos del recibo si se encuentra, o false si no se encuentra.
     */
    public function editarUsuario($id)
    {
        // Incluir el archivo de configuración y el modelo de usuario
        require_once '../../../config/conexion.php';
        require_once '../../modelo/recibosModelo.php';

        // Crear una instancia del modelo de usuario
        $recibos = new RecibosModelo();

        // Obtener los datos del usuario por ID
        $fila = $recibos->getUsuarios($id);

        // Si no se encontró el usuario, retornar false
        if (!$fila) {
            return false;
        }

        // Retornar los datos del usuario
        return $fila;
    }//fin editar




    /**
     * Función para guardar un nuevo recibo en la base de datos.
     *
     * @param string $fecha La fecha del recibo.
     * @param int $pagada Estado de pago del recibo (0 o 1).
     * @param string $formaPago La forma de pago del recibo.
     * @param int $id_user El ID del usuario asociado al recibo.
     * @param int $trastero El ID del trastero asociado al recibo.
     */
    public function guardarRecibo($fecha, $pagada, $formaPago, $id_user, $trastero, $concepto)
    {
        // Incluir los archivos necesarios
        require_once "../../../config/conexion.php";
        require_once '../../modelo/recibosModelo.php';

        
        // Instanciar el modelo de recibos
        $recibos = new RecibosModelo();
        // Verificar si el ID está vacío
		
        // Guardar el nuevo recibo en la base de datos
        $recibos->nuevoRecibo($fecha, $pagada, $formaPago, $id_user, $trastero, $concepto);
    
        // Redirigir a la lista de recibos después de guardar
        //header('Location: recibosLista.php#tablaRecibos');
    }//fin guardarRecibo

    public function asignarTrastero($fecha, $id_user, $trastero, $concepto)
    {
        // Incluir los archivos necesarios
        require_once "../../../config/conexion.php";
        require_once '../../modelo/recibosModelo.php';

        // Instanciar el modelo de recibos
        $recibos = new RecibosModelo();

        // Guardar el nuevo recibo en la base de datos
        $recibos->trasteroAsignado($fecha, $id_user, $trastero, $concepto);
        //cambiamos el rol de cliente 
        $recibos->cambioRol($id_user);
    }//fin asignarTrastero

    public function liberarTrastero($id_user)
    {
        // Incluir los archivos necesarios
        require_once "../../../config/conexion.php";
        require_once '../../modelo/recibosModelo.php';

        // Instanciar el modelo de recibos
        $recibos = new RecibosModelo();       
        //cambiamos el rol de cliente 
        $recibos->cambioRolUser($id_user);
    }//fin guardarRecibo

    /**
     * Obtiene los datos de un recibo por su ID para su edición.
     *
     * @param int $id El ID del recibo.
     * @return array|false Un array asociativo con los datos del recibo si se encuentra, o false si no se encuentra.
     */
    public function editar($id)
    {
        // Incluir el archivo de configuración y el modelo de usuario
        require_once '../../../config/conexion.php';
        require_once '../../modelo/recibosModelo.php';

        // Crear una instancia del modelo de usuario
        $recibos = new RecibosModelo();

        // Obtener los datos del usuario por ID
        $fila = $recibos->getRecibo($id);

        // Si no se encontró el usuario, retornar false
        if (!$fila) {
            return false;
        }

        // Retornar los datos del usuario
        return $fila;
    }//fin editar

    /**
     * Actualiza un recibo con los nuevos datos proporcionados.
     *
     * @param string $fecha La nueva fecha del recibo.
     * @param int $pagada El nuevo estado de pago del recibo (0 o 1).
     * @param string $formaPago La nueva forma de pago del recibo.
     * @param int $id_user El nuevo ID del usuario asociado al recibo.
     * @param int $trastero El nuevo ID del trastero asociado al recibo.
     */
    public function actualizar($id_recibo, $fecha, $concepto, $pagada, $formaPago)
    {
        try {
            require_once('../../modelo/recibosModelo.php');
            $usuario = new RecibosModelo();
            $usuario->editarRecibo($id_recibo, $fecha, $concepto, $pagada, $formaPago);

            header('Location:recibosLista.php');
            exit();
        } catch (Exception $e) {
            echo 'Ocurrió un error al actualizar recibo ' . $e->getMessage();
        }
    }//fin actualizar


    /**
     * Eliminar un recibo de la base de datos.
     *
     * Esta función incluye el archivo del modelo de recibos, crea una instancia del modelo,
     * y llama al método `eliminarRecibo` para eliminar el recibo de la base de datos. Luego
     * redirige a la lista de recibos. En caso de un error, se captura y muestra un mensaje.
     *
     * @param int $id El ID del recibo a eliminar.
     * @return void
     */
    public function eliminar($id)
    {
        try {
            require_once('../../modelo/recibosModelo.php');
            $usuario = new RecibosModelo();
            $usuario->eliminarRecibo($id);

            header('Location:recibosLista.php');
            exit();
        } catch (PDOException $e) {
            // Si ocurre un error, podrías redirigir a una página de error o registrar el error
            // Aquí simplemente se muestra el mensaje de error, pero podrías hacer algo más como redirigir o registrar
            echo 'Ocurrió un error al eliminar el usuario: ' . $e->getMessage();
        }//fin eliminar
    }



}