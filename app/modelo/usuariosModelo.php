<?php



class UsuariosModelo
{

	private $db;

	/**
	 * Constructor de la clase UsuariosModelo.
	 * 
	 * Inicializa una nueva instancia de la clase y establece la conexión a la base de datos.
	 */
	public function __construct()
	{
		try {
			// Inicializar la conexión a la base de datos
			$this->db = new Conexion();
			$this->db->conectar();
		} catch (PDOException $e) {
			// Manejar cualquier error de conexión a la base de datos
			throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
		}
	}

	/**
	 * Comprueba el inicio de sesión. *
	 * Esta función busca en la base de datos un usuario con las credenciales proporcionadas. *
	 * @param string $email El correo electrónico del usuario.
	 * @param string $pass La contraseña del usuario.
	 * @return array|false Retorna un arreglo asociativo con la información del usuario si las credenciales son válidas, o false si no se encuentra ningún usuario con esas credenciales.
	 */
	public function comprobarLogin($email, $pass)
	{
		$sql = "	SELECT u.nombre, u.id_user, u.rol_id,u.email,u.pass, r.trastero_id
				FROM users u 
				LEFT JOIN recibos r ON id_user=user_id 
				WHERE email= :email";
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);
		$consulta->bindParam(':email', $email);
		$consulta->execute();
		$usuario = $consulta->rowCount();
		$usuario = $consulta->fetch(PDO::FETCH_ASSOC);

		return $usuario;
	}// fin comprobarLogin



	/**
	 * Cuenta el número total de filas en la base de datos para un rol específico.
	 *
	 * Esta función realiza una consulta SQL para contar el número total de filas en la base de datos
	 * que coinciden con el rol especificado. Devuelve el número total de filas encontradas.
	 *
	 * @param int $rol El ID del rol para el cual contar las filas.
	 * @return int El número total de filas para el rol especificado.
	 */
	public function filasLista($rol)
	{
		// Construir la consulta SQL
		$sql = "SELECT u.id_user, u.nombre, u.apellido_1, u.apellido_2, u.direccion, u.telefono, u.email, u.pass, u.rol_id, r.rol 
				FROM users u 
				INNER JOIN roles r ON u.rol_id = r.id_rol
				WHERE $rol";
		// Preparar la consulta SQL
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);

		// Ejecutar la consulta
		$consulta->execute();

		// Obtener y devolver el número total de filas
		$totalFilas = $consulta->rowCount();

		return $totalFilas;
	}//fin filaslista



	/**
	 * Obtiene un listado de usuarios según la paginación y el rol especificados.
	 *
	 * Esta función realiza una consulta SQL para obtener un listado de usuarios basado en la paginación
	 * y el rol proporcionados. Devuelve un array con la información de los usuarios.
	 *
	 * @param int $paginaInicio El índice de la fila inicial a partir del cual se obtendrán los usuarios.
	 * @param int $filasxPagina El número máximo de filas a devolver en la consulta.
	 * @param int $rol El ID del rol de los usuarios a obtener.
	 * @return array Un array asociativo con la información de los usuarios.
	 */
	public function getListaUsuarios($paginaInicio, $filasxPagina, $rol)
	{
		// Construir la consulta SQL
		$sql = "SELECT u.id_user, u.nombre, u.apellido_1, u.apellido_2, u.direccion, u.telefono, u.email,u.pass, u.rol_id, r.rol 
			  FROM users u 
			  INNER JOIN roles r ON u.rol_id = r.id_rol 
			  WHERE $rol
			  ORDER BY u.id_user ASC
			  LIMIT $paginaInicio,$filasxPagina";

		// Preparar la consulta SQL
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);

		// Ejecutar la consulta
		$consulta->execute();

		// Obtener y devolver los resultados
		$usuario = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $usuario;
	}//fin listausuarios


	/**
	 * Crear un nuevo usuario.
	 *
	 * @param string $nombre El nombre del usuario.
	 * @param string $apellido1 El primer apellido del usuario.
	 * @param string $apellido2 El segundo apellido del usuario.
	 * @param string $direccion La dirección del usuario.
	 * @param string $telefono El número de teléfono del usuario.
	 * @param string $email La dirección de correo electrónico del usuario.
	 * @param string $pass La contraseña del usuario.
	 * @param int $rol El rol del usuario (por ejemplo, 1 para admin, 2 para cliente, 3 para usuario).
	 * @return bool true si el usuario fue creado exitosamente, false en caso contrario.
	 */
	public function agregarUsuario($nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol)
	{

		// Hash de la contraseña
		//$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

		// SQL para insertar el nuevo usuario
		$sql = "INSERT INTO users (nombre, apellido_1, apellido_2, direccion, telefono, email, pass, rol_id) VALUES (:nombre, :apellido1, :apellido2, :direccion, :telefono, :email, :pass, :rol)";

		try {
			// Conectar a la base de datos
			$conectar = $this->db->conectar();
			$consulta = $conectar->prepare($sql);
			// Vincular los parámetros
			$consulta->bindParam(':nombre', $nombre);
			$consulta->bindParam(':apellido1', $apellido1);
			$consulta->bindParam(':apellido2', $apellido2);
			$consulta->bindParam(':direccion', $direccion);
			$consulta->bindParam(':telefono', $telefono);
			$consulta->bindParam(':email', $email);
			$consulta->bindParam(':pass', $pass);//cambiar a $hashedPass
			$consulta->bindParam(':rol', $rol);

			// Ejecutar la consulta
			$consulta->execute();
		} catch (PDOException $e) {
			// Manejo de errores
			error_log("Error al agregar usuario: " . $e->getMessage());
			return false;
		}
	}//fin agregarusuario

	/**
	 * Obtiene la información de un usuario por su ID.
	 *
	 * @param int $id El ID del usuario.
	 * @return array|false Un array asociativo con los datos del usuario si se encuentra, o false si no se encuentra.
	 */
	public function getUsuario($id)
	{
		// Construir la consulta SQL
		$sql = "SELECT * FROM users WHERE id_user = :id";
		// Conectar a la base de datos
		$conectar = $this->db->conectar();
		// Preparar la consulta SQL
		$consulta = $conectar->prepare($sql);
		$consulta->bindParam(':id', $id, PDO::PARAM_INT);
		// Ejecutar la consulta
		$consulta->execute();
		// Obtener y devolver el resultado de la consulta
		$usuario = $consulta->fetch(PDO::FETCH_ASSOC);
		return $usuario;
	}//fin getUsuario


	/**
	 * Modifica un usuario en la base de datos.
	 *
	 * @param int $id El ID del usuario a modificar.
	 * @param string $nombre El nombre del usuario.
	 * @param string $apellido1 El primer apellido del usuario.
	 * @param string $apellido2 El segundo apellido del usuario.
	 * @param string $direccion La dirección del usuario.
	 * @param string $telefono El número de teléfono del usuario.
	 * @param string $email La dirección de correo electrónico del usuario.
	 * @param string $pass La contraseña del usuario.
	 * @param int $rol El ID del rol del usuario.
	 * @param int $trastero El ID del trastero asociado al usuario.
	 * @return bool true si la modificación fue exitosa, false en caso contrario.
	 */
	public function editarUsuario($id, $nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol)
	{
		$sql = "UPDATE users SET nombre = :nombre, apellido_1 = :apellido1, apellido_2 = :apellido2, direccion = :direccion, telefono = :telefono, email = :email, pass = :pass, rol_id = :rol WHERE id_user = :id";

		try {
			$conectar = $this->db->conectar();
			$consulta = $conectar->prepare($sql);
			$consulta->bindParam(':id', $id);
			$consulta->bindParam(':nombre', $nombre);
			$consulta->bindParam(':apellido1', $apellido1);
			$consulta->bindParam(':apellido2', $apellido2);
			$consulta->bindParam(':direccion', $direccion);
			$consulta->bindParam(':telefono', $telefono);
			$consulta->bindParam(':email', $email);
			$consulta->bindParam(':pass', $pass);
			$consulta->bindParam(':rol', $rol);
			$consulta->execute();
			return true; //modificacion realizada con exito
		} catch (PDOException $e) {
			error_log("Error al modificar usuario: " . $e->getMessage());
			return false; // La modificación falló
		}
	}//fin editarUsuario



	/**
	 * Elimina un usuario de la base de datos.
	 *
	 * @param int $id El ID del usuario a eliminar.
	 * @return void
	 */
	public function eliminarUsuario($id)
	{

		try {
			$sql = "DELETE FROM users WHERE id_user = :id";
			$conectar = $this->db->conectar();
			$consulta = $conectar->prepare($sql);
			$consulta->bindParam(':id', $id);
			$consulta->execute();

			// Verificar si se eliminó alguna fila
			if ($consulta->rowCount() > 0) {
				echo "Usuario eliminado correctamente";
			} else {
				echo "No se encontró ningún usuario con ese ID";
			}
		} catch (PDOException $e) {
			echo "Error al eliminar usuario: " . $e->getMessage();
		}
	}//fin eliminarUsuario



	/**
	 * Obtiene el número de correos electrónicos repetidos en la base de datos.
	 *
	 * Esta función realiza una consulta SQL para contar el número de veces que aparece un correo electrónico específico en la tabla de usuarios.
	 *
	 * @param string $email El correo electrónico que se desea verificar si está repetido.
	 * @return int El número de veces que aparece el correo electrónico en la base de datos.
	 */
	public function emailRepetido($email)
	{
		$sql = "SELECT COUNT(*) AS total FROM users WHERE email=?";
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);
		$consulta->execute([$email]);
		$resultado = $consulta->fetch(PDO::FETCH_ASSOC);

		return $resultado['total'];
	}//fin emailRepetido







	public function agregarUsuarioRecibo($nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol, $trastero, $fecha, $pagada)
	{
		// Hash de la contraseña
		$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

		// SQL para insertar en la tabla users
		$sql = "INSERT INTO users (nombre, apellido_1, apellido_2, direccion, telefono, email, pass, rol_id) 
				VALUES (:nombre, :apellido1, :apellido2, :direccion, :telefono, :email, :pass, :rol)";

		// SQL para insertar en la tabla recibos
		$sql2 = "INSERT INTO recibos (user_id, trastero_id, fecha, concepto, pagado) 
				 VALUES (:user_id, :trastero, :fecha, :concepto, :pagado)";

		try {
			// Conectar a la base de datos y comenzar la transacción
			$conectar = $this->db->conectar();
			$conectar->beginTransaction();

			// Preparar y ejecutar la inserción en la tabla users
			$consulta = $conectar->prepare($sql);
			$consulta->bindParam(':nombre', $nombre);
			$consulta->bindParam(':apellido1', $apellido1);
			$consulta->bindParam(':apellido2', $apellido2);
			$consulta->bindParam(':direccion', $direccion);
			$consulta->bindParam(':telefono', $telefono);
			$consulta->bindParam(':email', $email);
			$consulta->bindParam(':pass', $hashedPass); // Cambiado a $hashedPass
			$consulta->bindParam(':rol', $rol);
			$consulta->execute();

			// Obtener el ID del usuario recién insertado
			$userId = $conectar->lastInsertId();

			// Preparar y ejecutar la inserción en la tabla recibos
			$concepto = "Alquiler de trastero"; // Ajusta el concepto según sea necesario
			$consulta2 = $conectar->prepare($sql2);
			$consulta2->bindParam(':user_id', $userId);
			$consulta2->bindParam(':trastero', $trastero);
			$consulta2->bindParam(':fecha', $fecha);
			$consulta2->bindParam(':concepto', $concepto);
			$consulta2->bindParam(':pagado', $pagada);
			$consulta2->execute();

			// Confirmar la transacción
			$conectar->commit();
			return true;

		} catch (PDOException $e) {
			// Revertir la transacción en caso de error
			$conectar->rollBack();
			// Manejo de errores
			error_log("Error al agregar usuario: " . $e->getMessage());
			return false;
		}
	} // fin de agregarUsuarioRecibo















}


?>