<?php
    //Buscar dados para conexão
    require "dblogin.php";

    //Conectar
    $mysqli = new mysqli($serverAddr, $username, $pwd, $db);

    //Checar conexão
    if ($mysqli->connect_errno) {
        session_start();
        $_SESSION["ERROBANCO"] = mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')';
        
        header("Location: ../index.php?erro=ERROBANCO");
        exit();
    }

    //Forçar o Charset para UTF-8
    if (!$mysqli->set_charset("utf8")) {
        //printf("Error loading character set utf8: %s\n", $mysqli->error);
        $mysqli->error;
        exit();
    } else {
        //printf("Current character set: %s\n", $mysqli->character_set_name());
        $mysqli->character_set_name();
    }
?>