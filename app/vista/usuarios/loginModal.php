<!-- Modal de Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                require_once '../../controlador/usuariosControlador.php';
                $usuarios = new UsuariosControlador();
                $error = '';

                if (isset($_POST['email']) && isset($_POST['pass'])) {
                    $email = $_POST['email'];
                    $pass = $_POST['pass'];

                    try {
                        $usuarios->login($email, $pass);
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                    }
                }
                ?>

                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="pass" name="pass" required>
                    </div>
                    <div class="mb-3">
                        <a href="usuarioNuevo.php">¿No tienes cuenta? Regístrate aquí</a>
                    </div>
                    <button type="submit" class="btn btn-success">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>