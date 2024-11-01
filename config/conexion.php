<?php


require_once 'config.php';

class Conexion
{
    

    public function conectar(){
        try{
            // creamos la variable de conexion
            $dsn = "mysql:host=".HOST.";dbname=".BD;
            
            // creamos la instancia pdo
            $conexion = new PDO($dsn, USER, PASS);
            
            // Configurar PDO para generar excepciones en caso de errores
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //echo "Conexion establecida con exito";

            // Return la instancia de PDO
            return $conexion;
            
        } catch(PDOException $e) {
            // capturamos el error
            echo "ERROR EN LA CONEXION: ".$e->getMessage();
            return null;
        }
    }
}

//$pdo = new Conexion();
//$conexion = $pdo->conectar();
//print_r($conexion);

?>
