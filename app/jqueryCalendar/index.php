
<!DOCTYPE html>
<html>
 <head>
  <title>CALENDAR</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
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
  <br />
  <h2 align ="center"><a href="#">Reserva tu laboratorio</a></h2>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>
 </body>
</html>
