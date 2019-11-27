<?php
/* requiriendo de recuersos de la conexión para presentar nueva vista */
require("conexion.php");
session_start();

if (isset($_SESSION['nombre'])) {
         header('location: index.php');
    exit();
    }
//Activamos todas las notificaciones de error posibles

error_reporting (E_ALL);

//Definimos el tratamiento de errores no controlados
set_error_handler(function (){
  throw new Exception("Error");
});

try{
  require("conexion.php");
  session_start();

  if (isset($_SESSION['usuario'])) {
          header('location: index.php');
      exit();
      }

}catch(Exception $e){
  echo("Error");
}
?>
<?php
if(!empty($_POST)) {
/* Creando variables de usuario y contaseña para utilizar en el inicio de sesión */
    $usuario = $_POST["usuario"];
    $password = md5($_POST["contra"]);
/* Estableciondo los codigos de error y generando un reporte de errores */
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /* consultando a la base de datos */
        $sql = "SELECT * FROM usuario WHERE username = ? AND password = ?";
        $stmt =$PDO->prepare($sql);
        /* procesando el usuario y contraseña para inicio de sesión */
        $stmt->execute(array($usuario, $password));
        /* devuelve un array indexado por los nombres de las columnas del resultado y lo guarda en data */
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(!empty($data)) {

            //Almacenamos credenciales para la session.

            $_SESSION['usuario'] = $data['username'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['lastname'] = $data['lastname'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['tipo'] = $data['tipo'];
              
            header('location: index.php');
          }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Reserva de Laboratorios</title>

<!-- requiriendo Google fonts para poder usar el directorio iteractivo que nos facilitara el uso de fuentes de la web-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

<!--inicializando el uso de frameworks de font awesome para el uso de iconos -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- usando la biblioteca bootstrap para el suo de plantilas, formularios, botones y cuadros de nuestra página-->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />

<!-- conectando animate.css para las animaciones y configuraciones de la página-->
<link rel="stylesheet" href="assets/animate/animate.css" />
<link rel="stylesheet" href="assets/animate/set.css" />

<!-- agregando gallery.min.css junto con totas las animaciones de imagenes y cuerpo de la página -->
<link rel="stylesheet" href="assets/gallery/blueimp-gallery.min.css">

<!-- requiriendo los iconos de favicon y las imagenes que seran de utilidad en nuestra web -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<!--conectando y utilizando los estilos de animación de css-->
<link rel="stylesheet" href="assets/style.css">

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
              <a class="navbar-brand" href="index.php"><img src="images/LOGO1.png" alt="logo"></a>
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
                 <li class="active"><a href="#home">Home</a></li>
                 <li ><a href="#about">About</a></li>
                 <li ><a href="app/jqueryCalendar/viewCalendar.php">Calendar</a></li>
                 <li ><a href="#contact">Contact</a></li>
                 <li><a href="login.php">Login</a></li>
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
<h2 class="text-center  wowload fadeInUp">Inicia Sesion</h2>
  <form class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12">      
        <input type="text" placeholder="usuario" id="usuario" name="usuario">
        <input type="password" placeholder="contraseña" id="contra" name="contra">
        <button class="btn btn-primary"><i class="fa fa-paper-plane" type="submit"></i> Sign In</button>
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





<!-- La biblioteca de la Galería de imágenes Bootstrap, debe ser un elemento secundario del body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- el contenedor  -->
    <div class="slides"></div>
    <!-- controlando las caracteristicas del contenedor -->
    <h3 class="title">Title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <!-- modelo del dialogo, el cual contendra el contenedor -->    
</div>



<!-- recursos de jquery -->
<script src="assets/jquery.js"></script>

<!-- wow script -->
<script src="assets/wow/wow.min.js"></script>


<!--inicializando el uso de frameworks de font awesome para el uso de iconos -->
<script src="assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>

<!--animaciones de jquery mobile -->
<script src="assets/mobile/touchSwipe.min.js"></script>
<script src="assets/respond/respond.js"></script>

<!-- agregando gallery.min.css junto con totas las animaciones de imagenes y cuerpo de la página -->
<script src="assets/gallery/jquery.blueimp-gallery.min.js"></script>

<!-- añadiendo script -->
<script src="assets/script.js"></script>

</body>
</html>