<?php
session_start();

if(!$_SESSION){
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
      <h1>ConsuCloud<br><small>Desenvolvido por OrangeMayhem Softworks</small></h1><br>

      <br>

      <center>
        <a href="http://php.net/"><img src="assets/php.png" /></a>
        <a href="http://getbootstrap.com/"><img src="assets/bootstrap.png" /></a>
      </center>

      <br>Copyright © 2017 - Todos os direitos reservados.

    </div>
  </div>

</body>

</html>