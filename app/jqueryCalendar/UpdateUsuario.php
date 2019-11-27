<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: ../../index.php');
    exit();
}else{
    if($_SESSION['tipo']!="administrador"){
      header('location: ../../index.php');
      exit();
    }
}
?>
<?php
    $id = null;
    if(!empty($_GET['username'])) {
        $id = $_GET['username'];
    }
    if($id == null) {
        header("Location: ../../index.php");
    }
    
    require("../../conexion.php");
    if(!empty($_POST)) {
    	  

        // validation errors

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
        $email = $filter->process(trim($_POST['email']));
        $tipo = $filter->process(trim($_POST['tipo']));
        
        $username =  null;
        $password = null;

        $valid = true;
        
        if(empty($name)) {
            $nameError = "Por favor ingrese el nombre.";
            $valid = false;
        }        
        if(empty($lastName)) {
            $lastNameError = "Por favor ingrese su apellido.";
            $valid = false;
        }
        if(empty($email)) {
          $emailError = "Por favor ingrese su direccion de correo electronico.";
          $valid = false;
      }      
        
        // update data
        
        if($valid) {
        	
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE usuario SET name = ?, lastname = ?,email = ? ,tipo = ? WHERE username = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($name, $lastName, $email,$tipo, $id));
            $PDO = null;
            header("Location: AddUsuario.php");
        }
    }
    else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT name, lastname,username,password, email, tipo FROM usuario WHERE username = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if(empty($data)) {
            header("Location: ../../index.php");
        }      
        $name = $data['name'];
        $lastName  = $data['lastname'];
        $username = $data['username'];
        $password  = $data['password']; 
        $email = $data['email'];
        $tipo = $data['tipo'];               
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
<!--Login Starts-->

<form class="container contactform center" role="form" method ='POST'>
<h2 class="text-center  wowload fadeInUp">Registrar un Usuario</h2>
  <form class="row wowload fadeInLeftBig">      
      <div class="col-sm-8 col-sm-offset-2 col-xs-12">
        <label for="username">Ingrese Usuario:</label> 
        <input type="text" placeholder="Username" id="username" name="username" required  value='<?php print($username); ?>' disabled>
        <label for="nombre">Ingrese Nombre:</label> 
        <input type="text" placeholder="Ej. Juan" id="nombre" name="nombre" required value='<?php print($name); ?>'>
        <label for="last_name">Ingrese Apellidos:</label> 
        <input type="text" placeholder="Ej. Perez" id="last_name" name="last_name" required value='<?php print($lastName); ?>'>
        <label for="password">Ingrese Contraseña:</label> 
        <input type="password" placeholder="*******" id="password" name="password" required value='<?php print($password); ?>' disabled>
        <label for="password2">Confirme Contraseña:</label> 
        <input type="password" placeholder="*******" id="password2" name="password2" required value='<?php print($password); ?>' disabled>
        <label for="email">Ingrese email:</label> 
        <input type="email" placeholder="ejemplo@ejemplo.com" id="email" name="email" required value='<?php print($email); ?>' >
        <label for="tipo">Ingrese tipo:</label> 
        <div class="form-group">
        <select id="tipo" name="tipo">value='<?php print($tipo); ?>'
        <option value='<?php print($tipo); ?>'><?php print($tipo); ?></option>
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