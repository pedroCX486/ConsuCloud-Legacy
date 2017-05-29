<?php
session_start();
$idUsuario = $_SESSION["idUsuario"];

if($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true || !$_SESSION){
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
  <title>Agenda - ConsuCloud</title>

   <?php include "assets/bootstrap.php";?>
</head>

<body>

<?php include "barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Agenda</h1>
      <p>Aqui está sua agenda de consultas futuras:</p>
       
      <br>
        
      <center>
        <table id="rcorners1" class="tg">
          <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">TIPO</th>
            <th class="titulos">DATA - HORA</th>
          </tr>
          <?php
              $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta > CURDATE() AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
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
