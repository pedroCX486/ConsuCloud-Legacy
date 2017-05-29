<?php
require("../assets/connect.php");

session_start();

if($_SESSION["isMedico"] == true || !$_SESSION){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../logout.php");
    exit();
}
?>

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
            <?php
              $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, idConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta >= CURDATE() ORDER BY dataConsulta ASC, horaConsulta ASC");
              $row = $select->num_rows;
              if($row){
                while($get = $select->fetch_array()){
            ?>
              <tr>
                <!--Nome do Paciente-->
                <td class="tg-yw4l">
                  <?php echo $get['nomePaciente']; ?>
                </td>

                <!--Tipo de Consulta -->
                <td class="tg-yw4l">
                  <?php if($get['tipoConsulta'] == "retorno"){echo "Retorno";}elseif($get['tipoConsulta'] == "primeiraConsulta"){echo "Primeira Consulta";}?>
                </td>

                <!--Nome do Medico-->
                <td class="tg-yw4l">
                  <?php echo $get['nomeCompleto']; ?>
                </td>

                <!--Data da Consulta-->
                <td class="tg-yw4l">
                  <?php
                    $data = date('d/m/Y', strtotime($get['dataConsulta']));
                    $hora = date('H:i', strtotime($get['horaConsulta']));
                    echo $data . ' - ' . $hora;
                  ?>
                </td>

                <!--Editar/Remover Consultas-->
                <td class="tg-yw4l">
                  <a href="editarconsultas.php?editar=<?php echo $get['idConsulta']; ?>" title="Editar Consulta"><span class="glyphicon glyphicon-pencil" aria-hidden="true" /></a> &nbsp;
                  <a href="remover.php?remover=<?php echo $get['idConsulta']; ?>&confirmaRemover=0" title="Remover Consulta"><span class="glyphicon glyphicon-trash" aria-hidden="true" /></a>
                </td>
              </tr>
              <?php
               }
                }else{echo '<b>Não existem consultas agendadas.</b>';}
             ?>
          </table>
        </center>

      </div>
    </div>

  </body>

  </html>
