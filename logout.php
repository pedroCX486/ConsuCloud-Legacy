<?php
    //Carregar session
    session_start();

    //Remover todas as variaveis da session
    session_unset(); 

    //Destruir session
    session_destroy(); 

    //Redirecionar o Browser
    header("Location: index.php");
    exit();
?>