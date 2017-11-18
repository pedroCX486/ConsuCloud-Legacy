<?php
session_start();

require("../componentes/sessionbuster.php");

if(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Reportar um Erro - ConsuCloud</title>

  <?php include "componentes/boot.php";?>
</head>

<body>

  <div class="container">
    <div class="jumbotron">
      <h1>Reportar um Erro</h1>
      <p>Ajude-nos a fazer um sistema melhor!</p>

      <br>

      <blockquote>
        Envie um email para
        <b>
          <a href="mailto:pedrocarneiromneto@gmail.com">pedrocarneiromneto@gmail.com</a>
        </b> com o assunto
        <b>"ConsuCloud: Reportando um Erro"</b> e no corpo do email descreva detalhadamente (e se possível inclua screenshots/fotos
        do problema) para que possamos trabalhar numa correção o mais rápido o possível.
      </blockquote>

    </div>
  </div>

</body>

</html>