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

  <div class="container">
    <div class="jumbotron">

      <h1>Agenda</h1>
      <p>Aqui está sua agenda de consultas futuras:</p>
       
      <br>
        
      <center>
        
        <form method="post" action="agenda.php">
          <?php
            $dataInicio = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataInicio'])))));
            $dataFim = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataFim'])))));

            if(!empty($dataFim)){
              if($dataFim < $dataInicio){
                 echo '<div style="width: 500px;" class="alert alert-warning" id="rcorners2" role="alert"><b>Data Inicial não pode ser menor que Data Final!</b></div>';
                 unset($_POST);
              }
            }
            
            if(!empty($dataInicio) || !empty($dataFim)){
              if($dataInicio < time() || $dataFim < time()){
                 echo '<div style="width: 500px;" class="alert alert-warning" id="rcorners2" role="alert"><b>Para buscar consultas anteriores use a função de histórico!</b></div>';
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
              <input value="<?php echo $dataInicio ?>" type="date" class="form-control" name="dataInicio" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
            </div>
            e / ou
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Data Final:</span>
              <input value="<?php echo $dataFim ?>" type="date" class="form-control" name="dataFim" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
            </div>
          </div>  
          
          <p>
	          <button class="btn btn-raised btn-primary" type="submit">Filtrar Agenda</button> &nbsp; <a href="agenda.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
          </p>
        </form>
        
        <br><br>
        
        <table id="rcorners1" class="tg">
          <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">TIPO</th>
            <th class="titulos">DATA - HORA</th>
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
          }
          
          if(!empty($dataInicio) && empty($dataFim)){
            $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta = '$dataInicio' AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
          }elseif(!empty($dataInicio) && !empty($dataFim)){
            $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta BETWEEN '$dataInicio' AND '$dataFim' AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
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
