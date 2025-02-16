
    <?php
    session_start();
    include('../layouts/headerFormularios.php');
    include('modalConfirmacionBorrado.php');
    require_once('../../controlador/recibosControlador.php');
    $controladorRecibo = new RecibosControlador();

    // Redirige si no eres administrador
    if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) {
        header('Location: ../../../index.php');
        exit;
    }

    // Carga los datos del recibo
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $recibo = $controladorRecibo->editar($id);
    } else {
        echo ("No tengo id del recibo");
    }
    
    
    // Actualización del recibo
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['editarRecibo'])) {
            echo 'entro en post';
            $id_recibo = $_POST['id'];
            $fecha = $_POST['fecha'];
            $formaPago = $_POST['formaPago'];
            $pagada = $_POST['pagado'];
            $concepto = $_POST['concepto'];            
            //var_dump($id_recibo, $fecha, $concepto, $pagada, $formaPago, $id_user, $trastero);
    
            // Llama a la función de actualización
            $controladorRecibo->actualizar($id_recibo, $fecha, $concepto, $pagada, $formaPago);
            //echo ($controladorRecibo->actualizar($id_recibo, $fecha, $concepto, $pagada, $formaPago, $id_user, $trastero));
            exit();
        } 
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <form action="" method="POST" class="mt-5" name="">
                        <legend class="text-center h1 mb-3 mt-5">Modificar o Borrar Recibo</legend>

                        <div class="form-group">
                            <label class="label-grande" for="id">Número Recibo:</label>
                            <input type="text" class="form-control" id="id" name="id"
                                value="<?php echo $recibo['id_recibo'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="label-grande" for="id_user">Nombre:</label>
                            <input type="text" class="form-control" id="id_user" name="id_user"
                                value="<?php echo $recibo['nombre'] . ' ' . $recibo['apellido_1'] . ' ' . $recibo['apellido_2'] ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label class="label-grande" for="trastero">Trastero:</label>
                            <input type="text" class="form-control" id="trastero" name="trastero"
                                value="<?php echo $recibo['trastero_id'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="label-grande" for="fecha">Fecha Pago:</label>
                            <input type="text" class="form-control" id="fecha" name="fecha"
                                value="<?php echo $recibo['fecha'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="label-grande" for="concepto">Concepto:</label>
                            <input type="text" class="form-control" id="concepto" name="concepto"
                                value="<?php echo $recibo['concepto'] ?>">
                        </div>

                        <div class="form-group">
                            <label class="label-grande" for="pagada">Pagada:</label>
                            <select name="pagado" class="form-select mb-3">
                                <option value="<?php echo $recibo['pagado']; ?>">
                                    <?php echo ($recibo['pagado'] == true) ? 'Si' : 'No'; ?>
                                </option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="label-grande" for="formaPago">Forma de Pago:</label>
                            <select name="formaPago" class="form-select mb-3">
                                <option value="bizum" <?php echo ($recibo['formaPago'] == 'bizum') ? 'selected' : ''; ?>>
                                    Bizum</option>
                                <option value="efectivo" <?php echo ($recibo['formaPago'] == 'efectivo') ? 'selected' : ''; ?>>Efectivo</option>
                                <option value="banco" <?php echo ($recibo['formaPago'] == 'banco') ? 'selected' : ''; ?>>
                                    Banco</option>
                            </select>
                        </div>

                        <div class="form-group text-center mt-4 d-flex justify-content-between">
                            <button type="submit" class="btn btn-success mt-3" value="actualizar"
                                name="editarRecibo">Modificar Recibo</button>
                                <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#confirmDeleteModal">Eliminar</button>
                        </div>
                        <button type="button" class="btn btn-secondary mt-5 w-100"
                        onclick="location.href='../../../app/vista/recibos/recibosLista.php'">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>