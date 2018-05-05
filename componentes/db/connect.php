<?php
//Buscar dados para conexão
require "dblogin.php";

//Conectar
$mysqli = new mysqli($serverAddr, $username, $pwd, $db);

//Checar conexão
if($mysqli->connect_errno){
  session_start();
  $_SESSION["ERROBANCO"] = mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')';

  echo "<script>top.window.location = ".$_SESSION["installAddress"]."index.php?erro=ERROBANCO'</script>";
  die;
}

//Configurar timezone GMT-3 no DB
$mysqli->query("SET GLOBAL time_zone = '-3:00';");
$mysqli->query("SET time_zone = '-03:00';");

//Forçar o charset para UTF-8
if(!$mysqli->set_charset("utf8")){
  printf("Erro fatal ao configurar banco com charset UTF-8: %s\n", $mysqli->error);
  exit();
}
?>