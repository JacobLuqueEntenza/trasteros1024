<?php


class AveriasControlador
{


    /**
     * Función que muestra el listado de todos los usuarios paginados.
     * 
     * Este método utiliza el modelo UsuariosModelo para obtener una lista de usuarios
     * dividida en páginas. Calcula el número de usuarios por página y el punto de inicio
     * para la página solicitada.
     * 
     * @param int $pagina El número de la página solicitada.
     * @param int $rol El ID del rol de los usuarios que se desea listar.
     * @return array Un arreglo con la lista de usuarios para la página solicitada.
     * @throws Exception Si ocurre un error al incluir archivos necesarios o al obtener los datos.
     */
    public function listaAverias($pagina)
    {
        //filas que queremos mostrar por pagina
        $filasPorPagina= 10;
        
        // Manejo de errores durante la inclusión de archivos necesarios
        try {
            require_once "../../../config/conexion.php";
            require_once "../../modelo/averiasModelo.php";
        } catch (Exception $e) {
            throw new Exception('Error al incluir archivos necesarios: ' . $e->getMessage());
        }

        // Inicializar el modelo
        $averia = new AveriasModelo();

        try {
            // Obtener el total de usuarios y calcular la paginación
            $totalAverias = $averia->filasLista();
            $totalPaginas = self::numeroPaginas($filasPorPagina);
            $filasxPagina = ($totalPaginas > 0) ? $filasPorPagina : $totalAverias; // Evita división por 0
            $paginaInicio = (($pagina - 1) * $filasxPagina);

            // Obtener la lista de usuarios para la página solicitada
            $averias = $averia->getListaAverias($paginaInicio, $filasxPagina);

            // Incluir la vista correspondiente
            require_once "averiasLista.php";

            return $averias;
        } catch (Exception $e) {
            throw new Exception('Error al obtener la lista de usuarios: ' . $e->getMessage());
        }
    }//fin listausuarios



    /**
     * Función para calcular el número total de páginas para la paginación.
     * 
     * Este método utiliza el modelo UsuariosModelo para obtener el número total de usuarios
     * y calcula cuántas páginas se necesitan para mostrar todos los usuarios, asumiendo un
     * número fijo de usuarios por página.
     * 
     * @param int $filasPorPagina El número de usuarios a mostrar por página. Valor por defecto: 10.
     * @return int El número total de páginas necesarias.
     * @throws Exception Si ocurre un error al incluir archivos necesarios o al obtener los datos.
     */

    public function numeroPaginas($filasPorPagina)
    {
        // Manejo de errores durante la inclusión de archivos necesarios
        try {
            require_once "../../modelo/usuariosModelo.php";
        } catch (Exception $e) {
            throw new Exception('Error al incluir archivos necesarios: ' . $e->getMessage());
        }

        // Inicializar el modelo
        $averia = new AveriasModelo();

        try {
            // Obtener el total de usuarios y calcular el número de páginas
            $totalAverias = $averia->filasLista();
            $totalPaginas = ($filasPorPagina > 0) ? ceil($totalAverias / $filasPorPagina) : 1;


            return $totalPaginas;

        } catch (Exception $e) {
            throw new Exception('Error al obtener el total de usuarios: ' . $e->getMessage());
        }
    }//fin numero paginas



    /**
     * Guardar una nueva avería en la base de datos.
     *
     * Esta función se encarga de agregar una nueva avería a la base de datos. 
     * Incluye la lógica para manejar cualquier error que pueda ocurrir al incluir los archivos necesarios 
     * y al intentar guardar los datos de la avería.
     *
     * @param string $fecha La fecha de la avería.
     * @param string $descripcion La descripción de la avería.
     * @param string $estado El estado de la avería.
     * @param int $trastero El ID del trastero asociado a la avería.
     * @throws Exception Si ocurre un error al incluir los archivos necesarios o al guardar la avería en la base de datos.
     */
    public function guardarAveria($fecha, $descripcion, $estado, $trastero)
    {
        // archivos necesarios con manejo de errores
        try {
            require_once "../../config/conexion.php";
            require_once '../modelo/averiasModelo.php';
        } catch (Exception $e) {
            throw new Exception('Error al incluir archivos necesarios: ' . $e->getMessage());
        }

        // Intentar agregar el usuario
        try {
            $usuario = new AveriasModelo();
            $usuario->agregarAveria($fecha, $descripcion, $estado, $trastero);
        } catch (Exception $e) {
            throw new Exception('Error al guardar el usuario en la base de datos: ' . $e->getMessage());
        }

        // Redirigir a la lista de usuarios
        //header('Location: correoAverias.php');
        exit();
    }//fin guardarAveria


    /**
     * Obtener y editar una avería por ID.
     *
     * Esta función se encarga de incluir los archivos de configuración y del modelo necesarios,
     * crear una instancia del modelo de averías, y obtener los datos de una avería específica
     * por su ID. Si la avería no se encuentra, la función retorna false.
     *
     * @param int $id El ID de la avería a editar.
     * @return array|false Retorna un array con los datos de la avería si se encuentra, o false si no.
     */
    public function editar($id)
    {
        // Incluir el archivo de configuración y el modelo de usuario
        require_once '../../../config/conexion.php';
        require_once '../../modelo/averiasModelo.php';

        // Crear una instancia del modelo de usuario
        $averias = new AveriasModelo();

        // Obtener los datos del usuario por ID
        $fila = $averias->getAveria($id);

        // Si no se encontró el usuario, retornar false
        if (!$fila) {
            return false;
        }

        // Retornar los datos del usuario
        return $fila;
    }//fin editar



    /**
     * Actualizar una avería en la base de datos.
     *
     * Esta función incluye el archivo del modelo de averías, crea una instancia del modelo,
     * y llama al método `editarAveria` para actualizar la avería en la base de datos. Luego
     * redirige a la lista de averías. En caso de un error, se captura y muestra un mensaje.
     *
     * @param int $id_averia El ID de la avería a actualizar.
     * @param string $fecha La fecha de la avería.
     * @param string $descripcion La descripción de la avería.
     * @param string $estado El estado de la avería.
     * @param int $trastero El ID del trastero asociado a la avería.
     * @return void
     */
    public function actualizar($id_averia, $fecha, $descripcion, $estado, $trastero)
    {
        try {
            require_once('../../modelo/averiasModelo.php');
            $averia = new AveriasModelo();
            $averia->editarAveria($id_averia, $fecha, $descripcion, $estado, $trastero);

            header('Location:averiasLista.php');
            exit();
        } catch (Exception $e) {
            echo 'Ocurrió un error al actualizar recibo ' . $e->getMessage();
        }
    }//fin actualizar



    public function eliminar($id)
    {
        try {
            require_once('../../modelo/averiasModelo.php');
            $averia = new AveriasModelo();
            $averia->eliminarAveria($id);

            header('Location:averiasLista.php');
            exit();
        } catch (PDOException $e) {
            // Si ocurre un error, podrías redirigir a una página de error o registrar el error
            // Aquí simplemente se muestra el mensaje de error, pero podrías hacer algo más como redirigir o registrar
            echo 'Ocurrió un error al eliminar el usuario: ' . $e->getMessage();
        }
    }//fin eliminar




    function correoTrastero($id)
    {
        require_once('../modelo/averiasModelo.php');
        $averia = new AveriasModelo();
        $trastero = $averia->getCorreoTrasteros($id);
        if (!$trastero) {
            return false;
        }
        // Retornar los datos del trastero
        return $trastero;
    }





}