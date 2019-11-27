<?php
/* implementando caractetistica de la base datos tales como link, usuario, contraseña, y nombre de la base*/
    $host = 'raja.db.elephantsql.com';
    $user = 'npyottjk';
    $pass = 'MOplwc_adGR6KKJ9NCQ5vZ8QRBN960Wd';
    $dbname = 'npyottjk';
    try
    {
        /* instanciando el arranque de la base con pgadmin y enviando parametros de inicialización */
        $PDO = new PDO("pgsql:host=".$host."; "."dbname=".$dbname, $user, $pass);
    }
    catch(PDOException $e)
    {
        /* si ocurre un error al conectar, se envia un mensaje de error */
        die($e->getMessage());
        header('location: index.php');

    }
?>