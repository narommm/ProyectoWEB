
<?php

//load.php


require("../../conexion.php");
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM reserva";
$stmt = $PDO->prepare($sql);
$stmt->execute(array($id));
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$PDO = null;
if(!empty($data)) {
   echo ("No encontre nada");
}



$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'numero_laboratorio'   => $row["numero_laboratorio"],
  'usuario_peticion'   => $row["usuario_peticion"],
  'motivo_peticion'   => $row["motivo_peticion"],
  'encargado'   => $row["encargado"],
  'estado_reserva'   => $row["estado_reserva"],
  'costo_reserva'   => $row["costo_reserva"],
  'reserva_inicio'   => $row["reserva_inicio"],
  'reserva_fin'   => $row["reserva_fin"],
  'hora_resolucion_reserva'   => $row["hora_resolucion_reserva"]
 );
}

echo json_encode($data);

?>
