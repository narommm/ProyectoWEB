<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: viewCalendar.php');
    exit();
}else{
    if($_SESSION['tipo']!="administrador"){
      header('location: calendar.php');
      exit();
    }
}
?>
<?php
    $id = null;
    if(!empty($_GET['id'])) {
        $id = $_GET['id'];
    }
    if($id == null) {
        header("Location: ../../index.php");
    }
    
    require("../../conexion.php");
    if(!empty($_POST)) {
    	  

        // validation errors

        $encargadoError = null;

        $numero_laboratorio = null;
        $reserva_inicio = null;
        $reserva_fin = null;
        $reserva_fecha = null;
        $descripcion = null;
        $usuario_peticion = null;

        $time = time();
        
        $usuario_resolucion = null;
        $hora_peticion = null;
        $encargado = null;
        $estado_reserva = null;
        $costo_laboratorio = null;

        // post values
        require "input-filter/class.inputfilter.php";
        $filter = new InputFilter(array('b'), array ('src'));

        $time = time();
        $hora_resolucion = date("Y-m-d : H:i:s", $time);
        $usuario_resolucion = $_SESSION['usuario'];
        $encargado = $filter->process(trim($_POST['encargado']));
        $estado_reserva = $filter->process(trim($_POST['tipo']));

        // validate input
        $valid = true;
        if(empty($encargado)) {
            $encargadoError = "Por favor ingrese el numero del laboratorio.";
            $valid = false;
        }
        

        // update data
        
        if($valid) {
        	
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE reserva SET usuario_resolucion = ?, estado_reserva = ?, hora_resolucion_reserva = ? WHERE id = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($usuario_resolucion, $estado_reserva, $hora_resolucion, $id));
            $PDO = null;
            header("Location: UpdatePeticion.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT id, numero_laboratorio,usuario_peticion, motivo_peticion, hora_peticion,reserva_inicio,reserva_fin,costo_reserva,estado_reserva FROM reserva WHERE id = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: ../../index.php");
        }
        $id = $data['id'];        
        $numero_laboratorio = $data['numero_laboratorio'];
        $usuario_peticion  = $data['usuario_peticion'];
        $motivo_peticion = $data['motivo_peticion'];
        $hora_peticion = $data['hora_peticion'];        
        $reserva_inicio = $data['reserva_inicio'];
        $reserva_fin=$data['reserva_fin'];
        $costo_laboratorio = $data['costo_reserva'];        
    }
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
                          <li ><a href="UpdatePeticion.php">Peticion</a></li>
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
<!--Login Starts-->

<form class="container contactform center" role="form" method ='POST'>
<h2 class="text-center  wowload fadeInUp">Reserva un laboratorio</h2>
  <form class="row wowload fadeInLeftBig">      
      <div class="col-sm-3 col-sm-offset-2 col-xs-12">
        <input type="text" placeholder="# Laboratorio" name="laboratorio" required value='<?php print($numero_laboratorio); ?>' disabled>
        <input type="text" placeholder="<?php echo $_SESSION['usuario'];?>" id="usuario" name="usuario" value='<?php print($usuario_peticion); ?>' disabled>
      </div>
      <div class="col-sm-8 col-sm-offset-2 col-xs-12">
        <h3>Formato 24 horas</h3>
        <label for="appt">Inicio de la reserva:</label> 
        <input type="text" id="appt_inicio" name="appt_inicio" required value='<?php print($reserva_inicio); ?>' disabled >
        <label for="appt">Final de la reserva:</label>
        <input type="text" id="appt_final" name="appt_final" required value='<?php print($reserva_fin); ?>' disabled > 
      </div>
      <div class="col-sm-8 col-sm-offset-2 col-xs-12">             
        <textarea name="peticion" id="peticion"rows="8" placeholder="Peticion" required value='<?php print($motivo_peticion); ?>' disabled></textarea>
      </div>
      <div class="col-sm-8 col-sm-offset-2 col-xs-12">
        <input type="text" placeholder="Encargado" id="encargado" name="encargado" required>
        <label for="tipo">Estado</label>
        <select id="tipo" name="tipo">
          <option value="aceptado">Aceptado</option>
          <option value="denegado">Denegado</option>
        </select>
        <button class="btn btn-primary"><i class="fa fa-paper-plane" type="submit"></i>Enviar</button>
      </div>
  </form>
</form>
</div>
<!--Login Ends-->

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