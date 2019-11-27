<?php
/* verificanco inicio de sesion con credenciales y mostrando calendario con reservas*/
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: viewCalendar.php');
    exit();
}
?>
<?php        
        if(!empty($_POST)) {

        // validacion de errores
        $numero_laboratorioError = null;
        $reserva_inicioError = null;
        $reserva_finError = null;
        $reserva_fechaError = null;
        $descripcionError = null;

        // despues del valor
        require "input-filter/class.inputfilter.php";
        $filter = new InputFilter(array('b'), array ('src'));

        $numero_laboratorio = $filter->process(trim($_POST['nombre_servicio']));
        $descripcion_servicio = $filter->process(trim($_POST['descripcion_servicio']));

        // calidando la entrada 
        $valid = true;
        if(empty($nombre_servicio)) {
            $nombre_servicioError = "Por favor ingrese el nombre del servico.";
            $valid = false;
        }
        
        if(empty($descripcion_servicio)) {
            $descripcion_servicioError = "Por favor ingrese la descripcion del servicio.";
            $valid = false;
        }
        
        // insertando daos a base de datos
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

<!-- requiriendo Google fonts para poder usar el directorio iteractivo que nos facilitara el uso de fuentes de la web-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

<!--inicializando el uso de frameworks de font awesome para el uso de iconos -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- usando la biblioteca bootstrap para el suo de plantilas, formularios, botones y cuadros de nuestra página-->
<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css" />

<!-- conectando animate.css para las animaciones y configuraciones de la página-->
<link rel="stylesheet" href="../../assets/animate/animate.css" />
<link rel="stylesheet" href="../../assets/animate/set.css" />

<!-- agregando gallery.min.css junto con totas las animaciones de imagenes y cuerpo de la página -->
<link rel="stylesheet" href="../../assets/gallery/blueimp-gallery.min.css">

<!-- requiriendo los iconos de favicon y las imagenes que seran de utilidad en nuestra web -->
<link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
<link rel="icon" href="../../images/favicon.ico" type="image/x-icon">

<!--utilizando los estilos de animacion de css-->
<link rel="stylesheet" href="../../assets/style.css">

</head>
<body><br><br><br><br><br><br><br><br>
<div id="contact" class="spacer">
<!-- Header iniciado -->
<div class="navbar-wrapper">
      <div class="container">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
          <div class="container">
            <div class="navbar-header">
              <!-- insertando Logo -->
              <a class="navbar-brand" href="index.php"><img src="../../images/LOGO1.png" alt="logo"></a>
              <!-- creando boton -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <!-- insertando iconos de span -->
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <!--iniciando nav -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
              <!-- creando acceso a inicio y un acerca de  -->
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
                  <!--  refdireccionando a calendar y a solicitud de reservas -->
                  <li ><a href="viewCalendar.php">Calendar</a></li>  
                  <li ><a href="AddPeticion.php">Reservar</a></li>
                 <li><a href="../../salir.php">Salir</a></li>
              </ul>
            </div>
            <!-- fin de navs-->
          </div>
        </div>
      </div>
    </div>
<!-- finalizando header-->
<!--iniciando login-->
<!-- creando un fomulario de registro de reserva de laboratorio -->
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
<!--finalizando login-->



<!-- iniciando pie de pagina -->
<div class="footer text-center spacer">
<p class="wowload flipInX"><a href="#"><i class="fa fa-facebook fa-2x"></i></a> <a href="#"><i class="fa fa-instagram fa-2x"></i></a> <a href="#"><i class="fa fa-twitter fa-2x"></i></a> <a href="#"><i class="fa fa-flickr fa-2x"></i></a> </p>
Copyright 2014 Cyrus Creative Studio. All rights reserved.
</div>
<!-- # finalizando pie de pagina -->
<a href="#home" class="gototop "><i class="fa fa-angle-up  fa-3x"></i></a>





<!-- La biblioteca de la Galería de imágenes Bootstrap, debe ser un elemento secundario del body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- iniciando el contenedor -->
    <div class="slides"></div>
    <!-- controlando las caracteristicas del contenedor -->
    <h3 class="title">Title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
<!-- modelo del dialogo, el cual tendra el contenedor -->     
</div>



<!-- recursos de jquery -->
<script src="assets/jquery.js"></script>

<!-- wow script -->
<script src="assets/wow/wow.min.js"></script>


<!-- haciendo uso de la biblioteca boostrap para el desarrollo de animaciones -->
<script src="assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>

<!-- animaciones de jquery mobile -->
<script src="assets/mobile/touchSwipe.min.js"></script>
<script src="assets/respond/respond.js"></script>

<!-- requiriendo recursos de gallery -->
<script src="assets/gallery/jquery.blueimp-gallery.min.js"></script>

<!-- recursos de script.js -->
<script src="assets/script.js"></script>

</body>
</html>