<?php
session_start();
$idUsuario = $_SESSION["idUsuario"];

if($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}

require("componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Agenda - ConsuCloud</title>

   <?php include "componentes/boot.php";?>
</head>

<body>

<?php include "componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Agenda</h1>
      <p>Aqui está sua agenda de consultas futuras:</p>
       
      <br>
        
      <center>
        
        <form method="get" action="agenda.php">
          <p>
            <table style="width:350px;">
              <tr>
                <th><input type="text" class="form-control" name="timestamp_day" placeholder="Dia" maxlength="2" value="<?php echo $_GET['timestamp_day']; ?>"></th>
                <th><input required type="text" class="form-control" name="timestamp_month" placeholder="Mês" maxlength="2" value="<?php echo $_GET['timestamp_month']; ?>"></th>
                <th><input required type="text" class="form-control" name="timestamp_year" placeholder="Ano" maxlength="4" value="<?php echo $_GET['timestamp_year']; ?>"></th>
                <th><a href="agenda.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></th>
              </tr>
            </table>

	          <button class="btn btn-raised btn-primary" type="submit">Filtrar Agenda</button>
          </p>
        </form>
        
        <table id="rcorners1" class="tg">
          <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">TIPO</th>
            <th class="titulos">DATA - HORA</th>
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
            $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta BETWEEN '$mes' AND LAST_DAY('$mes') AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
          }elseif($data){
            $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta = '$data' AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
          }else{
            $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta > CURDATE() AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
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

              <!--Tipo da Consulta-->
              <td class="tg-yw4l">
                <?php if($get['tipoConsulta'] == "retorno"){echo "Retorno";}elseif($get['tipoConsulta'] == "primeiraConsulta"){echo "Primeira Consulta";}?>
              </td>

              <!--Data da Consulta-->
              <td class="tg-yw4l">
                <?php
                  $data = date('d-m-Y', strtotime($get['dataConsulta']));
                  $hora = date('H:i', strtotime($get['horaConsulta']));
                  echo $data . ' - ' . $hora;
                  ?>
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
