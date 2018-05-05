<?php
session_start();

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

if(empty($_SESSION)){
  echo "<script>top.window.location = '".$_SESSION["installAddress"]."index.php?erro=ERROFATAL'</script>";
  die;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Sobre - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      <h1>ConsuCloud</h1>
      <p>Desenvolvido por OrangeMayhem Softworks</p>

      <br>

      <center>
        <a href="http://php.net/">
          <img src="assets/php.png" />
        </a>
        <a href="http://getbootstrap.com/">
          <img src="assets/bootstrap.png" />
        </a>
        <br>
        <a href="https://jquery.com/">
          <img src="assets/jquery.png" />
        </a>
        <a href="https://www.w3.org/standards/webdesign/htmlcss">
          <img src="assets/html5css3.png" />
        </a>
      </center>

      <br>
      <br>

      <b>Desenvolvimento:</b> Pedro Carneiro
      <br>
      <b>Banco de Dados:</b> Luan Gandhi
      <br>
      <b>Analistas de Sistemas:</b> Ivonaldo Torres, Marcela Oliveira
      <br>
      <b>Analista de Documentação:</b> José Jackson
      <br>
      <b>Analista de Testes:</b> Rodrigo Luna, Ramon Dantas
      <br>

      <br>
      <br> Copyright © 2018 - Todos os direitos reservados - Versão 20180110-1

    </div>
  </div>

</body>

</html>