<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Pacientes - ConsuCloud</title>
  
  <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

    <div class="container">
      <div class="jumbotron">

        <h1>Pacientes</h1>

        <a href="cadastrarpacientes.php"><button class="btn btn-raised btn-success pull-right">CADASTRAR NOVO PACIENTE</button></a>

        <p>Pacientes cadastrados:</p>

        <br><br>

        <center>
          <table id="rcorners1" class="tg">
            <tr>
              <b>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">RG</th>
            <th class="titulos">NASCIMENTO</th>
            <th class="titulos">EMAIL</th>
            </b>
            </tr>
          </table>
        </center>

      </div>
    </div>

  </body>

  </html>