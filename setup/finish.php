<?php
include $_SESSION["installFolder"]."componentes/boot.php";
?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title>ConsuCloud</title>
  </head>

  <style>
    body {
      margin-top: 30px;
    }
  </style>

  <body>

    <div class="container">
      <div class="jumbotron">

        <p>
          <center><img src="<?php echo $_SESSION["installAddress"]; ?>assets/bigbrand.png" align="middle">
        </p>
        <br><br>
        <p>
          A configuração do ConsuCloud está concluída!<br><br>
          Seu sistema daqui em diante está pronto para ajudar seu consultório nas tarefas diárias. Lembre-se de apartir daqui fazer login como <b>SysAdmin</b>, adicionar uma <b>Secretária</b>, um <b>Médico</b> 
          e um <b>Plano de Saúde</b>, para assim poder adicionar <b>Pacientes</b>, marcar <b>Consultas</b> e realizar as muitas outras tarefas que o sistema ConsuCloud oferece ao seu consultório!
        </p>
        <br><br>

        <a class="btn btn-primary btn-raised btn-lg" href="<?php echo $_SESSION["installAddress"]; ?>index.php" role="button">Ir ao ConsuCloud >></a>

        </center>
      </div>
    </div>

  </body>

  </html>