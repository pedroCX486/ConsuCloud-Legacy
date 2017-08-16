<?php
session_start();

if($_SESSION["isMedico"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}

require("../componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Histórico - ConsuCloud</title>

   <?php include "../componentes/boot.php";?>
</head>

<body>

<?php include "../componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Histórico de Consultas</h1>
			<p>Aqui ficam registradas todas as consultas passadas.</p>

      <br>
      <center>

        <form method="get" action="historico_secretaria.php">
          <p>
            <table style="width:350px;">
              <tr>
                <th><input type="number" min="1" max="31" class="form-control" name="timestamp_day" placeholder="Dia" maxlength="2" value="<?php echo $_GET['timestamp_day']; ?>"></th>
                <th><input required type="number" min="1" max="12" class="form-control" name="timestamp_month" placeholder="Mês" maxlength="2" value="<?php echo $_GET['timestamp_month']; ?>"></th>
                <th><input required type="number" min="1500" max="3999" class="form-control" name="timestamp_year" placeholder="Ano" maxlength="4" value="<?php echo $_GET['timestamp_year']; ?>"></th>
                <th><a href="historico_medico.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></th>
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
            <th class="titulos">TIPO</th>
            <th class="titulos">PLANO (CARTEIRA)</th>
          </tr>
          <?php
          
          if(!empty($_GET)){
            if($_GET['timestamp_day'] == ""){
              $mes = $_GET['timestamp_year'] . '-' . $_GET['timestamp_month'] . '-01';
              unset($data);
            }else{
              $data = $_GET['timestamp_year'] . '-' . $_GET['timestamp_month'] . '-' . $_GET['timestamp_day'];  
              unset($mes);
            }
          }
          
          if($mes){
              $select = $mysqli->query("SELECT pl.nomePlano, p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, confirmaConsulta, carteiraPlano FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        JOIN planos AS pl ON c.planoConsulta = pl.idPlano
                                        WHERE dataConsulta BETWEEN '$mes' AND LAST_DAY('$mes') ORDER BY dataConsulta ASC, horaConsulta ASC");
          }elseif($data){
              $select = $mysqli->query("SELECT pl.nomePlano, p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, confirmaConsulta, carteiraPlano FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        JOIN planos AS pl ON c.planoConsulta = pl.idPlano
                                        WHERE dataConsulta = '$data' ORDER BY dataConsulta ASC, horaConsulta ASC");
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
                <?php if($get['tipoConsulta'] == "retorno"){echo "Retorno";}elseif($get['tipoConsulta'] == "primeiraConsulta"){echo "Primeira Consulta";}?>
              </td>

              <!--Plano da Consulta/Carteira do Plano-->
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
      </center>

    </div>
  </div>

</body>

</html>
