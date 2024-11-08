<?php 
    // Incluir el header 
    include '../layouts/header.php';    
?>

   
   <?php  
   require_once ('../../controlador/trasterosControlador.php');
   $trasteros= new TrasterosControlador();
   
   if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) {
       $fila=$trasteros->listaTrasteros();         
   }else{
       $fila=$trasteros->listaTrasterosAdmin();
   };
   ?>   

       
<div class="galeriaTrasteros">
   <div style="background-image: url('/trasteros1024/public/multimedia/img/orden1.jpg');"></div>
   <div style="background-image: url('/trasteros1024/public/multimedia/img/orden5.jpg');"></div>
   <div style="background-image: url('/trasteros1024/public/multimedia/img/orden2.jpg');"></div>
   <div style="background-image: url('/trasteros1024/public/multimedia/img/orden3.jpg');"></div>
   <div style="background-image: url('/trasteros1024/public/multimedia/img/orden4.jpg');"></div>
</div>

<section class="contenedorTrasteros" id="contenedor1">
    <h2>Consejos Inteligentes</h2>
    <h3>Manten tu Trastero Siempre en Orden</h3>
    <div class="divTrasteros">
       <div class="tarjeta">  
            <h3>Divide y vencerás</h3>          
           <p>Imagina un espacio donde cada objeto tiene su lugar designado, donde encontrar lo que necesitas es tan fácil como abrir una puerta. Esa es la magia de tener un trastero ordenado.</p>
       </div>
       <div class="tarjeta">
           <h3>Organiza</h3> 
           <p>Con un trastero organizado, puedes maximizar el espacio, proteger tus pertenencias y acceder a ellas de manera rápida y eficiente.</p>
       </div>
       <div class="tarjeta">
           <h3>Crea</h3> 
           <p>Es el santuario perfecto para tus cosas, donde cada elemento tiene su propósito y contribuye a crear un ambiente armonioso en tu vida diaria.</p>
       </div>
    </div>   
</section>

<section class="plano" id="situacionTrasteros">
    <h2>Plano de situación Trasteros</h2>
    <p>Selecciona el trastero que más te interese y podrás acceder a un video detallado del mismo. Descubre todas sus características y decide con mayor seguridad.</p>    
    <p>Pulsa sobre la imagen el trastero a seleccionar o el número en la lista que estás interesado y acccede al video.</p>                
</section>
<section class="seccionPlano"> 
    <img src="/trasteros1024/public/multimedia/img/plano.jpg" alt="plano situacion trasteros" usemap="#planoTrasteros" id="imgPlano">
    <map name="planoTrasteros">
        <area target="" alt="1" href="#video" title="Trastero 1"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-1.mp4')" coords="953,235,1052,104" shape="rect">
        <area target="" alt="3" title="Trastero 3" href="#video" title="Trastero 3"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-3.mp4')" coords="949,235,864,105" shape="rect">
        <area target="" alt="5" title="Trastero 5" href="#video" title="Trastero 5"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-5.mp4')" coords="777,232,858,100" shape="rect">
        <area target="" alt="7" title="Trastero 7" href="#video" title="Trastero 7"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-7.mp4')" coords="770,235,710,103" shape="rect">
        <area target="" alt="9" title="Trastero 9" href="#video" title="Trastero 9"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-9.mp4')" coords="642,102,705,235" shape="rect">
        <area target="" alt="11" title="Trastero 11" href="#video" title="Trastero 11"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-11.mp4')" coords="543,99,637,236" shape="rect">
        <area target="" alt="13" title="Trastero 13" href="#video" title="Trastero 13"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-13.mp4')"  coords="439,99,538,233" shape="rect">
        <area target="" alt="15" title="Trastero 15" href="#video" title="Trastero 15"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-15.mp4')"  coords="334,99,433,232" shape="rect">
        <area target="" alt="17" title="Trastero 17" href="#video" title="Trastero 17"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-17.mp4')" coords="231,98,328,232" shape="rect">
        <area target="" alt="19" title="Trastero 19" href="#video" title="Trastero 19"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-19.mp4')" coords="84,98,226,199" shape="rect">
        <area target="" alt="21" title="Trastero 21" href="#video" title="Trastero 21"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-21.mp4')" coords="86,201,176,301" shape="rect">
        <area target="" alt="23" title="Trastero 23" href="#video" title="Trastero 23"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-23.mp4')" coords="86,308,175,416" shape="rect">
        <area target="" alt="2" title="Trastero 2" href="#video" title="Trastero 2"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-2.mp4')" coords="1047,297,1132,409" shape="rect">
        <area target="" alt="4" title="Trastero 4" href="#video" title="Trastero 4"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-4.mp4')" coords="958,297,1044,409" shape="rect">
        <area target="" alt="6" title="Trastero 6" href="#video" title="Trastero 6"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-6.mp4')" coords="870,298,951,437" shape="rect">
        <area target="" alt="8" title="Trastero 8" href="#video" title="Trastero 8"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-8.mp4')" coords="784,297,865,438" shape="rect">
        <area target="" alt="10" title="Trastero 10" href="#video" title="Trastero 10"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-10.mp4')" coords="674,298,773,436" shape="rect">
        <area target="" alt="12" title="Trastero 12" href="#video" title="Trastero 12"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-12.mp4')" coords="464,297,560,525" shape="rect">
        <area target="" alt="14" title="Trastero 14" href="#video" title="Trastero 14"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-14.mp4')" coords="373,297,461,524" shape="rect">
        <area target="" alt="16" title="Trastero 16" href="#video" title="Trastero 16"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-16.mp4')" coords="241,297,365,427" shape="rect">
        <area target="" alt="18" title="Trastero 18" href="#video" title="Trastero 18"  onclick="mostrarVideo('/trasteros1024/public/multimedia/img/videos/vt-18.mp4')" coords="241,429,367,526" shape="rect">
    </map>
    <video id="video" controls style="display:none;" muted>
    <source src="" type="video/mp4">
    </video>
</section>




<?php if (!isset( $_SESSION['rol']) || $_SESSION['rol'] != 1){ ?>


   
<?php } ?>
       
       <div class="container mt-3 ">
           <div class="btnTrasteros mb-4 ml-0 mr-0"> 
                <a href="#tablaTrasteros" onclick="mostrarTrasterosDisponibles()">     
                    <div class="btnTrasteroa">
                        <h5>Trasteros Disponibles</h5>               
                    </div>
                </a> 
                <a href="#tablaTrasteros" onclick="refrescarPagina()"> 
                    <div class="btnTrasteroa">
                        <h5>Lista Trasteros completa</h5>               
                    </div>
                </a>
        </div>
           <div class="row justify-content-center">
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header h1 text-center">
                           Lista de Trasteros
                       </div>
                       <div class="p-0">
                           <table class="table text-center" id="tablaTrasteros">
                               <thead>
                                   <tr>
                                       <th scope="col">Trastero</th>
                                       <th scope="col">Tamaño</th>
                                       <th scope="col">Precio</th>
                                       <?php  if (isset( $_SESSION['rol']) && $_SESSION['rol'] == 1){
                                           echo "<th scope='col'>Alquilado por:</th>";
                                       } else { 
                                           echo "<th scope='col'>Descripción</th>";
                                           echo "<th scope='col'>Disponible</th>";
                                       }?>                                    
                                   </tr>
                               </thead>
                               <tbody>
                                <?php foreach($fila as $trastero){ ?>
                                    <tr>
                                        <td><a href="<?php echo $trastero['url']?>" target="_blank"><?php echo $trastero['id_trastero']?></a></td>
                                        <td><?php echo $trastero['tamaño']?></td>
                                        <td><?php echo $trastero['precio']  ?></td>
                                        <?php  if (isset( $_SESSION['rol']) && $_SESSION['rol'] == 1) {
                                            echo "<td>".$trastero['nombre'].' '.$trastero['apellido_1'].' '.$trastero['apellido_2']."</td>";
                                        }else{
                                            echo "<td>".$trastero['descripcion']."</td>";
                                            echo "<td>".($trastero['disponible']==1 ? 'Si' : 'No')."</td>";
                                        }; ?>                                
                                    </tr>
                                <?php } ?>
                                </tbody>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
       </div>
                              
      
         
       
       <?php require ('../layouts/footer.php');//incluimos el footer comun?>  

</body>
</html>
