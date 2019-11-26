<?php
/* si la sesión esta abierta */
    session_start();
    $_SESSION = array();
    /* la sesión se cierra con esta función */
    session_destroy();
    header("location: index.php");                    
?>