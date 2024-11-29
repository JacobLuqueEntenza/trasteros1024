
    <?php
    session_start();
    include('../layouts/headerFormularios.php');
    include('modalConfirmacionBorrado.php');
    require_once('../../controlador/usuariosControlador.php');
    $controlador = new UsuariosControlador();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $usuario = $controlador->editar($id);
    }
    ;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['actualizar'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido1 = $_POST['apellido1'];
            $apellido2 = $_POST['apellido2'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            if(isset ($comfirma_pass)){
                $comfirma_pass = $_POST['comfirma_pass'];
            }else{
                $comfirma_pass = $pass;
            };

            // Si no está vacío el campo de selección, asignarlo; si no, rol 3 por defecto
            $rol = isset($_POST['selection']) ? $_POST['selection'] : 3;

            // Verificar si las contraseñas coinciden
            if ($pass !== $comfirma_pass) {
                echo "Las contraseñas no coinciden.";
                exit();
            } else {
            };

            // Intentar actualizar el usuario y mostrar el resultado
            $controlador->actualizar($id, $nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol);
            exit();
        };
        
        
    }


    
    ?>




    <div class="container col-md-4 ">
        <form action="" method="POST" name="" class="mt-6">
            <legend class="text-center mb-4 h1"><strong>Modificar usuario</strong></legend>
            <div class="form-group">
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $usuario['id_user'] ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="<?php echo $usuario['nombre'] ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="apellido1" name="apellido1"
                    value="<?php echo $usuario['apellido_1'] ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="apellido2" name="apellido2"
                    value="<?php echo $usuario['apellido_2'] ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="direccion" name="direccion"
                    value="<?php echo $usuario['direccion'] ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="telefono" name="telefono"
                    value="<?php echo $usuario['telefono'] ?>">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo $usuario['email'] ?>">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="pass" name="pass"
                    value="<?php echo $usuario['pass'] ?>">
            </div>
            <?php if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) { ?>           
            <div class="form-group">
                <input type="password" class="form-control" id="comfirma_pass" name="comfirma_pass"
                    placeholder="Confirmar Contraseña">
            </div>
            <?php }else{}; ?>
            <?php
            if ($_SESSION['rol'] == 1) {
                echo "<select name='selection' class='form-control' id='rolSelect'>";
                if (isset($usuario['rol_id'])) {
                    echo "<option value='" . $usuario['rol_id'] . "'>";
                    if ($usuario['rol_id'] == 1) {
                        echo "Administrador";
                    } elseif ($usuario['rol_id'] == 2) {
                        echo "Cliente";
                    } elseif ($usuario['rol_id'] == 3) {
                        echo "Usuario";
                    } else {
                        echo "Rol no reconocido";
                    }
                    echo "</option>";
                } else {
                    echo "<option value=''>Selecciona el Rol</option>";
                }
            
                echo "<option value='1'>Administrador</option>
                <option value='2'>Cliente</option>
                <option value='3'>Usuario</option>
                </select><br><br>";
            }
            ?>

            <div class="form-group text-center mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-success" name="actualizar">Actualizar</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">Eliminar</button>
            </div>   
            <button type="button" class="btn btn-secondary mt-5 w-100" onclick="location.href='../../../app/vista/usuarios/usuariosLista.php'">Cancelar</button>
        </form>
    </div>
    <?php include ('../trasteros/modalTrastero.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>