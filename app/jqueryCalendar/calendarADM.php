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
<link rel="shortcut icon" href="../../images/favicon.jpg" type="image/x-icon">
<link rel="icon" href="../../images/favicon.ico" type="image/x-icon">


<link rel="stylesheet" href="../../assets/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
    
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,

    //select: function(numeroLabo, usuarioPeticion, motivoPeticion,start, end, allDay)
    
    /*select: function(start, end, allDay)
    {
     var numeroLabo = prompt("Agrega numero labo");
     var usuarioPeticion = prompt("Agrega una usuario");
     var usuarioResolucion = "alexis";
     var motivoPeticion = prompt("Agrega el motivo");
     //var inicio = prompt("Agrega inicio");
     //var fin = prompt("Agrega fin");
     var horaPeticion = prompt("Agrega una hora");
     if(numeroLabo)
     {  
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{numero_laboratorio:numeroLabo,usuario_peticion:usuarioPeticion,usuario_resolucion:usuarioResolucion,motivo_peticion:motivoPeticion, reserva_inicio:start, reserva_fin:end,hora_peticion:horaPeticion},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },*/
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var id = event.id;
     var numeroLabo = event.numero_laboratorio;
     var usuarioPeticion =  event.usuario_peticion;
     var usuarioResolucion =  event.usuario_resolucion;
     var motivoPeticion =  event.motivo_peticion;
     var horaPeticion =  event.hora_peticion;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{numero_laboratorio:numeroLabo,usuario_peticion:usuarioPeticion,usuario_resolucion:usuarioResolucion,motivo_peticion:motivoPeticion, reserva_inicio:start, reserva_fin:end,hora_peticion:horaPeticion,id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    var id = event.id;
    var numeroLabo = event.numero_laboratorio;
    var usuarioPeticion =  event.usuario_peticion;
    var usuarioResolucion =  event.usuario_resolucion;
    var motivoPeticion =  event.motivo_peticion;
    var horaPeticion =  event.hora_peticion;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{numero_laboratorio:numeroLabo,usuario_peticion:usuarioPeticion,usuario_resolucion:usuarioResolucion,motivo_peticion:motivoPeticion, reserva_inicio:start, reserva_fin:end,hora_peticion:horaPeticion,id:id},
        success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Seguro que deseas eliminiar la reserva?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  }); 
   
  </script>
</head>
<body>
<div class="topbar animated fadeInLeftBig"></div>

<!-- Header Starts -->
<div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
          <div class="container">
            <div class="navbar-header">
              <!-- Logo Starts -->
              <a class="navbar-brand" href="#home"><img src="images/LOGO1.png" alt="logo"></a>
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
                 <li ><a href="app/jqueryCalendar/calendar.php">Calendar</a></li>
                 <li ><a href="#contact">Contact</a></li>
                 <li><a href="salir.php">Salir</a></li>
              </ul>
            </div>
            <!-- #Nav Ends -->

          </div>
        </div>

      </div>
    </div>
<!-- #Header Starts -->
<div>
<br />
  <h2 align ="center"><a href="#">Reserva tu laboratorio</a></h2>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>
</div>
<!-- Cirlce Starts -->
<div id="about"  class="container spacer about">
<h2 class="text-center wowload fadeInUp">Sistema de reserva de laboratorios.</h2>  
  <div class="row">
  <div class="col-sm-6 wowload fadeInLeft">
    <h4><i class="fa fa-flag"></i> Introducción</h4>
    <p>Bienvenido al sistema de reservas de la universidad José Simeón Cañas (UCA) en el cual podrá solicitar el uso de nuestras instalaciones. Contamos con # laboratorios a su disposición cuyos horarios hábiles son de lunes a  viernes desde las 7:00 am hasta las 7:00 pm. Además de días sábados de 7:00 am a 3:00 pm.</p>
  </div>
  <div class="col-sm-6 wowload fadeInRight">
  <h4><i class="fa fa-fire"></i></i> Importante.</h4>
  <p>La Universidad José Simeón Cañas se reserva los derechos de admisión de agentes externos a nuestro sistema, por lo que estos deberán contactar a nuestro administrador de servicios solicitándole credenciales de uso del sistema.</p>    
  </div>
  </div>
  <div class="services">
    <h3 class="text-center wowload fadeInUp">Servicios</h3>
    <ul class="row text-center list-inline  wowload bounceInUp">
        <li>
              <span><i class="fa fa-desktop"></i><b><a href="app/jqueryCalendar/index.php">Reservas</a></b></span>
          </li>
          <li>
              <span><i class="fa fa-cube"></i><b></b>dfjfhalda</span>
          </li>
          <li>
              <span><i class="fa fa-graduation-cap"></i><b>Trainings</b></span>
          </li>
      </ul>
    </div>
</div>
</div>
</div>
</div>

<br>
<br>

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
<?php
  include '../../app/inc/footer.php';
?>
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