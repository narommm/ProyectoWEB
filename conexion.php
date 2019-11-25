<?php
    $host = 'raja.db.elephantsql.com';
    $user = 'npyottjk';
    $pass = 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd';
    $dbname = 'npyottjk';
    try
    {
        $PDO = new PDO("pgsql:host=".$host."; "."dbname=".$dbname, $user, $pass);
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
        header('location: index.php');

    }
?>