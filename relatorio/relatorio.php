<?php
session_start();

if($_SESSION["isMedico"] == true){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}if(empty($_SESSION)){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}

require("../componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Relatório - ConsuCloud</title>
  
  <?php include "../componentes/boot.php";?>
</head>

<body>

<?php include "../componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Relatório de Consultas</h1>
      <p>Aqui podem ser gerados relatórios de consultas.</p>

      <br>
      <center>
        
         <form method="post" action="relatorio.php">
          <?php
            $dataInicio = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataInicio'])))));
            $dataFim = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataFim'])))));
            
            if($dataFim < $dataInicio){
               echo '<div style="width: 500px;" class="alert alert-warning" id="rcorners2" role="alert"><b>Data Inicial não pode ser menor que Data Final!</b></div>';
            }
            
            if(!empty($dataInicio)){
              $dataInicio = date('Y-m-d',$dataInicio);
            }
          
            if(!empty($dataFim)){
              $dataFim = date('Y-m-d',$dataFim);
            }
          ?>
          
          <div class="form-group" style="width: 500px;">
          <p>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Data Inicial:</span>
              <input required value="<?php echo $dataInicio ?>" type="date" class="form-control" name="dataInicio" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
            </div>
            
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Data Final:</span>
              <input required value="<?php echo $dataFim ?>" type="date" class="form-control" name="dataFim" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
            </div>
          
            <!--Médico das Consultas-->
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
          $dataInicio = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataInicio'])))));
          $dataInicio = date('Y-m-d',$dataInicio); 
          
          $dataFim = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataFim'])))));
          $dataFim = date('Y-m-d',$dataFim); 
          
          $medico = $_POST['medico'];
          $plano = $_POST['plano'];
        ?>

      <div id="rcorners1" style="overflow-y: auto; max-height: 400px; max-width: 80%; ">
        <!--Tabela 2/Cabeçalho da Tabela 2-->
        <table class="tg">
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
        </div>

        <br>

        <form method="post" action="gerar.php" target="_blank">
          <button class="btn btn-raised btn-primary" type="submit">Imprimir Relatório</button>
          <p><h5><b>Nota:</b> Consultas não executadas (simbolo do <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>) não serão exibidas no relatório final.</h5></p>
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
