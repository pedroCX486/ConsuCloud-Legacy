<?php
require("../assets/connect.php");

session_start();

if($_SESSION["isSecretaria"] == true || $_SESSION["isMedico"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title>Usuários - ConsuCloud</title>

   <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

    <div class="container">
      <div class="jumbotron">

        <h1>Tipo de Usuário</h1>

        <p>Selecione o tipo de usuário a ser cadastrado:</p>
        <br><br>

        <center>
          <table>
            <tr><a href="cadastrarmedico.php"><button style="font-size: 24px;" type="button" class="btn btn-raised btn-success btn-lg">Médico</button></a></tr>
            <tr><a href="cadastrarsecretaria.php"><button style="font-size: 24px;" type="button" class="btn btn-raised btn-info btn-lg">Secretária</button></a></tr>
          </table>
        </center>

      </div>
    </div>

  </body>

  </html>
