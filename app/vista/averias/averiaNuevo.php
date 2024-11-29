

 <?php
    session_start();
    include('../layouts/headerFormularios.php');
    ?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <form action="../../controlador/correoAveria.php" method="POST" class="mt-5" name="nuevo">
                        <legend class="text-center mb-5 h1">Nueva Averia</legend>
                        <div class="form-group">
                            <label class="label-grande" for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha"
                                value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado de Averia:</label>
                            <input type="text" class="form-control" id="estado" name="estado"
                                value="A la Espera Reparación" readonly>
                        </div>
                        <div class="form-group">
                            <label for="trastero_id">Trastero:</label>
                            <?php if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2): ?>
                                <input type="text" class="form-control" id="trastero_id" name="trastero_id" value="">
                            <?php else: ?>
                                <input type="text" class="form-control" id="trastero_id" name="trastero_id"
                                    value="<?php echo $_SESSION['trastero']; ?>" readonly>
                            <?php endif; ?>
                        </div>
                        <div class="form-group text-center mt-4 d-flex justify-content-between">
                            <button type="submit" class="btn btn-success mt-3" name="btnAveria">Guardar</button>
                            <button type="button" class="btn btn-secondary mt-3"
                    onclick="location.href='../../../app/vista/averias/averiasLista.php'">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>