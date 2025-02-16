<?php

include('../layouts/headerFormularios.php');

session_start();
    include('modalConfirmacionBorrado.php');
    require_once('../../controlador/AveriasControlador.php');
    $controladorAveria = new AveriasControlador();
    //si no eres administrador al index
    if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) {
        header('Location: index.php');
        exit;
    };
    //nos traemos al formulario de editar los datos
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $recibo = $controladorAveria->editar($id);
    } else {
        echo ("No tengo id del recibo");
    }
    ;

    //si tenemos post actualizamos la tabla
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['actualizar'])) {

            $id_averia = $_POST['id'];
            $fecha = $_POST['fecha'];
            $descripcion = $_POST['descripcion'];
            $estado = $_POST['estado'];
            $trastero = $_POST['trastero'];

            $controladorAveria->actualizar($id_averia, $fecha, $descripcion, $estado, $trastero);
            exit();
        };
    };

    


    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <form action="" method="POST" class="mt-5" name="nuevoRecibo">
                        <legend class="text-center mb-5 h1">Editar Aviso Averia</legend>
                        <div class="form-group">
                            <label class="label-grande" for="id">Número Averia:</label>
                            <input type="text" class="form-control" id="id" name="id"
                                value="<?php echo $recibo['id_averia'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="label-grande" for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha"
                                value="<?php echo $recibo['fecha'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="label-grande" for="trastero">Trastero:</label>
                            <input type="text" class="form-control" id="trastero" name="trastero"
                                value="<?php echo $recibo['trastero_id'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="label-grande" for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion"
                                value="<?php echo $recibo['descripcion'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado de Avería:</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="A la Espera Reparación" <?php echo ($recibo['estado'] == "A la Espera Reparación") ? 'selected' : ''; ?>>A la Espera Reparación</option>
                                <option value="En Reparación" <?php echo ($recibo['estado'] == "En Reparación") ? 'selected' : ''; ?>>En Reparación</option>
                                <option value="Reparado" <?php echo ($recibo['estado'] == "Reparado") ? 'selected' : ''; ?>>Reparado</option>
                            </select>
                        </div>
                        <div class="form-group text-center mt-4 d-flex justify-content-between">
                            <button type="submit" class="btn btn-success mt-3" value="actualizar"
                                name="actualizar">Modificar Recibo</button>
                            <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#confirmDeleteModal">Eliminar</button>
                        </div>
                        <button type="button" class="btn btn-secondary mt-5 w-100"
                        onclick="location.href='../../../app/vista/averias/averiasLista.php'">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>