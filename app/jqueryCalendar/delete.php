<?php

//eliminar registro en base de datos

if(isset($_POST["id"]))
{
 $connect = new PDO("pgsql:host=".$host."; "."dbname=".$dbname, $user, $pass);
 $query = "
 DELETE from reserva WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>
