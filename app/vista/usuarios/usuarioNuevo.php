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

    require_once ('../../controlador/usuariosControlador.php');
    $controlador=new UsuariosControlador();

    //si tenemos el post asignamos variables
    if(isset($_POST) && !empty($_POST)){
    $nombre=$_POST['nombre'];
    $apellido1=$_POST['apellido1'];
    $apellido2=$_POST['apellido2'];
    $direccion=$_POST['direccion'];
    $telefono=$_POST['telefono'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $comfirma_pass=$_POST['comfirma_pass'];
    $rol=$_POST['rol']?? 3;

    // Verificar si las contraseñas coinciden
    if ($pass !== $comfirma_pass) {
        echo "Las contraseñas no coinciden.";
        exit();
    };

   

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
            <div class="form-group">
                <input type="password" class="form-control" id="comfirma_pass" name="comfirma_pass" placeholder="Confirmar Contraseña">
            </div>
           
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-success mr-4">Registrarse</button>
                <button type="button" class="btn btn-danger ml-4" onclick="location.href='../../../public/index.php'">Cancelar</button>
            </div>
        </form>
    </div>

    

    <!-- Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
