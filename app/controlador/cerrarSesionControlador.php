<?php
session_start();

function cerrarSesion() {
    // Destruir todas las variables de sesión
    $_SESSION = array();

    // Borrar la cookie de sesión
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destruir la sesión
    session_destroy();

    // Redirigir a la página de inicio de sesión u otra página deseada
    header("Location: /proyecto-daw/public/index.php");
    exit;
}

// Llamar a la función para cerrar sesión
cerrarSesion();
?>