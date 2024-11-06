<?php


class UsuariosControlador{


/**
 * Inicia sesión de usuario. *
 * Esta función realiza el proceso de inicio de sesión de un usuario utilizando las credenciales proporcionadas.
 * Verifica si el usuario existe en la base de datos y, si es así, inicia sesión y establece las variables de sesión correspondientes.
 * Si el usuario no existe o las credenciales son incorrectas, redirige al usuario a la página de inicio de sesión. *
 * @param string $email El correo electrónico del usuario.
 * @param string $pass La contraseña del usuario.
 * @return void
 * @throws Exception Si hay algún error en el proceso de login.
 */

    public function login($email,$pass){
        
        // Validación de entradas
        if (empty($email) || empty($pass)) {
            throw new Exception('El correo electrónico y la contraseña son obligatorios.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('El correo electrónico no es válido.');
        }

        // Manejo de errores durante la inclusión de archivos necesarios
        try {
            require_once "../../../config/conexion.php"; 
            require_once '../../modelo/usuariosModelo.php'; 
        } catch (Exception $e) {
            throw new Exception('Error al incluir archivos necesarios: ' . $e->getMessage());
        }

        // Intentar comprobar el login del usuario
        try{               
            $usuario=new UsuariosModelo();
            $existeUsuario=$usuario->comprobarLogin($email,$pass);

            if($existeUsuario!=0){
                session_start();
                $_SESSION['usuario']=$existeUsuario['nombre'];
                $_SESSION['id_user']=$existeUsuario['id_user'];
                $_SESSION['rol']=$existeUsuario['rol_id'];
                $_SESSION['trastero']=$existeUsuario['trastero_id'];
                header('Location: /trasteros1024/public/index.php');
            }else{
                header('Location: /trasteros1024/app/vista/usuarios/login.php'); 
            }    
            exit();
        }catch(Exception $e){
            echo $e->getMessage();
        }  
    }  //fin login


/**
 * Función para guardar un nuevo usuario en la base de datos.
 * 
 * Este método utiliza el modelo UsuariosModelo para agregar un nuevo usuario
 * a la base de datos. Después de agregar el usuario, redirige a la página de
 * lista de usuarios.
 * 
 * @param string $nombre El nombre del usuario.
 * @param string $apellido1 El primer apellido del usuario.
 * @param string $apellido2 El segundo apellido del usuario.
 * @param string $direccion La dirección del usuario.
 * @param string $telefono El número de teléfono del usuario.
 * @param string $email El correo electrónico del usuario.
 * @param string $pass La contraseña del usuario.
 * @param int $rol El ID del rol del usuario.
 * @return void
 */
    public function guardaUsuario($nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol) {
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('El correo electrónico no es válido.');
    }
    // archivos necesarios con manejo de errores
    try {
        require_once "../../../config/conexion.php";
        require_once '../../modelo/usuariosModelo.php';
    } catch (Exception $e) {
        throw new Exception('Error al incluir archivos necesarios: ' . $e->getMessage());
    }
    
    // Intentar agregar el usuario
    try {
        $usuario = new UsuariosModelo();
        $usuario->agregarUsuario($nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol);
        
    } catch (Exception $e) {
        throw new Exception('Error al guardar el usuario en la base de datos: ' . $e->getMessage());
    }
    
    // Redirigir a la lista de usuarios
    header('Location: usuariosLista.php');
    return true;
    exit(); 
    }//fin guardaUsuario



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
    public function listaUsuarios($pagina, $rol) {
        //filas que queremos mostrar por pagina
        $filasPorPagina=10;

        // Manejo de errores durante la inclusión de archivos necesarios
        try {
            require_once "../../../config/conexion.php";
            require_once "../../modelo/usuariosModelo.php";
        } catch (Exception $e) {
            throw new Exception('Error al incluir archivos necesarios: ' . $e->getMessage());
        }

        // Inicializar el modelo
        $usuario = new UsuariosModelo();

        try {
            // Obtener el total de usuarios y calcular la paginación
            $totalUsuarios = $usuario->filasLista($rol);        
            $totalPaginas = self::numeroPaginas($filasPorPagina,$rol); 
            $filasxPagina = ceil($totalUsuarios / $totalPaginas);
            $paginaInicio = (($pagina - 1) * $filasxPagina);

            // Obtener la lista de usuarios para la página solicitada
            $usuarios = $usuario->getListaUsuarios($paginaInicio, $filasxPagina, $rol);

            // Incluir la vista correspondiente
            require_once "usuariosLista.php";
            
            return $usuarios;
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

    public function numeroPaginas($filasPorPagina,$rol) {
    // Manejo de errores durante la inclusión de archivos necesarios
    try {
        require_once "../../modelo/usuariosModelo.php";
    } catch (Exception $e) {
        throw new Exception('Error al incluir archivos necesarios: ' . $e->getMessage());
    }

    // Inicializar el modelo
    $usuario = new UsuariosModelo();

    try {
        // Obtener el total de usuarios y calcular el número de páginas
        $totalUsuarios = $usuario->filasLista($rol);
        $totalPaginas = ceil($totalUsuarios / $filasPorPagina);

        return $totalPaginas;
        
    } catch (Exception $e) {
        throw new Exception('Error al obtener el total de usuarios: ' . $e->getMessage());
    }
    }//fin numero paginas


/**
* Función para llevarnos al formulario de editar un usuario.
*
* @param int $id El ID del usuario a editar.
* @return array|false Los datos del usuario o false si no se encontró.
*/
    public function editar($id) {
        // Incluir el archivo de configuración y el modelo de usuario
        require_once '../../../config/conexion.php';
        require_once '../../modelo/usuariosModelo.php';

        // Crear una instancia del modelo de usuario
        $usuario = new UsuariosModelo();

        // Obtener los datos del usuario por ID
        $fila = $usuario->getUsuario($id);

        // Si no se encontró el usuario, retornar false
        if (!$fila) {
            return false;
        }

        // Retornar los datos del usuario
        return $fila;
    }


/**
 * Guarda en la base de datos la actualización de un usuario.
 *
 * @param int $id El ID del usuario a actualizar.
 * @param string $nombre El nombre del usuario.
 * @param string $apellido1 El primer apellido del usuario.
 * @param string $apellido2 El segundo apellido del usuario.
 * @param string $direccion La dirección del usuario.
 * @param string $telefono El número de teléfono del usuario.
 * @param string $email La dirección de correo electrónico del usuario.
 * @param string $pass La contraseña del usuario.
 * @param int $rol El ID del rol del usuario.
 * @param int $trastero El ID del trastero asociado al usuario.
 * @return void
 */
    public function actualizar($id, $nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol) {        
        try {   
            require_once ('../../modelo/usuariosModelo.php');
            $usuario = new UsuariosModelo();
            $usuario->editarUsuario($id, $nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol);

            header('Location:usuariosLista.php');
            exit();
        } catch(Exception $e) {
            echo 'Ocurrió un error: ' . $e->getMessage();
        }          
    }

/**
 * Elimina un usuario de la base de datos.
 *
 * @param int $id El ID del usuario a eliminar.
 * @return void
 */
    public function eliminar($id) {
        try {
            require_once ('../../modelo/usuariosModelo.php');
            $usuario = new UsuariosModelo();
            $usuario->eliminarUsuario($id);

            header('Location:usuariosLista.php');
            exit(); 
        } catch (PDOException $e) {
            // Si ocurre un error, podrías redirigir a una página de error o registrar el error
            // Aquí simplemente se muestra el mensaje de error, pero podrías hacer algo más como redirigir o registrar
            echo 'Ocurrió un error al eliminar el usuario: ' . $e->getMessage();
        }
    }

/**
 * Muestra el formulario para crear un nuevo usuario.
 * 
 * Esta función carga la vista 'usuarioNuevo.php', que contiene el formulario HTML para crear un nuevo usuario.
 *
 * @return void
 */
public function nuevoUsuario(){  
    require_once "usuarioNuevo.php";
}  







    public function guardaUsuarioRecibos($nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol,$trastero,$fecha,$pagada) {
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('El correo electrónico no es válido.');
        }
        // archivos necesarios con manejo de errores
        try {
            require_once "../../../config/conexion.php";
            require_once '../../modelo/usuariosModelo.php';
        } catch (Exception $e) {
            throw new Exception('Error al incluir archivos necesarios: ' . $e->getMessage());
        }
        
        // Intentar agregar el usuario
        try {
            $usuario = new UsuariosModelo();
            $usuario->agregarUsuarioRecibo($nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol,$trastero,$fecha,$concepto,$pagada);
        } catch (Exception $e) {
            throw new Exception('Error al guardar el usuario en la base de datos: ' . $e->getMessage());
        }
        
        // Redirigir a la lista de usuarios
        header('Location: usuariosLista.php');
        exit(); 
        }//fin guardaUsuario


     


     
































    



    
    
    //validar email, expresiones regulares

function validarEmail($email) {
    // Expresión regular para correo electrónico
    if(isset($email)){
    $regex = '/^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/';    
    $validar=preg_match($regex, $email);
    }
    if($validar==true){
        return $email;
        
    }else{
        
        echo "<script>alert('El correo electrónico no es válido')</script>";
        return false;
    }

}


function validarTelefono($telefono){
    // Expresión regular para teléfono
    $regex = '/^\d{9}$/';
    $validar=preg_match($regex, $telefono);
    if($validar==true){
        return $telefono;
        
    }else{
        
        echo "<script>alert('El teléfono no es válido')</script>";
        return false;
    }
}


function validarPassword($password) {
    // Comprueba si la contraseña contiene al menos una letra mayúscula, una letra minúscula, un número y tiene al menos 8 caracteres de longitud
    if (preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password) && strlen($password) >= 8) {

        return true;

    } else {

        return false;

       }
}

}



?>