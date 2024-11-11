<?php require('../layouts/header.php'); ?>

<?php
require_once('../../controlador/recibosControlador.php');
$recibos = new RecibosControlador();

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

//si la sesion no esta definida o el rol es solo usuario
if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 3) {
    header('Location: /trastero1024/public/index.php');
}

//si esta definidad la variable de sesion id_user, la ponemos en la sentencia en el modelo (WHERE id_user=$_SESSION['id_user']), y de lo contrario (WHERE=1)
if (isset($_SESSION['id_user']) && $_SESSION['rol'] != 1) {
    $id_usuario = 'user_id=' . $_SESSION['id_user'];
} else {
    $id_usuario = 1;
}
;


$fDate = 0;
$tDate = date('Y-m-d');
$fechas = '';
if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
    $fDate = $_GET['from_date'];
    $tDate = $_GET['to_date'];
    $fechas = 'AND fecha BETWEEN ' . "'" . $fDate . "'" . ' AND ' . "'" . $tDate . "'";
}
;


$previo = ($pagina - 1);
$siguiente = ($pagina + 1);
$fila = $recibos->listaRecibos($pagina, $id_usuario, $fechas);
$totalPaginas = $recibos->numeroPaginas($id_usuario, $fechas);




?>

<img id="papeles" src="../../../public/multimedia/img/papeles.jpg" alt="papeles">
<div class="col-md-12">
    <div class="container mt-1 ">
        <div class="containertext-center mb-5 ">
            <p class="h4 mt-4 text-justify">Te damos la bienvenida a nuestro servicio, diseñado para proporcionarte
                acceso exclusivo a un historial detallado de todos los recibos emitidos a tu nombre hasta la fecha.
                Desde las facturas más antiguas hasta las más recientes, nuestra plataforma te ofrece la comodidad de
                revisar y descargar tus recibos en cualquier momento y lugar. Con esta herramienta, podrás mantener un
                seguimiento preciso de tus transacciones, ayudándote a gestionar tus registros financieros de manera
                eficiente y sin complicaciones. Descubre la conveniencia y la tranquilidad que brinda tener todo tu
                historial de recibos al alcance de tus manos. ¡Explora ahora y simplifica la gestión de tus finanzas!"
            </p>
        </div>



        <form action="" method="get" name="fechas">
            <div class="row align-items-center text-center justify-content-center">
                <div class="col-md-4">
                    <label for=""><b>Del Día</b></label>
                    <input type="date" name="from_date" value="<?php if (isset($_GET['from_date'])) {
                        echo $_GET['from_date'];
                    } ?>" class="form-control mb-4" id="from_date">
                </div>
                <div class="col-md-4">
                    <label for=""><b>Hasta el Día</b></label>
                    <input type="date" name="to_date" value="<?php if (isset($_GET['to_date'])) {
                        echo $_GET['to_date'];
                    } ?>" class="form-control mb-4" id="to_date">
                </div>
                <div class="col-md-4">
                    <label for=""><b></b></label>
                    <button type="submit" class="btn btn-secondary ">Buscar entre las Fechas</button>
                    <button type="button" class="btn btn-secondary
            " onclick="borrarFechas()">Reiniciar Fechas</button>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header h1 text-center">
                Lista de Recibos
            </div>
            <div class="p-0">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col" class="col-2">Número Recibo</th>
                            <?php echo (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ? '
                                        <th scope="col" class="col-2">Número Trastero</th>
                                        <th scope="col" class="col-2">Nombre</th>' : ''; ?>
                            <th scope="col" class="col-2">Concepto</th>
                            <th scope="col" class="col-2">Pagado</th>
                            <th scope="col" class="col-2">Forma de Pago</th>

                            <?php echo (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ? '
                                        <th scope="col" class="" colspan="3">Opciones</th>
                                        ' : ''; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fila as $recibo) { ?>
                            <tr>
                                <td scope="col"><?php echo $recibo['id_recibo'] ?></td>
                                <?php echo (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ? '
                                        <td>' . $recibo['trastero_id'] . '</td>
                                        <td>' . $recibo['nombre'] . ' ' . $recibo['apellido_1'] . ' ' . $recibo['apellido_2'] . '</td>' : ''; ?>


                                <td><?php echo $recibo['concepto'] ?></td>
                                <td><?php echo ($recibo['pagado'] == 1 ? 'Si' : 'No') ?></td>
                                <td><?php echo $recibo['formaPago'] ?></td>

                                <?php
                                echo (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ?
                                    '
                                        <td>
                                            <a href="reciboEditar.php?id=' . $recibo['id_recibo'] . '"><img class="ediborra" src="../../../public/multimedia/img/editar.ico" alt="Editar"></a>
                                        </td>
                                        <td>
                                            <a href="reciboEditar.php?id=' . $recibo['id_recibo'] . '"><img class="ediborra" src="../../../public/multimedia/img/borrar.ico" alt="Eliminar"></a>
                                        </td>
                                        ' : '';
                                ?>
                                <td>
                                    <a href="generarPDF.php?id=<?php echo $recibo['id_recibo'] ?> "><img class="pdf"
                                            src="../../../public/multimedia/img/pdf.ico" alt="pdf"></a>
                                </td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-5">
        <?php if ($pagina > 1): ?>
            <li class="page-item">
                <a class="page-link" href="usuariosLista.php?pagina=<?= $previo; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </span>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>

            <li class="page-item <?php echo $pagina == $i ? 'active' : '' ?>"><a class="page-link"
                    href="recibosLista.php?pagina=<?php echo $i; ?>&from_date=<?php echo $fDate; ?>&to_date=<?php echo $tDate; ?>"><?php echo $i; ?></a>
            </li>

        <?php endfor ?>

        <?php if ($pagina < $totalPaginas): ?>
            <li class="page-item ">
                <a class="page-link" href="recibosLista.php?pagina=<?= $siguiente; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </span>
            </li>
        <?php endif; ?>
    </ul>
</nav>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<?php require('../layouts/footer.php'); ?>