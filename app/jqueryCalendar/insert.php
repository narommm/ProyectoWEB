<?php

//conexion a la base de datos
$host = 'raja.db.elephantsql.com';
$user = 'npyottjk';
$pass = 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd';
$dbname = 'npyottjk';
$connect = new PDO('pgsql:host=raja.db.elephantsql.com;dbname=npyottjk', 'npyottjk', 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd');
/*  verificando el numero de laboratorio para hacer la reserva */
if(isset($_POST["numero_laboratorio"]))
{
 $query = "
 INSERT INTO reserva
 (numero_laboratorio, usuario_peticion, usuario_resolucion, motivo_peticion, hora_peticion, reserva_inicio,reserva_fin) 
 VALUES (:numero_laboratorio, :usuario_peticion,:usuario_resolucion, :motivo_peticion, :hora_peticion, :reserva_inicio, :reserva_fin)
 ";
 /* guardando en variables los datos de registro */
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
    ':numero_laboratorio'   => $_POST["numeroLabo"],
    ':usuario_peticion'   =>  $_POST["usuarioPeticion"],
    ':usuario_resolucion'   =>  $_POST["usuarioResolucion"],
    ':motivo_peticion'   =>  $_POST["motivoPeticion"],
    ':hora_peticion'   =>  $_POST["horaPeticion"],
    ':reserva_inicio'  =>  $_POST["start"],
    ':reserva_fin'  =>  $_POST["end"]
  )
 );
}


?>