<?php
header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set('America/Recife');
require($_SERVER['DOCUMENT_ROOT']."/componentes/db/connect.php");

if($_GET['logs']){
  $query = $mysqli->query("DELETE FROM logs WHERE dataLog < ( CURDATE() - INTERVAL 365 DAY )");
  if($query){
      echo '<script type="text/javascript">
          alert("Limpeza executada com sucesso.");
          location.href="'.$_SESSION["installAddress"].'dashboards/dashboard.php";
      </script>';
  }
}