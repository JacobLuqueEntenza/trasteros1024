

    <?php

    session_start();
    include('../layouts/headerFormularios.php');
    require_once('../../controlador/usuariosControlador.php');
    $controlador = new UsuariosControlador();

    //si tenemos el post asignamos variables
    if (isset($_POST) && !empty($_POST)) {
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email']; 
        $pass = $_POST['pass'];       
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1 ) {            
            $comfirma_pass = $_POST['comfirma_pass'];
            // Verificar si las contraseñas coinciden
            if ($pass !== $comfirma_pass) {
                echo "<script>
                alert('Las contraseñas no coinciden!!');
                window.history.back(); 
              </script>";
                exit();
            };
        };
        $rol = $_POST['rol'] ?? 3;

        $controlador->guardaUsuario($nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $pass, $rol);
    }

    ?>

    <div class="container col-md-4">
        <form action="" method="POST" name="nuevo" class="">
            <legend class="text-center mb-4 h1"><strong>Crea tu cuenta</strong></legend>
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer apellido">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo apellido">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>
             <div class="form-group">
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
            </div>
            <?php if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) { ?>           
            <div class="form-group">
                <input type="password" class="form-control" id="comfirma_pass" name="comfirma_pass"
                    placeholder="Confirmar Contraseña">
            </div>
            <?php }else{}; ?>
            

            <div class="form-group text-center mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Registrarse</button>
                <button type="button" class="btn btn-secondary"
                    onclick="location.href='../../../app/vista/usuarios/usuariosLista.php'">Cancelar</button>
            </div>
        </form>
    </div>



    <!-- Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>