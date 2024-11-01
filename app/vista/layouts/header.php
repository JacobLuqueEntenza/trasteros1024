<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="stylesheet" href="/proyecto-daw/public/css/estilos.css">
    <!-- Enlaza los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">      
</head>

<body class="hidden">
    <header class="header" id="header">
        <nav class="navbar">
            <h3 class="nombre">tutrasteroenhuelva.es</h3>
            <input  class="menu" type="checkbox"  id="menu">
            <label for="menu" class="lblHamburguesa">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="hamburguesa" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                </svg>
            </label>
            <ul class="ulMenu">
                <li class="liMenu"><a class="aMenu" href="/proyecto-daw/public/index.php">Inicio</a> </li>
                <li class="liMenu"><a class="aMenu" href="/proyecto-daw/app/vista/trasteros/trasteros.php">Trasteros</a> </li>
                <li class="liMenu"><a class="aMenu" href="/proyecto-daw/app/vista/layouts/contacto.php">Contacto</a> </li>
                <?php  
                session_start();
                //si el rol es distinto de tres nos aparecera pagos y recibos
                if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] != 3){ ?>
                    <li class="liMenu"><a class="aMenu" href="/proyecto-daw/app/vista/averias/averiasLista.php">Averias</a> </li>                    
                           
                    <li class="liMenu"><a class="aMenu" href="/proyecto-daw/app/vista/recibos/recibosLista.php">Recibos</a> </li>
                <?php } 
                if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 1){ ?>
                <li class="liMenu"><a class="aMenu" href="/proyecto-daw/app/vista/usuarios/usuariosLista.php" onclick="borrarCliente();">Usuarios</a> </li>
                <?php } ?>    

    <?php 
        
        if(!isset($_SESSION['usuario'])){?>

            <li class="liMenu"><img id="imglogin" src="/proyecto-daw/public/img/Login.ico" alt="login"><a class="aMenu" href="/proyecto-daw/app/vista/usuarios/login.php">Login</a></li>  
            <!--<li class="liMenu"><a class="aMenu" href="/proyecto-daw/app/vista/usuarios/usuarioNuevo.php">Registrate</a></li> -->

    <?php
         }else{ ?>
             <li class="liMenu"><a class="aMenu" href="">Hola, <?php echo $_SESSION['usuario']; ?>  </a></li>
             <li class="liMenu"><a class="aMenu" href="/proyecto-daw/app/controlador/cerrarSesionControlador.php">CerrarSesión</a></li>        
    <?php
    };
    ?>       
            </ul> 
        </nav>
    </header>
        
