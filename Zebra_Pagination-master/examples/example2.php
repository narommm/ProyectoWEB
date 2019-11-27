<!doctype html>

<html>

    <head>

        <title>Zebra_Pagination, database example</title>

        <meta charset="utf-8">
<!-- requiriendo recursos de reset.css -->
        <link rel="stylesheet" href="reset.css" type="text/css">
<!-- requiriendo recursos de style.css -->
        <link rel="stylesheet" href="style.css" type="text/css">
<!-- requiriendo recursos de zebra_pagination.css -->
        <link rel="stylesheet" href="../public/css/zebra_pagination.css" type="text/css">

    </head>

    <body>

        <h2>Zebra_Pagination, database example</h2>

        <p>For this example, you need to first import the <strong>countries.sql</strong> file from the examples folder
        and to edit the <strong>example2.php file and change your database connection related settings.</strong></p>
        
        <p>Show next/previous page links on the <a href="example2.php?navigation_position=left">left</a> or on the
        <a href="example2.php?navigation_position=right">right</a>. Or revert to the <a href="example2.php">default style</a></p>

        <?php

        // detalles de la conexion de la base de datos
        $MySQL_host     = '';
        $MySQL_username = '';
        $MySQL_password = '';
        $MySQL_database = '';

        // si no se puede conectar con la base datos
        if (!($connection = @mysql_connect($MySQL_host, $MySQL_username, $MySQL_password)))

            // se para la ejecucion y se despliega un mensage de error
            die('Error connecting to the database!<br>Make sure you have specified correct values for host, username and password.');

        // si la base datos no ha sido seleccionada
        if (!@mysql_select_db($MySQL_database, $connection))

            // se para la ejecucion y se despliega un mensage de error
            die('Error selecting database!<br>Make sure you have specified an existing and accessible database.');

        // cuantos records desea mostrar en la pagina
        $records_per_page = 10;

        //incluyendo la clase de paginacion
        require '../Zebra_Pagination.php';

        // instanciando objeto de paginacion
        $pagination = new Zebra_Pagination();

        // asignando la siguienteb posicion de los links
        $pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');

        // the MySQL statement to fetch the rows
        // note how we build the LIMIT
        // also, note the "SQL_CALC_FOUND_ROWS"
        // this is to get the number of rows that would've been returned if there was no LIMIT
        // see http://dev.mysql.com/doc/refman/5.0/en/information-functions.html#function_found-rows
        $MySQL = '
            SELECT
                SQL_CALC_FOUND_ROWS
                country
            FROM
                countries
            ORDER BY
                country
            LIMIT
                ' . (($pagination->get_page() - 1) * $records_per_page) . ', ' . $records_per_page . '
        ';


        // si la consuklta no se puede ejecutar
        if (!($result = @mysql_query($MySQL)))

            // se para la ejecusion y se despliega un mensaje de error
            die(mysql_error());

        //buscar el numero total de registros de una tabla
        $rows = mysql_fetch_assoc(mysql_query('SELECT FOUND_ROWS() AS rows'));

        // pasar el número total de registros a la clase de paginación
        $pagination->records($rows['rows']);

        // registros por pagina
        $pagination->records_per_page($records_per_page);

        ?>

        <table class="countries" border="1">

        	<tr><th>Country</th></tr>

            <?php $index = 0?>

            <?php while ($row = mysql_fetch_assoc($result)):?>

            <tr<?php echo $index++ % 2 ? ' class="even"' : ''?>>
                <td><?php echo $row['country']?></td>
            </tr>

            <?php endwhile?>

        </table>

        <?php

        // renderizar los enlaces de paginación
        $pagination->render();

        ?>

        <script type="text/javascript" src="jquery-1.7.2.js"></script>
        <script type="text/javascript" src="../public/javascript/zebra_pagination.js"></script>

    </body>

</html>
