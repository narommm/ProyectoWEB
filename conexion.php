<?php
    $host = 'raja.db.elephantsql.com';
    $user = 'npyottjk';
    $pass = 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd';
    $dbname = 'npyottjk';
    try
    {
        $PDO = new PDO("pgsql:host=".$host."; "."dbname=".$dbname, $user, $pass);
        echo "Conectado";
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
    }
?>