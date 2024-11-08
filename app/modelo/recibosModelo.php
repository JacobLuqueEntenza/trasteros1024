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
public function __construct() {
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
	public function filasLista($id_usuario,$fechas){
		// Construir la consulta SQL
		$sql="SELECT * FROM recibos WHERE $id_usuario $fechas";
        // Preparar la consulta SQL
		$conectar=$this->db->conectar();
        $consulta=$conectar->prepare($sql);

		// Ejecutar la consulta
		$consulta->execute();

		// Obtener y devolver el número total de filas
		$totalFilas=$consulta->rowCount();

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
	 public function getListaRecibos($paginaInicio,$filasxPagina,$id_usuario,$fechas){
		
		$sql="SELECT r.id_recibo, r.fecha, r.pagado, r.formaPago,r.concepto, u.nombre,u.apellido_1,u.apellido_2, r.trastero_id
			FROM recibos r 
			INNER JOIN users u ON u.id_user = r.user_id
			INNER JOIN trasteros t ON t.id_trastero = r.trastero_id
			WHERE $id_usuario $fechas
			ORDER BY r.id_recibo DESC
			LIMIT $paginaInicio,$filasxPagina";
		$conectar=$this->db->conectar();
		$consulta=$conectar->prepare($sql);
        $consulta->execute();
        $recibos=$consulta->fetchAll(PDO::FETCH_ASSOC);

        return $recibos;        
    }//fin lista recibos


	public function getUsuarios($id) {
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
	public function nuevoRecibo($fecha,$pagada,$formaPago,$id_user,$trastero){

		$sql="INSERT INTO recibos (fecha, concepto, pagado, formaPago, user_id, trastero_id) VALUES (:fecha,CASE MONTH(:fecha)
		WHEN 1 THEN 'Enero'
        WHEN 2 THEN 'Febrero'
        WHEN 3 THEN 'Marzo'
        WHEN 4 THEN 'Abril'
        WHEN 5 THEN 'Mayo'
        WHEN 6 THEN 'Junio'
        WHEN 7 THEN 'Julio'
        WHEN 8 THEN 'Agosto'
        WHEN 9 THEN 'Septiembre'
        WHEN 10 THEN 'Octubre'
        WHEN 11 THEN 'Noviembre'
        WHEN 12 THEN 'Diciembre'
		END
		, :pagada, :formaPago, :user, :trastero)";	
		$conectar=$this->db->conectar();
		$consulta=$conectar->prepare($sql);
		$consulta->bindParam(':fecha',$fecha);
		$consulta->bindParam(':pagada',$pagada);
		$consulta->bindParam(':formaPago',$formaPago);
		$consulta->bindParam(':user',$id_user);
		$consulta->bindParam(':trastero',$trastero);
		$consulta->execute();
	}//fin crear

/**
 * Obtiene la información de un recibo por su ID.
 *
 * @param int $id El ID del recibo.
 * @return array|false Un array asociativo con los datos del recibo si se encuentra, o false si no se encuentra.
 */
	public function getRecibo($id) {
		// Construir la consulta SQL
		$sql = "SELECT r.*,u.*
				FROM recibos r 
				INNER JOIN users u ON u.id_user = r.user_id
				WHERE id_recibo = :id";
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
	public function editarRecibo($id_recibo,$fecha,$pagada,$formaPago,$id_user,$trastero){

		$sql="UPDATE recibos SET fecha= :fecha, pagado= :pagada, formaPago= :formaPago, user_id= :user, trastero_id= :trastero WHERE id_recibo= :id_recibo";	
		try{
		$conectar=$this->db->conectar();
		$consulta=$conectar->prepare($sql);
		$consulta->bindParam(':id_recibo',$id_recibo);
		$consulta->bindParam(':fecha',$fecha);
		$consulta->bindParam(':pagada',$pagada);
		$consulta->bindParam(':formaPago',$formaPago);
		$consulta->bindParam(':user',$id_user);
		$consulta->bindParam(':trastero',$trastero);
		$consulta->execute();
		return true; //modificacion realizada con exito
		}catch (PDOException $e) {
			error_log("Error al modificar recibo: " . $e->getMessage());
			return false; // La modificación falló
		}
	}//fin editarRecibo

/**
 * Elimina un recibo de la base de datos.
 *
 * @param int $id El ID del recibo que se va a eliminar.
 */
	public function eliminarRecibo($id){

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