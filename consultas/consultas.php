<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Consultas - ConsuCloud</title>

  <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

    <div class="container">
      <div class="jumbotron">

        <h1>Consultas</h1>

        <a href="cadastrarconsultas.php"><button class="btn btn-raised btn-success pull-right">CADASTRAR NOVA CONSULTA</button></a>

        <p>Consultas cadastradas:</p>

        <br><br>

        <center>
          <table id="rcorners1" class="tg">
            <tr>
              <th class="titulos">PACIENTE</th>
              <th class="titulos">TIPO</th>
              <th class="titulos">MÉDICO</th>
              <th class="titulos">DATA - HORA</th>
            </tr>
              <tr>
                </td>

                 <!--Paciente -->
                <td class="tg-yw4l">
                  Fulano de Tal &nbsp;
                </td>

                <!--Tipo de Consulta -->
                <td class="tg-yw4l">
                  Primeira Consulta &nbsp;
                </td>

                <!--Nome do Medico-->
                <td class="tg-yw4l">
                  Médico Fulano &nbsp;
                </td>

                <!--Data da Consulta-->
                <td class="tg-yw4l">
                  07/07/2017
                </td>

                <!--Editar/Remover Consultas-->
                <td class="tg-yw4l">
                  <a href="consultas.php?editar=" title="Editar Consulta"><span class="glyphicon glyphicon-pencil" aria-hidden="true" /></a> &nbsp;
                  <a href="consultas.php?remover=&confirmaRemover=0" title="Remover Consulta"><span class="glyphicon glyphicon-trash" aria-hidden="true" /></a>
                </td>
              </tr>
          </table>
        </center>

      </div>
    </div>

  </body>

  </html>
