<?php


ob_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="stylesheet" href="http://localhost/trasteros1024/public/css/estilos.css">


</head>

<body>
    <?php

    require('../../../app/controlador/recibosControlador.php');
    $recibos = new RecibosControlador();


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $recibo = $recibos->editar($id);
    } else {
        echo ("No tengo id del recibo");
    }
    ;
    ?>
    <div class="pdfDiv">
        <h1>tutrasteroenhuelva.es</h1>
        <table class="pdfRecibo">
            <tr>
                <th colspan="2">Recibo Nº:</th>
            </tr>
            <tr>
                <td class="td1"><?php echo $recibo['id_recibo'] ?></td>                
            </tr>
            <tr>
                <th>Fecha:</th>
                <th>Cliente:</th>
            </tr>
            <tr>               
                <td class="td1"><?php echo date("d-m-Y"); ?></td>
                <td><?php echo $recibo['nombre'] . " " . $recibo['apellido_1'] . " " . $recibo['apellido_2'] ?></td>
            </tr>
            <tr>
                <td><strong>Dirección:</strong> <?php echo $recibo['direccion'] ?></td>
                <td><strong>Teléfono:</strong> <?php echo $recibo['telefono'] ?></td>
            </tr>
        </table>


        <table class="pdfConcepto">
            <tr>
                <th>Concepto</th>
                <th>Precio</th>
            </tr>
            <tr>
                <td><?php echo $recibo['concepto'] ?></td>
                <td><?php echo $recibo['precio'] ?></td>
            </tr>
            <tr>
                <td>21% de IVA incluido en el precio.</td>
                <td></td>
            </tr>
        </table>
        <table class="pdfPago">
            <tr>
                <th>Pago realizado por:</th>
                <th><?php echo $recibo['formaPago'] ?></th>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>
        <br>
        <div class="direccion">                
                <p>Rosendo Luque Lafuente</p>
                <img id="firmapdf" src="http://localhost/trasteros1024/public/multimedia/img/firma.jpg" alt="firma" width="300" height="200">
                <p>Telefono: 611 80 28 37</p>
                <p>email: tutrasteroenhuelva@gmail.com</p>
                <p>Calle Legión Española 6</p>
                <p>21005 Huelva</p>
        </div>


        
    </div>



</body>

</html>

<?php

$html = ob_get_clean();
//echo $html;

require_once('../../../librerias/dompdf/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
$dompdf = new Dompdf();
//opciones para activar imagenes, si no no imprime imagenes
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
//creamos el formato del documento pdf
$dompdf->setPaper('A4', 'portrait');//formato A4 vertical
//$dompdf->setPaper('letter'); para una carta

// Renderizar el PDF
$dompdf->render();

// Verificar si se produjo algún error durante la renderización
try {
    $dompdf->render();
    $dompdf->stream("Recibo " . $recibo['concepto'].date('Y') . "pdf", array("Attachment" => true));//false para verlo en navegador, true para descargarlo
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}


?>