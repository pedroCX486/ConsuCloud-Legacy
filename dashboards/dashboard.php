<?php
date_default_timezone_set('America/Recife');

session_start();

if(empty($_SESSION["idUsuario"])){
  if (file_exists('../index.php')){
    include("../componentes/installdir.php");
  }elseif(file_exists('../../index.php')){
    include("../../componentes/installdir.php");
  }elseif(file_exists('../../../index.php')){
    include("../../../componentes/installdir.php");
  }
  
  if(empty($installDir)){
      $installDir = "/";
      $installAddr = "https://".$_SERVER['HTTP_HOST'].$installDir;
    }else{
      $installAddr = "https://".$_SERVER['HTTP_HOST'].$installDir;
    }
  
  echo "<script>top.window.location = '".$installAddr."index.php?erro=ERROFATAL'</script>";
  die();
}

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

$idUsuario = $_SESSION["idUsuario"];

require($_SESSION["installFolder"]."componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Painel - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/tooltip.js"></script>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/windowReload.js"></script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>
      <?php
        if(date('H') >= "05" && date('H') < "13"){ //Se mais ou igual a 5AM e menos que 13PM
          echo "Bom dia, ";
        }elseif(date('H') >= "13" && date('H') < "18"){ //Se mais ou igual a 13PM e menos que 18PM
          echo "Boa tarde, ";
        }elseif(date('H') >= "18" || date('H') < "5"){ //Se mais ou igual a 18PM e menos que 5AM
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
        if($_SESSION["isAdmin"] == true){
          require "dashboard_default.php";
        }elseif($_SESSION["isSecretaria"] == true){
          require "dashboard_secretaria.php";
        }elseif($_SESSION["isMedico"] == true){
          require "dashboard_medico.php";
        }else{
          if (file_exists('../index.php')){
            include("../componentes/installdir.php");
          }elseif(file_exists('../../index.php')){
            include("../../componentes/installdir.php");
          }elseif(file_exists('../../../index.php')){
            include("../../../componentes/installdir.php");
          }
          
          if(empty($installDir)){
              $installDir = "/";
              $installAddr = "https://".$_SERVER['HTTP_HOST'].$installDir;
            }else{
              $installAddr = "https://".$_SERVER['HTTP_HOST'].$installDir;
            }
          
          echo "<script>top.window.location = '".$installAddr."index.php?erro=ERROFATAL'</script>";
          die();
        }
      ?>

    </div>
  </div>

</body>

</html>