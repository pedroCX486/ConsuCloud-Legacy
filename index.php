<?php
session_start();

require("componentes/sessionbuster.php");

$erro = $_GET['erro'];
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Login - ConsuCloud</title>

  <?php include "componentes/boot.php";?>

  <script>
    window.localStorage.clear();
  </script>
</head>

<body>
  <div class="borda">

    <div class="container">
      <div class="jumbotron">

        <noscript>
          <style type="text/css">
            #login {
              visibility: hidden;
            }
          </style>
          <div class="noscriptmsg">
            <div class="alert alert-danger" id="rcorners2" role="alert">
              <b>
                <h2>
                  <b>AVISO</b>
                </h2>
                <br> O seu navegador encontra-se com o JavaScript desativado ou não suporta JavaScript.
                <br>Recomendamos o uso com Google Chrome para melhor eficiência e desempenho, também com o JavaScript ativado.
                <br>
                <br>Por favor verifique também se você não está usando nenhuma extensão do tipo NoScript.
              </b>
            </div>
          </div>
        </noscript>

        <?php include "componentes/errorhandler.php"; ?>
        
        <center>
          <img src="assets/login.png" align="middle">
        </center>

        <br>
        <br>

        <div id="login">
          <form action="login.php" method="post">

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Usuário:</span>
              <input required type="text" class="form-control" name="login" aria-describedby="basic-addon1">
            </div>
            
            <br>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Senha:</span>
              <input required type="password" class="form-control" name="senha" aria-describedby="basic-addon1">
            </div>

            <br>

            <button type="submit" class="btn btn-raised btn-success pull-right">ENTRAR</button>
          </form>
        </div>

        <br>
        <br>

      </div>
    </div>

  </div>
</body>
  
<!--       _
       .__(.)< (AWW YISS!)
        \___)   
 ~~~~~~~~~~~~~~~~~~-->

</html>