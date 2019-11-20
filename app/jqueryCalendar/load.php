
<?php

//load.php
$host = 'raja.db.elephantsql.com';
$user = 'npyottjk';
$pass = 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd';
$dbname = 'npyottjk';
$connect = new PDO('pgsql:host=raja.db.elephantsql.com;dbname=npyottjk', 'npyottjk', 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd');

$data = array();

$query = "SELECT * FROM reserva ORDER BY numero_laboratorio";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>
