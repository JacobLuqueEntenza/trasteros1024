<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/trasteros1024/public/css/estilos.css">
    <!-- Enlaza los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <?php
    require_once '../../controlador/usuariosControlador.php';
    $usuarios = new UsuariosControlador();
    if (isset($_POST['email']) && ($_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $usuarios->login($email, $pass);
    }
    ;
    ?>
    <h1 id="h1Login" style="text-align: center;margin-top:5em"><a id="ah1Login" href="/trasteros1024/public/index.php">tutrasteroenhuelva.es</a></h1>
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Acceso</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                <label for="floatingInput">Correo Electrónico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating mb-3">
                <a href="usuarioNuevo.php">Registrate, si todavía no estás. Pulsa aquí</a>
            </div>

            <button class="btn btn-success w-100 py-2" type="submit">Entrar</button>

        </form>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>