<?php
<<<<<<< HEAD

session_start();

if(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
=======
session_start();

require("componentes/sessionbuster.php");

if(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
>>>>>>> consucloud-2/master
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Sobre - ConsuCloud</title>

<<<<<<< HEAD
   <?php include "componentes/boot.php";?>
</head>

<body>

<?php include "componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      <h1>ConsuCloud</h1>
=======
  <?php include "componentes/boot.php";?>
</head>

<body>
  
  <?php include "componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      <h1>ConsuCloud 2.0</h1>
>>>>>>> consucloud-2/master
      <p>Desenvolvido por OrangeMayhem Softworks</p>

      <br>

      <center>
<<<<<<< HEAD
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
      <b>Analista de Sistemas:</b> Ivonaldo Torres <br>
      <b>Analista de Documentação:</b> José Jackson <br>
      <b>Analista de Testes:</b> Rodrigo Luna <br>
      
      <br><br>
      
      Copyright © 2017 - Todos os direitos reservados.
=======
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
      <br> Copyright © 2018 - Todos os direitos reservados - Versão 20180105
>>>>>>> consucloud-2/master

    </div>
  </div>

</body>

</html>