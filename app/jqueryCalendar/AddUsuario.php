<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: ../../index.php');
    exit();
}
?>
<?php        
        if(!empty($_POST)) {

        // validation errors
        $nameError = null;
        $lastNameError = null;
        $usernameError = null;
        $passwordError = null;
        $emailError = null;
        $tipoError = null;



        // post values
        require "input-filter/class.inputfilter.php";
        $filter = new InputFilter(array('b'), array ('src'));

        $name = $filter->process(trim($_POST['nombre']));
        $lastName =  $filter->process(trim($_POST['last_name']));
        $username = $filter->process(trim($_POST['username']));
        $password = $filter->process(trim($_POST['password']));
        //$password2 = $filter->process(trim($_POST['password2']));
        $email = $filter->process(trim($_POST['email']));
        $tipo = $filter->process(trim($_POST['tipo']));

        echo($name);
        echo($lastName);
        echo($username);
        echo($password);
        echo($email);
        echo($tipo);
        
        // validate input
        $valid = true;
        if(empty($name)) {
          echo("9");
            $nameError = "Por favor ingrese el nombre.";
            $valid = false;
        }
        
        if(empty($lastName)) {
          echo("8");

            $lastNameError = "Por favor ingrese su apellido.";
            $valid = false;
        }
        if(empty($username)) {
          echo("7");

          $usernameError = "Por favor ingrese el nombre de usuario.";
          $valid = false;
        }
      
        if(empty($password)) {
          echo("6");

          $passwordError = "Por favor ingrese su contraseña.";
          $valid = false;
        }
        /*if($password!=$password2) {
          $reserva_fechaError = "Las contraseñas deben coincidir.";
          $valid = false;
        }*/
        if(empty($email)) {
          echo("5");

        $emailError = "Por favor ingrese su direccion de correo electronico.";
        $valid = false;
      }      
        // insert data
        echo("1");
        
        $valid = false;
        
        if($valid) {
            require("../../conexion.php");
            echo("a");

            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo("b");

            $sql = "INSERT INTO usuario(name,lastName,username,password,email,tipo) values(?,?,?,?,?,?)";
            $stmt = $PDO->prepare($sql);
            echo("c");

            $stmt->execute(array($name, $lastName,$username, $password,$email,$tipo));
            echo("d");

            $PDO = null;
            echo("f");
            //header('location: AddUsuario.php');
        }
        echo("3");
    }
  require_once 'Zebra_Pagination-master/Zebra_Pagination.php';
  //concexion a la base para paginacion
  $conn = pg_connect("host=raja.db.elephantsql.com dbname=npyottjk user=npyottjk password=MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd");
  ///variables para paginacion
  $total = pg_query($conn, "SELECT count (*) FROM usario");
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
<h2 class="text-center  wowload fadeInUp">Registrar un Usuario</h2>
  <form class="row wowload fadeInLeftBig">      
      <div class="col-sm-8 col-sm-offset-2 col-xs-12">
        <label for="username">Ingrese Usuario:</label> 
        <input type="text" placeholder="Username" id="username" name="username" required>
        <label for="nombre">Ingrese Nombre:</label> 
        <input type="text" placeholder="Ej. Juan" id="nombre" name="nombre" required>
        <label for="last_name">Ingrese Apellidos:</label> 
        <input type="text" placeholder="Ej. Perez" id="last_name" name="last_name" required>
        <label for="password">Ingrese Contraseña:</label> 
        <input type="password" placeholder="*******" id="password" name="password" required>
        <label for="password2">Confirme Contraseña:</label> 
        <input type="password" placeholder="*******" id="password2" name="password2" required>
        <label for="email">Ingrese email:</label> 
        <input type="email" placeholder="ejemplo@ejemplo.com" id="email" name="email" required>
        <label for="tipo">Ingrese tipo:</label> 
        <div class="form-group">
        <select id="tipo" name="tipo">
          <option value="estudiante">Estudiante</option>
          <option value="docente">Profesor o docente</option>
          <option value="externo">Persona ajena a la institucion</option>
          <option value="administrador">Usuario Administrador</option>
        </select>
        </div>
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