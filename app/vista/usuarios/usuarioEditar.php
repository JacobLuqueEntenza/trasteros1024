<?php
ob_start();
session_start();
include('../layouts/headerFormularios.php');
include('modalConfirmacionBorrado.php');
require_once('../../controlador/usuariosControlador.php');
include('../trasteros/modalTrastero.php');
$controlador = new UsuariosControlador();



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = $controlador->editar($id);
    
};

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
        $confirmPass = $_POST['comfirma_pass'] ?? null;

        // Si no está vacío el campo de selección, asignarlo; si no, rol 3 por defecto
        $rol = isset($_POST['selection']) ? $_POST['selection'] : 3;

        // Inicializar la variable para la contraseña
        $hashedPassword = null; // Inicializamos como null
        
        // Verificar si se proporcionó una nueva contraseña
        if (!empty($pass)) {
            
            // Verificar que las contraseñas coinciden
            if ($pass !== $confirmPass) {
                echo '<script>alert("Las contraseñas no coinciden."); window.history.back();</script>';
                exit();
            }
            // Generar un nuevo hash para la nueva contraseña
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
        }else{
            $hashedPassword = $usuario['pass'];
        };
        
        
        // Intentar actualizar el usuario y mostrar el resultado
        try {
            
            // Ahora, solo actualizamos el campo de contraseña si se proporciona un nuevo valor
            $controlador->actualizar($id, $nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $hashedPassword, $rol);
            echo '<script>alert("Usuario actualizado correctamente."); window.location.href="usuariosLista.php";</script>';
            
            exit();
        } catch (Exception $e) {
            echo '<script>alert("Error al actualizar el usuario: ' . $e->getMessage() . '"); window.history.back();</script>';
            exit();
        }
    }
}



?>

<div class="container col-md-4 ">
    <form action="" method="POST" class="mt-6">
        <legend class="text-center mb-4 h1"><strong>Modificar usuario</strong></legend>
        <div class="form-group">
            <input type="text" class="form-control" id="id" name="id" value="<?php echo $usuario['id_user'] ?>" readonly>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre'] ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?php echo $usuario['apellido_1'] ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?php echo $usuario['apellido_2'] ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $usuario['direccion'] ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario['telefono'] ?>">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email'] ?>">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Nueva Contraseña">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="comfirma_pass" name="comfirma_pass" placeholder="Confirmar Contraseña">
        </div>

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
                } 
                else {
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
        <button type="button" class="btn btn-secondary mt-5 w-100" onclick="location.href='usuariosLista.php'">Cancelar</button>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Seleccionamos el botón "Guardar" del modal
        const guardarTrasteroButton = document.getElementById("guardarTrastero");

        // Escuchamos el evento 'click' en el botón
        guardarTrasteroButton.addEventListener("click", function (event) {
            // Evitamos que el formulario recargue la página (para propósitos de demostración)
            // event.preventDefault(); // Descomenta si no deseas enviar el formulario en este momento

            // Asignamos el valor "Cliente" (2) al select del formulario
            const rolSelect = document.getElementById("rolSelect");
            if (rolSelect) {
                rolSelect.value = "2"; // Valor asociado al rol de "Cliente"
            }
        });
    });
</script>

