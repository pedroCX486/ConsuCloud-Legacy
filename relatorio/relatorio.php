<?php
session_start();

if($_SESSION["isMedico"] == true || !$_SESSION){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}elseif(empty($_SESSION)){
  header("Location: ../logout.php");
  exit();
}

require("../assets/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Relatório - ConsuCloud</title>
  
  <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Relatório de Consultas<br><small>Aqui podem ser gerados relatórios de consultas em PDF.</small></h1>

      <br>
      <center>

        <form method="get" action="relatorio.php">
          <p>

            <!--Tabela/Campos para serem preenchidos-->
            <table>
              <tr>
                <th width="50px">Início:</th>
                <td><input required type="text" class="form-control" name="diaInicio" placeholder="Dia" maxlength="2"></td>
                <td><input required type="text" class="form-control" name="mesInicio" placeholder="Mês" maxlength="2"></td>
                <td><input required type="text" class="form-control" name="anoInicio" placeholder="Ano" maxlength="4"></td>
              </tr>
              <tr>
                <th>Fim:</th>
                <td><input required type="text" class="form-control" name="diaFim" placeholder="Dia" maxlength="2"></td>
                <td><input required type="text" class="form-control" name="mesFim" placeholder="Mês" maxlength="2"></td>
                <td><input required type="text" class="form-control" name="anoFim" placeholder="Ano" maxlength="4"></td>
              </tr>
            </table>

            <!--Médico das Consultas-->
            <div class="form-group" style="width: 500px;">
              <select required name="medico" class="form-control">
                <option disabled selected value="">Médico das Consultas*</option>
                <?php
                $select00 = $mysqli->query("SELECT * FROM usuarios WHERE tipoUsuario = 'Medico'");
                $row00 = $select00->num_rows;
                if($row00){
                  while($get00 = $select00->fetch_array()){
                    ?>
                    <option value="<?php echo $get00['crm']; ?>" ><?php echo $get00['nomeComp']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>

            <!--Plano das Consultas-->
            <div class="form-group" style="width: 500px;">
              <select required name="plano" class="form-control">
                <option disabled selected value="">Plano das Consultas*</option>
                <?php
                $select0 = $mysqli->query("SELECT * FROM planos");
                $row0 = $select0->num_rows;
                if($row0){
                  while($get0 = $select0->fetch_array()){
                    ?>
                    <option value="<?php echo $get0['id']; ?>" ><?php echo $get0['nomePlano']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>

            <button class="btn btn-raised btn-primary" type="submit">Gerar Relatório</button>
          </p>
        </form>

        <!--Variáveis para query-->
        <?php
        $dataInicio = $_GET['anoInicio'] . '-' . $_GET['mesInicio'] . '-' . $_GET['diaInicio'];
        $dataFim = $_GET['anoFim'] . '-' . $_GET['mesFim'] . '-' . $_GET['diaFim'];
        $medico = $_GET['medico'];
        $plano = $_GET['plano'];
        ?>

        <!--Tabela 2/Cabeçalho da Tabela 2-->
        <table id="rcorners1" class="tg">
          <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">MÉDICO</th>
            <th class="titulos">DATA - HORA</th>
            <th class="titulos">PLANO (CARTEIRA)</th>
          </tr>

          <!--Mega Query para buscar os dados do relatório-->
          <?php
          $select = $mysqli->query("SELECT * FROM consultas WHERE dataConsulta BETWEEN '$dataInicio' AND '$dataFim' AND medico = '$medico' and planoConsulta = '$plano' ORDER BY dataConsulta DESC");
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
                    $select3 = $mysqli->query("SELECT * FROM planos where id = $planoConsulta");
                    $row3 = $select3->num_rows;
                    if($row3){
                      while($get3 = $select3->fetch_array()){
                        $nomePlano = $get3['nomePlano'];
                        $idPlano = $get3['id'];
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

        <br>

        <form method="get" action="gerar.php" target="_blank">
          <button class="btn btn-raised btn-primary" type="submit">Imprimir Relatório</button>
          <p><h5><b>Nota:</b> Consultas não confirmadas (simbolo do <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>) não serão exibidas no relatório.</h5></p>
          <input type="hidden" name="dataInicio" value="<?php echo $dataInicio; ?>">
          <input type="hidden" name="dataFim" value="<?php echo $dataFim; ?>">
          <input type="hidden" name="medico" value="<?php echo $medico; ?>">
          <input type="hidden" name="plano" value="<?php echo $plano; ?>">
        </form>

      </center>

    </div>
  </div>

</body>

</html>
