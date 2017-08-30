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
        
        <form method="post" action="agenda.php">
          <?php
            $dataFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['data'])))));
            $mesFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['mes'])))));
             if(!empty($mesFiltro)){
               $mesFiltro = date('Y-m',$mesFiltro); 
              }
              if(!empty($dataFiltro)){
                $dataFiltro = date('Y-m-d',$dataFiltro);
              }
          ?>
          <div style="width:350px;">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Dia:</span>
              <input value="<?php echo $dataFiltro ?>" type="date" class="form-control" name="data" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
            </div>
            ou
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Mês:</span>
              <input value="<?php echo $mesFiltro ?>" type="month" class="form-control" name="mes" aria-describedby="basic-addon1" max="9999-12" maxlength="7" OnKeyPress="formatar('##/####', this)">
            </div>
          </div>
            
          <p>
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
          
          if(!empty($_POST)){
            if(!empty($_POST['mes'])){
              $mesFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['mes'])))));
              $mesFiltro = date('Y-m-d',$mesFiltro); 
              unset($dataFiltro);
            }elseif (!empty($_POST['data'])){
              $dataFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['data'])))));
              $dataFiltro = date('Y-m-d',$dataFiltro);
              unset($mesFiltro);
            }
          }
          
          if(!empty($_POST)){
            if(!empty($_POST['mes'])){
              $mesFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['mes'])))));
              $mesFiltro = date('Y-m-d',$mesFiltro); 
              unset($dataFiltro);
            }elseif (!empty($_POST['data'])){
              $dataFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['data'])))));
              $dataFiltro = date('Y-m-d',$dataFiltro);
              unset($mesFiltro);
            }
          }
          
          if($mes){
            $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta BETWEEN '$mesFiltro' AND LAST_DAY('$mesFiltro') AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
          }elseif($data){
            $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta = '$dataFiltro' AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
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
