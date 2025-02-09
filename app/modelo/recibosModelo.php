<?php
/**
 * conexion a la base de datos
 * @return recibos PDO
 */


class RecibosModelo
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
	 * Cuenta el número total de filas en la tabla de recibos.
	 *
	 * @return int El número total de filas en la tabla.
	 */
	public function filasLista($id_usuario, $fechas)
	{
		// Construir la consulta SQL
		$sql = "SELECT * FROM recibos WHERE $id_usuario $fechas";
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
	 * Obtiene un listado paginado de recibos.
	 *
	 * Esta función devuelve un array con los datos de los recibos, filtrados por usuario e intervalo de fechas, paginados según los parámetros proporcionados.
	 *
	 * @param int $paginaInicio El número de página de inicio para la paginación.
	 * @param int $filasxPagina El número de filas por página para la paginación.
	 * @param int $id_usuario El ID del usuario para filtrar los recibos.
	 * @param string $fechas La condición de intervalo de fechas para filtrar los recibos.
	 * @return array Un array asociativo con los datos de los recibos.
	 */
	public function getListaRecibos($paginaInicio, $filasxPagina, $id_usuario, $fechas)
	{

		$sql = "SELECT r.id_recibo, r.fecha, r.pagado, r.formaPago,r.concepto, u.nombre,u.apellido_1,u.apellido_2, r.trastero_id
			FROM recibos r 
			INNER JOIN users u ON u.id_user = r.user_id
			INNER JOIN trasteros t ON t.id_trastero = r.trastero_id
			WHERE $id_usuario $fechas
			ORDER BY r.id_recibo DESC
			LIMIT $paginaInicio,$filasxPagina";
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);
		$consulta->execute();
		$recibos = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $recibos;
	}//fin lista recibos


	public function getUsuarios($id)
	{
		// Construir la consulta SQL
		$sql = "SELECT r.*,u.nombre,u.apellido_1,u.apellido_2,u.email
				FROM  users u
				LEFT JOIN recibos r ON u.id_user = r.user_id
				WHERE id_user = :id";
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
	}//fin getRecibo





	/**
	 * Crea un nuevo recibo en la base de datos.
	 *
	 * @param string $fecha La fecha del recibo.
	 * @param int $pagada Indica si el recibo ha sido pagado o no (1 para pagado, 0 para no pagado).
	 * @param string $formaPago La forma de pago del recibo.
	 * @param int $id_user El ID del usuario asociado al recibo.
	 * @param int $trastero El ID del trastero asociado al recibo.
	 * @return void
	 */
	public function nuevoRecibo($fecha, $pagada, $formaPago, $id_user, $trastero, $concepto)
	{
		try{
		// Verificar si el ID está vacío
		if (empty($fecha)||empty(trim($concepto))||empty($formaPago)) {
			echo "<script>alert('Error: Te faltan datos.');</script>";
			return false;
		};
		
		

		$sql = "INSERT INTO recibos (fecha, concepto, pagado, formaPago, user_id, trastero_id) VALUES (:fecha, :concepto, :pagada, :formaPago, :user, :trastero)";
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);
		$consulta->bindParam(':fecha', $fecha);
		$consulta->bindParam(':pagada', $pagada);
		$consulta->bindParam(':formaPago', $formaPago);
		$consulta->bindParam(':user', $id_user);
		$consulta->bindParam(':trastero', $trastero);
		$consulta->bindParam(':concepto', $concepto);
		$consulta->execute();

	} catch (PDOException $e) {
		// Manejo de errores
		echo "<script>alert('Error al obtener los datos: " . $e->getMessage() . "');</script>";
		error_log("Error en getCorreoTrasteros: " . $e->getMessage());
		return false;
	}
		
	}//fin crear


	public function trasteroAsignado($fecha, $id_user, $trastero, $concepto)
	{
		$sql = "INSERT INTO recibos (fecha, concepto, user_id, trastero_id) VALUES (:fecha, :concepto, :user, :trastero)";
		$sql2= "UPDATE trasteros SET disponible=0 WHERE id_trastero=:trastero";
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);				
		$consulta->bindParam(':user', $id_user);
		$consulta->bindParam(':trastero', $trastero);
		$consulta->bindParam(':concepto', $concepto);
		$consulta->bindParam(':fecha', $fecha);	
		$consulta->execute();
		
		$consulta2 = $conectar->prepare($sql2);
		$consulta2->bindParam(':trastero', $trastero);
		$consulta2->execute();
	}//fin trasteroAsignado

	public function cambioRol($id_user)
	{
		$sql = "UPDATE users SET rol_id= 2 WHERE id_user= :user";
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);		
		$consulta->bindParam(':user', $id_user);
		if($consulta->execute()){
			echo "<script>
                alert('El usuario ha alquilado un trastero y pasa a ser Cliente.');
                window.location.href='../trasteros/trasteros.php#tablaTrasteros'; // Redirige a la lista de usuarios</script>";
			  }else{
				echo "<script>alert('Error al actualizar el rol');</script>";
		};
	}//fin cambioRol


//***************************************************************************+ */
	public function cambioRolUser($id_user)
	{
		$sql= "UPDATE trasteros SET disponible = 1 WHERE id_trastero IN ( SELECT trastero_id FROM recibos WHERE user_id = :user)";
		$conectar = $this->db->conectar();
		$consulta = $conectar->prepare($sql);		
		$consulta->bindParam(':user', $id_user);
		$consulta->execute();
	}//fin cambioRol




	/**
	 * Obtiene la información de un recibo por su ID.
	 *
	 * @param int $id El ID del recibo.
	 * @return array|false Un array asociativo con los datos del recibo si se encuentra, o false si no se encuentra.
	 */
	public function getRecibo($id)
	{
		
		// Construir la consulta SQL
		$sql = "SELECT r.*, u.*, t.precio
				FROM recibos r
				INNER JOIN users u ON u.id_user = r.user_id
				INNER JOIN trasteros t ON t.id_trastero = r.trastero_id
				WHERE r.id_recibo = :id;";

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
	}//fin getRecibo




	/**
	 * Edita un recibo existente en la base de datos.
	 *
	 * @param int $id_recibo El ID del recibo que se va a editar.
	 * @param string $fecha La nueva fecha del recibo.
	 * @param int $pagada El nuevo estado de pago del recibo (0 o 1).
	 * @param string $formaPago La nueva forma de pago del recibo.
	 * @param int $id_user El nuevo ID del usuario asociado al recibo.
	 * @param int $trastero El nuevo ID del trastero asociado al recibo.
	 * @return bool true si la modificación se realizó con éxito, false si falló.
	 */
	public function editarRecibo($id_recibo, $fecha, $concepto, $pagada, $formaPago)
	{

		$sql = "UPDATE recibos SET fecha= :fecha,concepto= :concepto, pagado= :pagada, formaPago= :formaPago WHERE id_recibo= :id_recibo";
		try {
			$conectar = $this->db->conectar();
			$consulta = $conectar->prepare($sql);
			$consulta->bindParam(':id_recibo', $id_recibo);
			$consulta->bindParam(':fecha', $fecha);
			$consulta->bindParam(':concepto', $concepto);
			$consulta->bindParam(':pagada', $pagada);
			$consulta->bindParam(':formaPago', $formaPago);
			
			$consulta->execute();
			return true; //modificacion realizada con exito
		} catch (PDOException $e) {
			error_log("Error al modificar recibo: " . $e->getMessage());
			return false; // La modificación falló
		}
	}//fin editarRecibo

	/**
	 * Elimina un recibo de la base de datos.
	 *
	 * @param int $id El ID del recibo que se va a eliminar.
	 */
	public function eliminarRecibo($id)
	{

		try {
			$sql = "DELETE FROM recibos WHERE id_recibo = :id";
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






}