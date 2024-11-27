
<?php
/**
     * conexion a la base de datos
     * @return usuarios PDO
     */


class TrasterosModelo
{
 
 private $db;

 /**
 * Constructor de la clase.
 *
 * Inicializa la conexión a la base de datos.
 */
 public function __construct() {
	// Inicializa la conexión
    $this->db =new Conexion(); 
    $this->db->conectar();
	//
  }


/**
 * Obtiene un listado paginado de trasteros.
 *
 * Este método devuelve un array con los datos de los trasteros.
 *
 * @return array Array asociativo con los datos de los trasteros.
 */
    public function getListaTrasteros(){
		
		$sql="  SELECT * 
                FROM trasteros 
                ORDER BY id_trastero ASC
                LIMIT 23";
		$conectar=$this->db->conectar();
		$consulta=$conectar->prepare($sql);
        $consulta->execute();
        $trastero=$consulta->fetchAll(PDO::FETCH_ASSOC);

        return $trastero;        
    }//fin lista de trasteros



    /**
    * Obtiene un listado paginado de trasteros asociado a cada cliente que tiene un trastero
    *
    * Este método devuelve un array con los datos de los trasteros.
    *
    * @return array Array asociativo con los datos de los trasteros.
    */
    public function getListaTrasterosAdmin(){
		
		$sql="  SELECT DISTINCT t.*,u.nombre,u.apellido_1,u.apellido_2,u.rol_id, u.id_user
                FROM recibos r 
                INNER JOIN users u on u.id_user=r.user_id
                INNER JOIN trasteros t on t.id_trastero=r.trastero_id
                ORDER BY id_trastero ASC
                LIMIT 23";
		$conectar=$this->db->conectar();
		$consulta=$conectar->prepare($sql);
        $consulta->execute();
        $trastero=$consulta->fetchAll(PDO::FETCH_ASSOC);

        return $trastero;        
    }//fin lista de trasteros

    
}