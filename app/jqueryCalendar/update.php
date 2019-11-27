<?php

//funcion de actualizar en la base de datos

$connect = new PDO("pgsql:host=".$host."; "."dbname=".$dbname, $user, $pass);

/* recibiendo un id para modificar los datos de ese registro */
if(isset($_POST["id"]))
{
 $query = "
 UPDATE reserva 
 SET title=:title, start_event=:start_event, end_event=:end_event 
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>
