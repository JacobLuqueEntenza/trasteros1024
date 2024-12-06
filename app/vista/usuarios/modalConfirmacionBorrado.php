<?php
include('../layouts/headerFormularios.php');

require_once('../../controlador/usuariosControlador.php');
$controlador = new UsuariosControlador();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = $controlador->editar($id);
};

    //eliminamos el usuario
    
    if (isset($_POST['eliminar'])) {
        $id=$_POST['id'];
        $controlador->eliminar($id);
    };
?>
    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este usuario?<br>
                    <div class="h3"><?php echo $usuario['nombre'];?></div>
                    Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!-- Formulario de confirmación -->
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $usuario['id_user']; ?>">
                        <button type="submit" class="btn btn-danger" name="eliminar">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
  