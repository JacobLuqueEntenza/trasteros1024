<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../librerias/PHPMailer/src/Exception.php';
require '../../librerias/PHPMailer/src/PHPMailer.php';
require '../../librerias/PHPMailer/src/SMTP.php';

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $asunto = htmlspecialchars(trim($_POST['asunto']), ENT_QUOTES, 'UTF-8');
    $mensaje = htmlspecialchars(trim($_POST['mensaje']), ENT_QUOTES, 'UTF-8');

    if (empty($nombre)) $errores[] = "El campo Nombre es obligatorio.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "El Email no tiene un formato válido.";
    if (empty($asunto)) $errores[] = "El campo Asunto es obligatorio.";
    if (empty($mensaje)) $errores[] = "El campo Mensaje es obligatorio.";

    if (empty($errores)) {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tutrasteroenhuelva@gmail.com';
            $mail->Password = 'crpt qmqk nisj vcgi'; // Cambia esto por variables de entorno
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('tutrasteroenhuelva@gmail.com', 'Tu Trastero');
            $mail->addAddress('tutrasteroenhuelva@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = "
                <h1>Nuevo mensaje de contacto</h1>
                <p><strong>Nombre:</strong> $nombre</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Mensaje:</strong> $mensaje</p>
            ";
            $mail->AltBody = "Nuevo mensaje de contacto\nNombre: $nombre\nEmail: $email\nMensaje: $mensaje";

            if ($mail->send()) {
                echo '<script>alert("Mensaje enviado correctamente."); window.location.href="/trasteros1024/app/vista/layouts/gracias.php";</script>';
            } else {
                echo '<script>alert("No se pudo enviar el mensaje. Intenta nuevamente."); window.history.back();</script>';
            }
        } catch (Exception $e) {
            echo '<script>alert("Hubo un error al enviar el mensaje: ' . $mail->ErrorInfo . '"); window.history.back();</script>';
        }
    } else {
        foreach ($errores as $error) {
            echo '<script>alert("' . $error . '"); window.history.back();</script>';
        }
    }
}
?>
