<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: ../../index.php');
    exit();
}
?>
<?php        

  require_once 'Zebra_Pagination-master/Zebra_Pagination.php';
  //concexion a la base para paginacion
  $conn = pg_connect("host=raja.db.elephantsql.com dbname=npyottjk user=npyottjk password=MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd");
  ///variables para paginacion
  $total = pg_query($conn, "SELECT count (*) FROM reserva");
  $resul = 10;
  //mandar los parametros para la paginacion
  $paginacion = new Zebra_Pagination();
  $paginacion->records($total);
  $paginacion->records_per_page($resul);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Reserva de Laboratorios</title>

<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

<!-- font awesome -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- bootstrap -->
<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css" />

<!-- animate.css -->
<link rel="stylesheet" href="../../assets/animate/animate.css" />
<link rel="stylesheet" href="../../assets/animate/set.css" />

<!-- gallery -->
<link rel="stylesheet" href="../../assets/gallery/blueimp-gallery.min.css">

<!-- favicon -->
<link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
<link rel="icon" href="../../images/favicon.ico" type="image/x-icon">


<link rel="stylesheet" href="../../assets/style.css">

</head>
<body><br><br><br><br><br><br><br><br>

<div id="contact" class="spacer">
<!-- Header Starts -->
<div class="navbar-wrapper">
      <div class="container">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
          <div class="container">
            <div class="navbar-header">
              <!-- Logo Starts -->
              <a class="navbar-brand" href="../../index.php"><img src="../../images/LOGO1.png" alt="logo"></a>
              <!-- #Logo Ends -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
             <!-- Nav Starts -->
             <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                 <li class="active"><a href="../../index.php">Home</a></li>
                 <li ><a href="../../index.php#about">Nosotros</a></li>
                 <?php
                    if (!isset($_SESSION['usuario'])) {
                      ?>
                       <li ><a href="viewCalendar.php">Calendario</a></li>
                       <?php
                    }
                    else{
                      if($_SESSION['tipo']=="administrador"){
                        ?>
                          <li ><a href="calendarADM.php">Calendario</a></li>
                          <li ><a href="AddPeticion.php">Reservar</a></li>
                          <li ><a href="peticion.php">Peticion</a></li>
                          <li ><a href="AddUsuario.php">Registrar usuario</a></li>
                          <li ><a href="AddLaboratorio.php">Registrar laboratorio</a></li>
                         <?php
                      }
                      else{
                        ?>
                          <li ><a href="calendar.php">Calendario</a></li>
                          <li ><a href="AddPeticion.php">Reservar</a></li>
                          <?php
                      }
                    }
                  ?>        
                  <li><a href="../../salir.php"><?php echo('Salir ('.$_SESSION['usuario'].')') ?></a></li>
              </ul>
            </div>
            <!-- #Nav Ends -->

          </div>
        </div>
      </div>
    </div>
<!-- #Header Starts -->
</form>
</div>
<!--Login Ends-->

<div class = "container">
  <aside class="col-sm-4 col-sm-push-0">
      <div class="widget search">
          <form name="form1" method="GET" action = "AddPeticion.php" id="cdr">
              <h2>Buscar Peticion</h2>
              <h6>Por numero de laboratorio</h6>
              <div class="form-group">
                  <input class="form-control"  name="buscar" type="text" id="busqueda" placeholder="Busqueda" autocomplete="off">
                  <span class="input-group-btn">
                      <button class="btn btn-xs btn-info" type="submit" name="submit" value="Buscar"><i class="icon-search">Buscar</i></button>
                  </span>
              </div>
          </form>
      </div>
  </aside>
</div>
 
<div class='container'>
<table class='table'>
  <thead class="thead-dark">
  <tr class='warning'>
    <th scope="col" >Laboratorio</th>
    <th scope="col" >peticion</th>
    <th scope="col" >Motivo</th>
    <th scope="col" >inicio</th>
    <th scope="col" >fin</th>
    <th scope="col" >costo</th>
    <th scope="col" >estado</th>
    <th scope="col" >Opciones</th>
    </tr>
  </thead>
    <tbody>
        <?php
    if (isset($_GET['buscar']))
        {
            $buscar = $_GET['buscar'];

            require("../../conexion.php");
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id ,numero_laboratorio,usuario_peticion, motivo_peticion,reserva_inicio,reserva_fin,costo_reserva,estado_reserva FROM reserva WHERE numero_laboratorio =?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($buscar));
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $PDO = null;
            if(empty($data)) {
                
              header("Location: ../../index.php");
            
            }
            foreach($data as $row) {
              echo'<tr>';
              echo'<td>'.$row['numero_laboratorio'].'</td>';
              echo'<td>'.$row['usuario_peticion'].'</td>';
              echo'<td>'.$row['motivo_peticion'].'</td>';
              echo'<td>'.$row['reserva_inicio'].'</td>';
              echo'<td>'.$row['reserva_fin'].'</td>';
              echo'<td>'.$row['costo_reserva'].'</td>';
              echo'<td>'.$row['estado_reserva'].'</td>';
              if($row['estado_reserva']=='aceptado'){
                echo'<a class="btn btn-xs btn-success" href="peticion.php?id='.$row['id'].'" disabled >Resolver</a>';
              
              }else{
                if($row['estado_reserva']=='denegado'){
                  echo'<a class="btn btn-xs btn-danger" href="peticion.php?id='.$row['id'].'" disabled >Resolver</a>';
                }else{
                  echo'<a class="btn btn-xs btn-info" href="peticion.php?id='.$row['id'].'">Resolver</a>';
                }
              }
              echo'</td>';
              echo'</th>';
            }
          }
        else {

          require("../../conexion.php");
          $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT id ,numero_laboratorio,usuario_peticion, motivo_peticion,reserva_inicio,reserva_fin,costo_reserva,estado_reserva FROM reserva";
          $stmt = $PDO->prepare($sql);
          $stmt->execute(array());
          $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $PDO = null;
          if(empty($data)) {    
            header("Location: ../../index.php");
          }
          foreach($data as $row) {
            echo'<tr>';
            echo'<td>'.$row['numero_laboratorio'].'</td>';
            echo'<td>'.$row['usuario_peticion'].'</td>';
            echo'<td>'.$row['motivo_peticion'].'</td>';
            echo'<td>'.$row['reserva_inicio'].'</td>';
            echo'<td>'.$row['reserva_fin'].'</td>';
            echo'<td>'.$row['costo_reserva'].'</td>';
            echo'<td>'.$row['estado_reserva'].'</td>';
            echo'<td>';
            if($row['estado_reserva']=='aceptado'){
              echo'<a class="btn btn-xs btn-success" href="peticion.php?id='.$row['id'].'" disabled >Resolver</a>';
            
            }else{
              if($row['estado_reserva']=='denegado'){
                echo'<a class="btn btn-xs btn-danger" href="peticion.php?id='.$row['id'].'" disabled >Resolver</a>';
              }else{
                echo'<a class="btn btn-xs btn-info" href="peticion.php?id='.$row['id'].'">Resolver</a>';
              }
            }
            echo'</td>';
            echo'</tr>';
        }
        }
    ?>
    </tbody>
    <?php $paginacion->render(); ?>
</table>
</div>


<!-- Footer Starts -->
<div class="footer text-center spacer">
<p class="wowload flipInX"><a href="#"><i class="fa fa-facebook fa-2x"></i></a> <a href="#"><i class="fa fa-instagram fa-2x"></i></a> <a href="#"><i class="fa fa-twitter fa-2x"></i></a> <a href="#"><i class="fa fa-flickr fa-2x"></i></a> </p>
Copyright 2019 Universidad Centroamericana José Simeón Cañas. All rights reserved.
</div>
<!-- # Footer Ends -->
<a href="#home" class="gototop "><i class="fa fa-angle-up  fa-3x"></i></a>





<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title">Title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->    
</div>



<!-- jquery -->
<script src="../../assets/jquery.js"></script>

<!-- wow script -->
<script src="../../assets/wow/wow.min.js"></script>


<!-- boostrap -->
<script src="../../assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>

<!-- jquery mobile -->
<script src="../../assets/mobile/touchSwipe.min.js"></script>
<script src="../../assets/respond/respond.js"></script>

<!-- gallery -->
<script src="../../assets/gallery/jquery.blueimp-gallery.min.js"></script>

<!-- custom script -->
<script src="../../assets/script.js"></script>

</body>
</html>