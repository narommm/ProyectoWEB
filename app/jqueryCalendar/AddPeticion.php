<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: viewCalendar.php');
    exit();
}
?>
<?php        
        if(!empty($_POST)) {

        // validation errors
        $numero_laboratorioError = null;
        $reserva_inicioError = null;
        $reserva_finError = null;
        $reserva_fechaError = null;
        $descripcionError = null;

        // post values
        require "input-filter/class.inputfilter.php";
        $filter = new InputFilter(array('b'), array ('src'));

        $numero_laboratorio = $filter->process(trim($_POST['nombre_servicio']));
        $descripcion_servicio = $filter->process(trim($_POST['descripcion_servicio']));

        // validate input
        $valid = true;
        if(empty($nombre_servicio)) {
            $nombre_servicioError = "Por favor ingrese el nombre del servico.";
            $valid = false;
        }
        
        if(empty($descripcion_servicio)) {
            $descripcion_servicioError = "Por favor ingrese la descripcion del servicio.";
            $valid = false;
        }
        
        // insert data
        if($valid) {
            require("../../conexion.php");
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO reserva(n, descripcion_servicio) values(?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombre_servicio, $descripcion_servicio));
            $PDO = null;
            header('location: AddReserva.php');
        }
    }
    require_once 'Zebra_Pagination-master/Zebra_Pagination.php';
//concexion a la base para paginacion
$conn = mysql_connect("localhost", "root") or die("error");

mysql_select_db("ShoppStore", $conn) or die("error 2 ");
///variables para paginacion
$total = mysql_query("SELECT count(*) FROM servicios", $conn);
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
<title>Cyrus Studio</title>

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
              <a class="navbar-brand" href="index.php"><img src="../../images/LOGO1.png" alt="logo"></a>
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
                 <li ><a href="../../index.php/#about">About</a></li>
                 <?php
                    if (!isset($_SESSION['usuario'])) {
                       //<li ><a href="calendar.php">Calendar</a></li>
                    }
                    else{
                      if($_SESSION['tipo']=="administrador"){
                         //<li ><a href="calendar.php">Calendar</a></li>
                      }
                      else{
                         //<li ><a href="calendar.php">Calendar</a></li>
                      }
                    }
                  ?>
                  <li ><a href="viewCalendar.php">Calendar</a></li>  
                  <li ><a href="AddPeticion.php">Reservar</a></li>
                 <li><a href="../../salir.php">Salir</a></li>
              </ul>
            </div>
            <!-- #Nav Ends -->
          </div>
        </div>
      </div>
    </div>
<!-- #Header Starts -->
<!--Login Starts-->

<form class="container contactform center" role="form" method ='POST'>
<h2 class="text-center  wowload fadeInUp">Reserva un laboratorio</h2>
  <form class="row wowload fadeInLeftBig">      
      <div class="col-sm-3 col-sm-offset-2 col-xs-12">
        <input type="text" placeholder="# Laboratorio" id="usuario" name="usuario" required>
        <input type="text" placeholder="<?php echo $_SESSION['usuario'];?>" id="usuario" name="usuario" disabled value="<?php echo $_SESSION['usuario'];?>">
      </div>
      <div class="col-sm-8 col-sm-offset-2 col-xs-12">
        <label for="appt">Choose a time for your meeting:</label> 
        <input type="time" id="appt" name="appt"
                min="07:00" max="18:00" required>
        <label for="appt">Choose a time for your meeting:</label>
        <input type="time" id="appt" name="appt"
                min="09:00" max="18:00" required> 
      </div>
      <div class="col-sm-8 col-sm-offset-2 col-xs-12"> 
      <label for="start">Fecha que desea reservar</label>
        <input type="date" id="start" name="trip-start"
                min="2019-01-01" max="2019-12-31" required>            
        <textarea rows="8" placeholder="Peticion" required></textarea>
        <button class="btn btn-primary"><i class="fa fa-paper-plane" type="submit"></i>Enviar</button>
      </div>
  </form>



</form>
</div>
<!--Login Ends-->



<!-- Footer Starts -->
<div class="footer text-center spacer">
<p class="wowload flipInX"><a href="#"><i class="fa fa-facebook fa-2x"></i></a> <a href="#"><i class="fa fa-instagram fa-2x"></i></a> <a href="#"><i class="fa fa-twitter fa-2x"></i></a> <a href="#"><i class="fa fa-flickr fa-2x"></i></a> </p>
Copyright 2014 Cyrus Creative Studio. All rights reserved.
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
<script src="assets/jquery.js"></script>

<!-- wow script -->
<script src="assets/wow/wow.min.js"></script>


<!-- boostrap -->
<script src="assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>

<!-- jquery mobile -->
<script src="assets/mobile/touchSwipe.min.js"></script>
<script src="assets/respond/respond.js"></script>

<!-- gallery -->
<script src="assets/gallery/jquery.blueimp-gallery.min.js"></script>

<!-- custom script -->
<script src="assets/script.js"></script>

</body>
</html>