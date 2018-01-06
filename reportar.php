<?php
session_start();

<<<<<<< HEAD
if(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
=======
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
  <title>Reportar um Erro - ConsuCloud</title>

<<<<<<< HEAD
   <?php include "componentes/boot.php";?>
</head>

<body>

<?php include "componentes/barra.php"; ?>
=======
  <?php include "componentes/boot.php";?>
</head>

<body>
  
  <?php include "componentes/barra.php"; ?>
>>>>>>> consucloud-2/master

  <div class="container">
    <div class="jumbotron">
      <h1>Reportar um Erro</h1>
      <p>Ajude-nos a fazer um sistema melhor!</p>
<<<<<<< HEAD
      
      <br>

          <blockquote>
            Envie um email para <b><a href="mailto:pedrocarneiromneto@gmail.com">pedrocarneiromneto@gmail.com</a></b> com o assunto <b>"ConsuCloud: Reportando um Erro"</b> e no corpo do email 
            descreva detalhadamente (e se possível inclua screenshots/fotos do problema) para que possamos trabalhar numa correção o mais rápido o possível.
          </blockquote>
=======

      <br>

      <blockquote>
        Envie um email para
        <b>
          <a href="mailto:pedrocarneiromneto@gmail.com">pedrocarneiromneto@gmail.com</a>
        </b> com o assunto
        <b>"ConsuCloud: Reportando um Erro"</b> e no corpo do email descreva detalhadamente (e se possível inclua screenshots/fotos
        do problema) para que possamos trabalhar numa correção o mais rápido o possível.
      </blockquote>
>>>>>>> consucloud-2/master

    </div>
  </div>

</body>

<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> consucloud-2/master
