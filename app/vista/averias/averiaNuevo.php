<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="/trasteros1024/public/js/script.js"></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <?php
    session_start();
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <form action="../../controlador/correoAveria.php" method="POST" class="mt-5" name="nuevo">
                        <legend class="text-center mb-5">Nueva Averia</legend>
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

                        <button type="submit" class="btn btn-success mt-3" name="btnAveria">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>