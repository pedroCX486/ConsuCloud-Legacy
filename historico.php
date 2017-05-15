<?php
session_start();

if($_SESSION["isMedico"] == true || !$_SESSION){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../logout.php");
    exit();
}

require("assets/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Histórico - ConsuCloud</title>

   <?php include "assets/bootstrap.php";?>
</head>

<body>

<?php include "barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Histórico de Consultas</h1>
			<p>Aqui ficam registradas todas as consultas passadas.</p>

      <br>
      <center>

        <form method="get" action="historico.php">
          <p>
            <table style="width:350px;">
              <tr>
                <th><input required type="text" class="form-control" name="timestamp_month" placeholder="Mês" maxlength="2"></th>
                <th><input required type="text" class="form-control" name="timestamp_year" placeholder="Ano" maxlength="4"></th>
              </tr>
            </table>

			     <button class="btn btn-raised btn-primary" type="submit">Buscar Histórico</button>
          </p>

          <?php $mes = $_GET['timestamp_year'] . '-' . $_GET['timestamp_month'] . '-01'; ?>
        </form>

        <table id="rcorners1" class="tg">
          <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">MÉDICO</th>
            <th class="titulos">DATA - HORA</th>
            <th class="titulos">PLANO (CARTEIRA)</th>
          </tr>
          <?php
              $select = $mysqli->query("SELECT * FROM consultas WHERE dataConsulta BETWEEN '$mes' AND LAST_DAY('$mes') ORDER BY dataConsulta DESC");
              $row = $select->num_rows;
              if($row){
                while($get = $select->fetch_array()){
                  //Pegar dados necessários:
                  $rgPacienteConsulta = $get['paciente'];
                  $CRMconsulta = $get['medico'];
                  $planoConsulta = $get['planoConsulta'];
            ?>
            <tr>
              <!--Nome do Paciente-->
              <td class="tg-yw4l">
                <?php
                   $select1 = $mysqli->query("SELECT * FROM pacientes where numIdRG = $rgPacienteConsulta");
                   $row1 = $select1->num_rows;
                   if($row1){
                    while($get1 = $select1->fetch_array()){
                     $nomePaciente = $get1['nomeComp'];
                     $idPaciente = $get1['numIdRG'];
                    }
                   }
                  if($rgPacienteConsulta == $idPaciente){echo $nomePaciente;}
                  ?>
              </td>

              <!--Nome do Medico-->
              <td class="tg-yw4l">
                <?php
                   $select2 = $mysqli->query("SELECT * FROM usuarios where crm = $CRMconsulta");
                   $row2 = $select2->num_rows;
                   if($row2){
                    while($get2 = $select2->fetch_array()){
                      $nomeMedico = $get2['nomeComp'];
                      $crmMedico = $get2['crm'];
                    }
                   }
                  if($CRMconsulta == $crmMedico){echo $nomeMedico;}
                  ?>
              </td>

              <!--Data da Consulta-->
              <td class="tg-yw4l">
                <?php
                  $data = date('d-m-Y', strtotime($get['dataConsulta']));
                  $hora = date('H:i', strtotime($get['horaConsulta']));
                  echo $data . ' - ' . $hora;
                  ?>
              </td>

              <!--Plano da Consulta-->
              <td>
                <?php
                   $select2 = $mysqli->query("SELECT * FROM planos where id = $planoConsulta");
                   $row2 = $select2->num_rows;
                   if($row2){
                    while($get2 = $select2->fetch_array()){
                     $nomePlano = $get2['nomePlano'];
                     $idPlano = $get2['id'];
                    }
                   }
                  if($planoConsulta == $idPlano && $idPlano == '1'){echo $nomePlano;}
                  elseif($planoConsulta == $idPlano && $idPlano != '1'){echo $nomePlano . ' (' . $get['carteiraPlano'] . ')';}
                  ?>
              </td>

              <!-- Confirmar/Desconfirmar Consultas-->
              <td class="tg-yw4l">
                <?php
                if($get['confirmaConsulta'] == '1'){echo '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>';}
                else{echo '<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>';}
                ?>
             </td>
             
            </tr>
            <?php
               }
                }else{echo '<b>Sem resultados.</b>';}
             ?>
        </table>
      </center>

    </div>
  </div>

</body>

</html>
