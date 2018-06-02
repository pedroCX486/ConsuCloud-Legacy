<?php
date_default_timezone_set('America/Recife');

session_start();

if(!$_SESSION["isMedico"] || empty($_SESSION["idUsuario"])){
 include("../componentes/redirect.php");
}

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

$idUsuario = $_SESSION['idUsuario'];

require($_SESSION["installFolder"]."componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Histórico - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/maskFormat.js"></script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Histórico de Consultas</h1>
      <p>Aqui ficam registradas todas as consultas passadas.</p>

      <br>
      <center>

        <form method="post" action="historico_medico.php">
          <?php
            $dataInicio = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataInicio'])))));
            $dataFim = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataFim'])))));

            if(!empty($dataFim)){
              if($dataFim < $dataInicio){
                echo '<div style="width: 500px;" class="alert alert-warning" id="rcorners2" role="alert"><b>Data Inicial não pode ser menor que Data Final!</b></div>';
                unset($_POST);
              }
            }
          
            if(!empty($dataFim)){
              if($dataFim > time()){
                echo '<div style="width: 500px;" class="alert alert-warning" id="rcorners2" role="alert"><b>Para buscar consultas futuras use a função de Agenda!</b></div>';
                unset($_POST);
              }
            }
            
            if(!empty($dataInicio)){
              $dataInicio = date('Y-m-d',$dataInicio); 
            }
            if(!empty($dataFim)){
              $dataFim = date('Y-m-d',$dataFim);
            }
          ?>

          <div style="width:350px;">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Data Inicial:</span>
              <input value="<?php echo $dataInicio ?>" type="date" class="form-control" name="dataInicio" aria-describedby="basic-addon1"
                max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
            </div>
            e / ou
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Data Final:</span>
              <input value="<?php echo $dataFim ?>" type="date" class="form-control" name="dataFim" aria-describedby="basic-addon1" max="9999-12-31"
                maxlength="10" OnKeyPress="formatar('##/##/####', this)">
            </div>
          </div>

          <p>
            <button class="btn btn-raised btn-primary" type="submit">Buscar Histórico</button> &nbsp;
            <a class="anchor" href="historico_medico.php">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
          </p>
        </form>

        <br>
        <br>

        <table id="rcorners1" class="tg">
          <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">MÉDICO</th>
            <th class="titulos">DATA - HORA</th>
            <th class="titulos">TIPO</th>
          </tr>
          <?php
          
            if(!empty($_POST)){
              if(!empty($_POST['dataInicio'])){
                $dataInicio = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataInicio'])))));
                $dataInicio = date('Y-m-d',$dataInicio); 
              }elseif (!empty($_POST['dataFim'])){
                $dataFim = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataFim'])))));
                $dataFim = date('Y-m-d',$dataFim);
              }
                   
              if(!empty($dataInicio) && empty($dataFim)){
                $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, confirmaConsulta FROM consultas AS c 
                                            JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                            JOIN usuarios AS u ON u.idUsuario = c.medico 
                                            WHERE dataConsulta >= '$dataInicio' AND c.medico = $idUsuario ORDER BY dataConsulta DESC, horaConsulta DESC");
              }elseif(!empty($dataInicio) && !empty($dataFim)){
                $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, confirmaConsulta FROM consultas AS c 
                                            JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                            JOIN usuarios AS u ON u.idUsuario = c.medico 
                                            WHERE dataConsulta BETWEEN '$dataInicio' AND '$dataFim' AND c.medico = $idUsuario ORDER BY dataConsulta DESC, horaConsulta DESC");
              }
              
            }
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

            <!--Tipo de Consulta -->
            <td class="tg-yw4l">
              <?php echo $get['tipoConsulta']; ?>
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