
<?php

//mostrando registros de la base de datos
$host = 'raja.db.elephantsql.com';
$user = 'npyottjk';
$pass = 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd';
$dbname = 'npyottjk';
$connect = new PDO('pgsql:host=raja.db.elephantsql.com;dbname=npyottjk', 'npyottjk', 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd');

$data = array();

$query = "SELECT * FROM reserva WHERE estado_reserva='aceptado' ORDER BY id ";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
/* para cada registro se hace un proceso de muestra */
foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'numero_laboratorio'   => $row["numero_laboratorio"],
  'usuario_peticion'   => $row["usuario_peticion"],
  'usuario_resolucion'   => $row["usuario_resolucion"],
  'motivo_peticion'   => $row["motivo_peticion"],
  'hora_peticion'   => $row["hora_peticion"],
  'start'  => $row["reserva_inicio"],
  'end'  => $row["reserva_fin"],
  'usuario_peticion'   => $row["usuario_peticion"]
  
 );
}

echo json_encode($data);

?>
