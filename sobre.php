<?php

session_start();

if(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Sobre - ConsuCloud</title>

   <?php include "assets/bootstrap.php";?>
</head>

<body>

<?php include "barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      <h1>ConsuCloud</h1>
      <p>Desenvolvido por OrangeMayhem Softworks</p>

      <br>

      <center>
        <a href="http://php.net/"><img src="assets/php.png" /></a>
        <a href="http://getbootstrap.com/"><img src="assets/bootstrap.png" /></a>
        <br>
        <a href="https://jquery.com/"><img src="assets/jquery.png" /></a>
        <a href="https://www.w3.org/standards/webdesign/htmlcss"><img src="assets/html5css3.png" /></a>
      </center>

      <br><br>
      
      <b>Desenvolvimento:</b> Pedro Carneiro <br>
      <b>Banco de Dados:</b> Luan Gandhi <br>
      <b>Analista de Sistemas:</b> Marcela Oliveira <br>
      <b>Analista de Negócios:</b> Márcio Melo <br>
      <b>Analista de Documentação:</b> José Jackson <br>
      <b>Analista de Testes:</b> Rodrigo Luna <br>
      
      <br><br>
      
      Copyright © 2017 - Todos os direitos reservados.

    </div>
  </div>

</body>

</html>