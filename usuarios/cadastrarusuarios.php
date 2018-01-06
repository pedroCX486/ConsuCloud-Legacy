<?php
session_start();

require("../componentes/sessionbuster.php");

if(!$_SESSION["isAdmin"]){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
 }if(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}

require("../componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Usuários - ConsuCloud</title>

  <?php include "../componentes/boot.php";?>
</head>

<body>
  
  <?php include "../componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Tipo de Usuário</h1>

      <p>Selecione o tipo de usuário a ser cadastrado:</p>
      <br>
      <br>

      <center>
        <table>
          <tr>
            <a class="anchor" href="cadastrarmedico.php">
              <button style="font-size: 24px; height: 80px; width: 200px;" type="button" class="btn btn-raised btn-success btn-lg">Médico</button>
            </a>
          </tr>
          <tr>
            <a class="anchor" href="cadastrarsecretaria.php">
              <button style="font-size: 24px; height: 80px; width: 200px;" type="button" class="btn btn-raised btn-info btn-lg">Secretária</button>
            </a>
          </tr>
        </table>
      </center>

    </div>
  </div>

</body>

</html>