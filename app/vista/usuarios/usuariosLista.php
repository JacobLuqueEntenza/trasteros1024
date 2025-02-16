<?php require('../layouts/header.php'); ?>

<?php
require_once('../../controlador/usuariosControlador.php');
$usuarios = new UsuariosControlador();

$rolCapturado = isset($_GET['rolCapturado']) ? $_GET['rolCapturado'] : 0;
// Capturar el valor seleccionado para el rol
if (isset($_GET['tipoUsers'])) {
    //nos aseguramos que es un numero entero
    $rolCapturado = intval($_GET['tipoUsers']);
    if ($rolCapturado == 0) {
        // Si el valor capturado es 0, mostrar todos los roles
        $rol = "1";
    } else {
        // Filtrar por el rol seleccionado
        $rol = "u.rol_id = " . $rolCapturado;
    }
} else {
    $rol = "1"; // Si no hay rol seleccionado, mostrar todos los roles
}

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$previo = ($pagina - 1);
$siguiente = ($pagina + 1);
$filasPorPagina = 10;

$todosUsuarios = $usuarios->listaUsuarios($pagina, $rol);
$totalPaginas = $usuarios->numeroPaginas($filasPorPagina, $rol);
?>



<?php

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) {
    header('Location: /trasteros1024/index.php');
    exit;
}
;
?>

<img id="fotoUsuarios" src="/trasteros1024/public/multimedia/img/user.jpg" alt="usuarios">
<div class="containertext-center mb-5 col-md-12">
    <p class="h4 mt-4 text-justify">Como administrador, esta sección te permite gestionar de manera integral todos los aspectos relacionados con los usuarios registrados en la plataforma. Podrás actualizar información personal como nombres, correos electrónicos o cualquier otro dato relevante para mantener la base de datos al día. Además, tendrás la capacidad de asignar, modificar o revocar roles según las necesidades del sistema o los permisos requeridos por cada usuario. Si un usuario ya no debe formar parte del sistema, también podrás eliminarlo de forma permanente. Este panel te proporciona un control centralizado y eficiente para mantener una administración ordenada y funcional.</p>
</div>
<div class="card">
    <div class="col-md-12">
        <div class="container mt-5 ">
            <button type="button" class="btn btn-success mb-3 btn-lg"
                onclick="window.location.href='usuarioNuevo.php'">Añadir Usuario</button>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" id="formUsers">
                <div class="form-group">
                    <label for="tipoUsers">Usuario:</label>
                    <select class="form-control" id="tipoUsers" name="tipoUsers">
                        <option value="0">todos los Registrados</option>
                        <option value="1">Administrador</option>
                        <option value="2">Cliente</option>
                        <option value="3">Usuario</option>
                    </select>
                </div>
            </form>


            <div class="card-header h1 text-center">
                Lista de Usuarios
            </div>
            <div class="p-0">
                <table class="table text-center tablaUsuarios" id="tablaUsuarios">
                    <thead>
                        <tr>                            
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                            <th scope="col" colspan="3">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($todosUsuarios as $usuario) { ?>
                            <tr>
                                <td><?php echo $usuario['nombre'] ?></td>
                                <td><?php echo $usuario['apellido_1'] . ' ' . $usuario['apellido_2'] ?></td>
                                <td><?php echo $usuario['direccion'] ?></td>
                                <td><?php echo $usuario['telefono'] ?></td>
                                <td><?php echo $usuario['email'] ?></td>
                                <td><?php echo $usuario['rol'] ?></td>
                                <td>
                                    <a href='usuarioEditar.php?id=<?php echo $usuario['id_user']; ?>'><img class="ediborra"
                                            src="/trasteros1024/public/multimedia/img/editar.ico" alt="Editar"></a>
                                </td>
                                <td>
                                    <a href='usuarioEditar.php?id=<?php echo $usuario['id_user']; ?>'><img class="ediborra"
                                            src="/trasteros1024/public/multimedia/img/borrar.ico" alt="Eliminar"></a>
                                </td>
                                <?php echo ($usuario['rol_id'] == 2) ?
                                    '<td>
                                                <a href="../recibos/reciboNuevo.php?id=' . $usuario['id_user'] . '"><img class="ediborra" src="/trasteros1024/public/multimedia/img/recibo.ico" alt="recibo"></a>
                                            </td>' : ''; ?>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                    href="usuariosLista.php?pagina=<?php echo $i; ?>&rolCapturado=<?php echo $rolCapturado; ?>&tipoUsers=<?php echo $rolCapturado; ?>"><?php echo $i; ?></a>
            </li>

        <?php endfor ?>

        <?php if ($pagina < $totalPaginas): ?>
            <li class="page-item ">
                <a class="page-link" href="usuariosLista.php?pagina=<?= $siguiente; ?>" aria-label="Next">
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