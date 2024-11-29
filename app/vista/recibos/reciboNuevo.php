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

require_once('../../controlador/recibosControlador.php');
$controladorRecibo = new RecibosControlador();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = $controladorRecibo->editarUsuario($id);
}
;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['agregarRecibo'])) {

        $id_user = $_POST['id'];
        $trastero = $_POST['trastero'];
        $fecha = $_POST['fecha'];
        $concepto = $_POST['concepto'];
        //si la variable fecha no esta vacia poner pagada, es p ara un futuro que mande correo y haga el apunte en la base de datos en 0, como no pagada

        if (isset($_REQUEST['banco'])) {
            $formaPago = 'banco';
        } elseif (isset($_REQUEST['bizum'])) {
            $formaPago = 'bizum';
        } elseif (isset($_REQUEST['efectivo'])) {
            $formaPago = 'efectivo';
        }
        ;
        $pagada = !empty($formaPago) || $pagada = !empty($fecha) ? 1 : null;


        $controladorRecibo->guardarRecibo($fecha, $pagada, $formaPago, $id_user, $trastero, $concepto);
        exit();
    }
    ;
}
;

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) {
    header('Location: ../index.php');
    exit;
}
;


?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <form action="" method="POST" class="mt-5" name="nuevoRecibo">
                    <legend class="text-center mb-5 h1"><strong>Recibo Nuevo </strong></legend>
                    <div class="form-group">
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $id ?>">
                    </div>
                    <div class="form-group">
                        <label class="label-grande" for="trastero">Trastero:</label>
                        <input type="text" class="form-control" id="trastero" name="trastero"
                            value="<?php if (isset($id)) {
                                echo $usuario['trastero_id'];
                            } ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="pagada" name="pagada"
                            value="<?php $pagada = (!isset($formaPago)||$formaPago) ? 0 : $pagada;
                            echo $pagada;
                        ?>">
                    </div>
                    <div class="form-group">
                        <label class="label-grande" for="name">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="<?php if (isset($id)) {
                                echo $usuario['nombre'] . ' ' . $usuario['apellido_1'] . ' ' . $usuario['apellido_2'];
                            } ?>">
                    </div>
                    <div class="form-group">
                        <label for="fecha">fecha Pago:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha">
                    </div>
                    <div class="form-group">
                        <label for="concepto">Concepto:</label>
                        <input type="text" class="form-control" id="concepto" name="concepto" ?>
                    </div>
                    <div class="form-group">
                        <label for="formaPago">Forma de Pago: </label>
                        <div class="form-check form-check-inline ml-5">
                            <input class="form-check-input" type="radio" name="banco" id="banco" value="Banco">
                            <label class="form-check-label" for="inlineRadio1">Banco</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bizum" id="bizum" value="bizum">
                            <label class="form-check-label" for="inlineRadio2">bizum</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="efectivo" id="efectivo" value="Efectivo">
                            <label class="form-check-label" for="inlineRadio3">Efectivo</label>
                        </div>
                    </div>
                    <div class="form-group text-center mt-4 d-flex justify-content-between">
                        <button type="submit" class="btn btn-success" value="agregarRecibo" name="agregarRecibo">Añadir
                        Recibo</button>
                        <button type="button" class="btn btn-secondary"
                        onclick="location.href='../../../app/vista/recibos/recibosLista.php'">Cancelar</button>
                    </div>   
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>