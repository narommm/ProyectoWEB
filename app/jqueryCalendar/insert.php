<?php

//insert.php

$connect = new PDO('pgsql:host=raja.db.elephantsql.com;dbname=npyottjk', 'npyottjk', 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd');

if(isset($_POST["numeroLabo"]))
{
 $query = "
 INSERT INTO reserva
 (numero_laboratorio, usuario_peticion, motivo_peticion, hora_peticion, reserva_inicio,reserva_fin) 
 VALUES (:numeroLabo, :usuario_peticion, :motivo_peticion, :hora_peticion, :reserva_inicio, :reserva_fin)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':numero_laboratorio'  => $_POST['numeroLabo'],
   ':usuario_peticion' => $_POST['usuarioPeticion'],
   ':motivo_peticion' => $_POST['motivoPeticion'],
   ':hora_peticion' => $_POST['horaPeticion'],
   ':reserva_inicio' => $_POST['start'],
   ':reserva_fin' => $_POST['end']
  )
 );
}


?>