<?php
//importamos la librería de phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../librerias/PHPMailer/src/Exception.php';
require '../../librerias/PHPMailer/src/PHPMailer.php';
require '../../librerias/PHPMailer/src/SMTP.php';
require_once('averiasControlador.php');
require_once('../../config/conexion.php');

$averias = new AveriasControlador();

//array para capturar los posible errores
$errores = array();
//si no esta definida la sesion o usuario, no dejarlo ver
/*if (!isset($_SESSION['usuario']) || $_SESSION['rol'] <3) {
    header('Location: /tutrastero/tutrastero/public/index.php');
    exit;
};*/
//si tenemos el post asignamos variables
if (isset($_POST['btnAveria'])) {
  $fecha = date('Y-m-d');
  $descripcion = $_POST['descripcion'];
  $estado = $_POST['estado'];
  $trastero = $_POST['trastero_id'];
  $id = $_POST['trastero_id'];

  //validaciones
  if (empty($descripcion)) {
    $errores[] = "El campo Descripcion es obligatorio";
  };

  // Capturamos los datos del usuario
$clienteTrastero = $averias->correoTrastero($id);

if (!empty($clienteTrastero) && isset($clienteTrastero[0]['nombre'], $clienteTrastero[0]['email'])) {
    $datosCliente = $clienteTrastero[0];

    // Damos valores a las variables del correo
    $nombre = $datosCliente['nombre'];
    $email = $datosCliente['email'];
    $mensaje = $descripcion;
    $asunto = 'Necesito reparación';
} else {
    $errores[] = "No se pudo obtener la información del cliente o está incompleta.";
};

  

  if (count($errores) == 0) {
    $cuerpo = "Mensaje enviado por: $nombre<br>";
    $cuerpo .= "Email para contactar: $email<br>";
    $cuerpo .= "Asunto: $asunto<br><br>";
    $cuerpo .= "Mensaje:<br>$mensaje ";

    //Creamos la instancia de la clase phpmailer
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth = true;                                   //Enable SMTP authentication
      $mail->Username = 'tutrasteroenhuelva@gmail.com';                     //SMTP username
      $mail->Password = 'crpt qmqk nisj vcgi';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('tutrasteroenhuelva@gmail.com');
      $mail->addAddress('tutrasteroenhuelva@gmail.com');

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $asunto;
      $mail->Body = $cuerpo;

      $mail->CharSet = 'UTF-8';

      $mail->send();

      // Enviamos una respuesta automática al remitente
      $responderMail = new PHPMailer(true);

      try {
        //Server settings
        $responderMail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $responderMail->isSMTP();                                            //Send using SMTP
        $responderMail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $responderMail->SMTPAuth = true;                                   //Enable SMTP authentication
        $responderMail->Username = 'tutrasteroenhuelva@gmail.com';                     //SMTP username
        $responderMail->Password = 'crpt qmqk nisj vcgi';                               //SMTP password
        $responderMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $responderMail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        // Configuramos la respuesta automática
        $responderMail->setFrom('tutrasteroenhuelva@gmail.com');
        $responderMail->addAddress($email); // Dirección de correo electrónico del remitente
        $responderMail->Subject = 'Incidendia avería';
        $responderMail->Body = "Usted o el administrador ha reportado la siguiente incidencia sobre su trastero: $mensaje. 
            Estamos procesando su solicitud y nos pondremos en contacto con usted pronto posible.";
        $responderMail->isHTML(true);
        $responderMail->CharSet = 'UTF-8';
        // Enviamos la respuesta automática
        $responderMail->send();
      } catch (Exception $e) {
        echo "Error al enviar respuesta automática: " . $e->getMessage();
      }

      echo '<script type="text/javascript">alert("Mensaje enviado correctamente");</script>';
      echo '<script type="text/javascript">function Redirect(){window.location="../../public";}setTimeout("Redirect()", 100);</script>';




    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  } else {
    echo '<script type="text/javascript">alert("Campo descripcion vacío, por favor rellenalo, gracias.");</script>';
    echo '<script type="text/javascript">function Redirect(){window.location="../vista/averias/averiaNuevo.php";}setTimeout("Redirect()", 100);</script>';

  }
  $averias->guardarAveria($fecha, $descripcion, $estado, $trastero);
}
;









?>