<?php



class AveriasModelo
{

	private $db;
	/**
	 * Constructor de la clase AveriasModelo.
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
	 * Cuenta el número total de filas en la base de datos para un rol específico.
	 *
	 * Esta función realiza una consulta SQL para contar el número total de filas en la base de datos
	 * que coinciden con el rol especificado. Devuelve el número total de filas encontradas.
	 *
	 * @param int $rol El ID del rol para el cual contar las filas.
	 * @return int El número total de filas para el rol especificado.
	 */
	public function filasLista()
	{
		// Construir la consulta SQL
		$sql = "SELECT *
            FROM averias";
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
	public function getListaAverias($paginaInicio, $filasxPagina)
	{
		// Construir la consulta SQL
		$sql = "  SELECT  *
            FROM averias
            ORDER BY fecha DESC
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
	 * Función para agregar una nueva avería en la base de datos.
	 *
	 * @param string $fecha La fecha de la avería.
	 * @param string $descripcion La descripción de la avería.
	 * @param string $estado El estado de la avería.
	 * @param int $trastero El ID del trastero asociado con la avería.
	 * @return bool Retorna true si la inserción fue exitosa, de lo contrario false.
	 */
	public function agregarAveria($fecha, $descripcion, $estado, $trastero)
	{

		// SQL para insertar el nuevo usuario
		$sql = "INSERT INTO averias (fecha, descripcion, estado, trastero_id) VALUES (:fecha, :descripcion, :estado, :trastero)";

		try {
			// Conectar a la base de datos
			$conectar = $this->db->conectar();
			$consulta = $conectar->prepare($sql);
			// Vincular los parámetros
			$consulta->bindParam(':fecha', $fecha);
			$consulta->bindParam(':descripcion', $descripcion);
			$consulta->bindParam(':estado', $estado);
			$consulta->bindParam(':trastero', $trastero);

			// Ejecutar la consulta
			$consulta->execute();
		} catch (PDOException $e) {
			// Manejo de errores
			error_log("Error al agregar averia: " . $e->getMessage());
			return false;
		}
	}//fin agregarAveria


	/**
	 * Obtener los detalles de una avería por ID.
	 *
	 * Esta función realiza una consulta a la base de datos para obtener 
	 * los detalles de una avería específica utilizando su ID.
	 *
	 * @param int $id El ID de la avería que se desea obtener.
	 * @return array|false Un array asociativo con los detalles de la avería si se encuentra, 
	 *                     o false si no se encuentra la avería.
	 */
	public function getAveria($id)
	{
		// Construir la consulta SQL
		$sql = "SELECT *
				FROM averias
				WHERE id_averia = :id";
		// Conectar a la base de datos
		$conectar = $this->db->conectar();
		// Preparar la consulta SQL
		$consulta = $conectar->prepare($sql);
		$consulta->bindParam(':id', $id, PDO::PARAM_INT);
		// Ejecutar la consulta
		$consulta->execute();
		// Obtener y devolver el resultado de la consulta
		$recibo = $consulta->fetch(PDO::FETCH_ASSOC);
		return $recibo;
	}//fin getAverias


	/**
	 * Editar los detalles de una avería existente.
	 *
	 * Esta función realiza una actualización en la base de datos para modificar 
	 * los detalles de una avería específica utilizando su ID.
	 *
	 * @param int $id_averia El ID de la avería que se desea editar.
	 * @param string $fecha La nueva fecha de la avería.
	 * @param string $descripcion La nueva descripción de la avería.
	 * @param string $estado El nuevo estado de la avería.
	 * @param int $trastero El ID del trastero asociado a la avería.
	 * @return bool true si la modificación se realizó con éxito, false en caso de fallo.
	 */
	public function editarAveria($id_averia, $fecha, $descripcion, $estado, $trastero)
	{

		$sql = "UPDATE averias SET fecha= :fecha, descripcion= :descripcion, estado= :estado, trastero_id= :trastero WHERE id_averia= :id_averia";
		try {
			$conectar = $this->db->conectar();
			$consulta = $conectar->prepare($sql);
			$consulta->bindParam(':id_averia', $id_averia);
			$consulta->bindParam(':fecha', $fecha);
			$consulta->bindParam(':descripcion', $descripcion);
			$consulta->bindParam(':estado', $estado);
			$consulta->bindParam(':trastero', $trastero);
			$consulta->execute();
			return true; //modificacion realizada con exito
		} catch (PDOException $e) {
			error_log("Error al modificar recibo: " . $e->getMessage());
			return false; // La modificación falló
		}
	}//fin editarAveria



	public function eliminarAveria($id)
	{

		try {
			$sql = "DELETE FROM averias WHERE id_averia = :id";
			$conectar = $this->db->conectar();
			$consulta = $conectar->prepare($sql);
			$consulta->bindParam(':id', $id);
			$consulta->execute();

			// Verificar si se eliminó alguna fila
			if ($consulta->rowCount() > 0) {
				echo "Recibo eliminado correctamente";
			} else {
				echo "No se encontró ningún usuario con ese ID";
			}
		} catch (PDOException $e) {
			echo "Error al eliminar usuario: " . $e->getMessage();
		}
	}//fin eliminarRecibo


	/**
	 * Obtener Correo de Trasteros
	 *
	 * Este método recupera trasteros (almacenes) distintos junto con la información del usuario asociado a un ID de trastero dado, como el email que es lo que buscamos.
	 *
	 * @param int $id El ID del trastero para filtrar los registros.
	 * @return array Un array de trasteros y los detalles de sus usuarios asociados.
	 */
	public function getCorreoTrasteros($id)
	{

		$sql = "  SELECT DISTINCT t.*,u.nombre,u.apellido_1,u.apellido_2,u.email
		FROM recibos r 
		INNER JOIN users u on u.id_user=r.user_id
		INNER JOIN trasteros t on t.id_trastero=r.trastero_id
		WHERE t.id_trastero=$id;";
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);
		$consulta->execute();
		$trastero = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $trastero;
	}//fin correo de trasteros










}