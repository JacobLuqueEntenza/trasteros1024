<?php
require_once('../../controlador/recibosControlador.php');
$controladorRecibo = new RecibosControlador();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['asignarTrastero'])) {

        $id_user = $_POST['idCliente'];
        $trastero = $_POST['numeroTrastero'];
        $concepto = $_POST['altaTrastero'];
        $fecha = $_POST['fecha'];
        
        $controladorRecibo->asignarTrastero($fecha, $id_user, $trastero,$concepto);
        exit();
    }
    ;
}
;

?>


<!--   modal para asignar trastero    -->
<div class="modal fade" id="modalAsignarTrastero" tabindex="-1" aria-labelledby="modalAsignarTrasteroLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div  class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAsignarTrasteroLabel">Asignar Número de Trastero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="numeroTrastero">Número de Trastero</label>
                        <input type="text" class="form-control" id="numeroTrastero" name="numeroTrastero" placeholder="Ingrese el número de trastero">
                    </div>
                    <div class="form-group">
                        <label for="idCliente">Id Cliente</label>
                        <input type="text" class="form-control" id="idCliente" name="idCliente" value="">
                    </div>
                    <div class="form-group">
                        <label for="altaCliente">Alta Cliente</label>
                        <input type="text" class="form-control" id="altaCliente" name="altaTrastero" value="<?php echo 'Alta cliente'?>">
                    </div>
                    <div class="form-group">
                        <label for="altaCliente">Fecha</label>
                        <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d')?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="guardarTrastero" name="asignarTrastero">Guardar</button>
                    </div>
                </form>
            </div>
            

        </div>
    </div>
</div>


<!-- fin  modal para asignar trastero    -->


