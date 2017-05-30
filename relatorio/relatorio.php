<?php
session_start();

if($_SESSION["isMedico"] == true){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}if(empty($_SESSION)){
  header("Location: ../index.php?erro=ERROFATAL");
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

      <h1>Relatório de Consultas</h1>
      <p>Aqui podem ser gerados relatórios de consultas.</p>

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
                  $selectMedico = $mysqli->query("SELECT * FROM usuarios WHERE tipoUsuario = 'Medico'");
                  $rowMedico = $selectMedico->num_rows;
                  if($rowMedico){
                    while($getMedico = $selectMedico->fetch_array()){
                      ?>
                        <option value="<?php echo $getMedico['idUsuario']; ?>" ><?php echo $getMedico['nomeCompleto']; ?></option>
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
                  $selectPlano = $mysqli->query("SELECT * FROM planos");
                  $rowPlano = $selectPlano->num_rows;
                  if($rowPlano){
                    while($getPlano = $selectPlano->fetch_array()){
                      ?>
                        <option value="<?php echo $getPlano['idPlano']; ?>" ><?php echo $getPlano['nomePlano']; ?></option>
                      <?php
                    }
                  }
                ?>
              </select>
            </div>

            <button class="btn btn-raised btn-primary" type="submit">Gerar Relatório</button>
          </p>
        </form>

        <!--Variáveis para Mega Query-->
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

          <!--Mega Query para dados do Relatório-->
          <?php
            $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, dataConsulta, horaConsulta, pl.nomePlano, carteiraPlano, confirmaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN planos AS pl ON pl.idPlano = c.planoConsulta
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta BETWEEN '$dataInicio' AND '$dataFim' AND c.medico = '$medico' AND c.planoConsulta = '$plano'
                                        ORDER BY dataConsulta DESC, horaConsulta DESC");
            $row = $select->num_rows;
            if($row){
              while($get = $select->fetch_array()){
              ?>
               <tr>

                <!--Nome do Paciente-->
                <td class="tg-yw4l">
                  <?php echo $get['nomePaciente']; ?>
                </td>

                <!--Nome do Medico-->
                <td class="tg-yw4l">
                  <?php echo $get['nomeCompleto']; ?>
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
                <td class="tg-yw4l">
                  <?php
                    echo $get['nomePlano'];
                    if($get['carteiraPlano'] != '0'){echo ' ('.$get['carteiraPlano'].')';}
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
          <p><h5><b>Nota:</b> Consultas não confirmadas (simbolo do <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>) não serão exibidas no relatório final.</h5></p>
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
