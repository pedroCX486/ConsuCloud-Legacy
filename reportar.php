<?php
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
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Reportar um Erro - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>

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