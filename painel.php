<?php
require("assets/connect.php");

date_default_timezone_set('America/Recife');

session_start();
$crm = $_SESSION["CRM"];

if(!$_SESSION){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}elseif(empty($_SESSION)){
  header("Location: ../logout.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Painel - ConsuCloud</title>

   <?php include "assets/bootstrap.php";?>
</head>

<body>

  <?php include "barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>
        <?php
          if(date('H') >= "5" && date('H') < "13"){
            echo "Bom dia, ";
          }elseif(date('H') >= "13" && date('H') < "18"){
            echo "Boa tarde, ";
          }elseif(date('H') >= "18"){
            echo "Boa noite, ";
          }
          echo $_SESSION["username"] . "!" . "<br></h1>";

          if($_SESSION["isSecretaria"] == true){
            echo '<p>Todas as consultas agendadas para hoje:</p>';
          }elseif($_SESSION["isMedico"] == true){
            echo '<p>Todas as suas consultas agendadas para hoje:</p>';
          }
        ?>

      <br>

      <?php
        if($_SESSION["isAdmin"] == true || $_SESSION["isDebug"] == true){
          require "paineis/painel_default.php";
        }elseif($_SESSION["isSecretaria"] == true){
          require "paineis/painel_secretaria.php";
        }elseif($_SESSION["isMedico"] == true){
          require "paineis/painel_medico.php";
        }else{
          header("Location: ../index.php?erro=ERROFATAL");
        }
      ?>

    </div>
  </div>

</body>

</html>
