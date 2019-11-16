<?php
    $host = 'localhost';
    $user = 'admin';
    $pass = 'root';
    $dbname = 'ProyectoWeb';
    try
    {
        $PDO = new PDO("mysql:host=".$host."; "."dbname=".$dbname, $user, $pass);
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
    }
?>