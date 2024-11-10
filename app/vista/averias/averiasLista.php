<?php require('../layouts/header.php'); ?>

<?php
require_once('../../controlador/averiasControlador.php');
$averias = new AveriasControlador();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] > 2) {
    header('Location: /tutrastero/tutrastero/public/index.php');
    exit;
}
;

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$previo = ($pagina - 1);
$siguiente = ($pagina + 1);
$filasPorPagina = 10;

$todasAverias = $averias->listaAverias($pagina);
$totalPaginas = $averias->numeroPaginas($filasPorPagina);

?>
<img id="papeles" src="../../../public/multimedia/img/averias.jpg" alt="averias">
<div class="containertext-center mb-5 ">
    <h1 class="h1 text-center mb-5">Solo visible para administradores</h1>
    <p class="h4 m-4">Desde aquí el administrador puede gestionar todo lo referente a las averias, es decir, situacion
        en que estado estan. ESTUDIAR ADJUNTAR FOTO.</p>
</div>
<div class="col-md-12">
    <div class="container mt-5 ">
        <button type="button" class="btn btn-success mb-3 btn-lg"
            onclick="window.location.href='averiaNuevo.php'">Añadir Averia</button>
        <div class="card">
            <div class="card-header h1 text-center">
                Listado de Averias
            </div>
            <div class="p-0">
                <table class="table text-center tablaUsuarios" id="tablaUsuarios">
                    <thead>
                        <tr>
                            <th scope="col">Número Averia</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Trastero</th>
                            <th scope="col" colspan="3">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($todasAverias as $averia) { ?>
                            <tr>
                                <td scope="col"><?php echo $averia['id_averia'] ?></td>
                                <td><?php echo $averia['fecha'] ?></td>
                                <td><?php echo $averia['descripcion'] ?></td>
                                <td><?php echo $averia['estado'] ?></td>
                                <td><?php echo $averia['trastero_id'] ?></td>
                                <?php if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
                                    <td>
                                        <a href="averiaEditar.php?id=<?php echo $averia['id_averia']; ?>"><img class="ediborra"
                                                src="/trasteros1024/public/multimedia/img/editar.ico" alt="Editar"></a>
                                    </td>
                                    <td>
                                        <a href="averiaBorrar.php?id=<?php echo $averia['id_averia']; ?>"><img class="ediborra"
                                                src="/trasteros1024/public/multimedia/img/borrar.ico" alt="Eliminar"></a>
                                    </td>
                                <?php endif; ?>

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
                <a class="page-link" href="averiasLista.php?pagina=<?= $previo; ?>" aria-label="Previous">
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
                    href="averiasLista.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>

        <?php endfor ?>

        <?php if ($pagina < $totalPaginas): ?>
            <li class="page-item ">
                <a class="page-link" href="averiasLista.php?pagina=<?= $siguiente; ?>" aria-label="Next">
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