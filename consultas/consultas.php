<?php
require("../assets/connect.php");

session_start();

if($_SESSION["isMedico"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Consultas - ConsuCloud</title>

  <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

    <div class="container">
      <div class="jumbotron">

        <h1>Consultas</h1>

        <div class="container">
          <a href="cadastrarconsultas.php"><button class="btn btn-raised btn-success pull-right">CADASTRAR NOVA CONSULTA</button></a>
          <button type="button" class="btn btn-info btn-raised pull-left" data-toggle="collapse" data-target="#filtros">FILTRAR CONSULTAS</button>
          
          <br><br><br>
          
          <div id="filtros" class="collapse">
          
            <p>Filtrar consultas:</p>
  
            <div class="buscar">
              <form method="get" action="consultas.php">
      
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Nome do Paciente:</span>
                <input type="text" class="form-control" name="nomePaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos." value="<?php echo $_GET['nomePaciente']; ?>">
              </div>
              
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">RG do Paciente:</span>
                <input type="text" class="form-control" name="rgPaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos." value="<?php echo $_GET['rgPaciente']; ?>">
              </div>
      
                <br>
      
                <center><button type="submit" class="btn btn-raised btn-info">Filtrar</button> &nbsp; <a href="consultas.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></center>
              </form>
              
            </div>
          </div>
        </div>
        
        <br>
      
        <p>Consultas cadastradas:</p>

        <br>

        <center>
          <table id="rcorners1" class="tg">
            <tr>
              <th class="titulos">PACIENTE</th>
              <th class="titulos">TIPO</th>
              <th class="titulos">MÉDICO</th>
              <th class="titulos">DATA - HORA</th>
            </tr>
            <?php
              if(!empty($_GET)){
              
                $idUsuario = $_SESSION['idUsuario'];
                
                if($_GET['nomePaciente'] != ""){
                $busca = $_GET['nomePaciente'];
                
                $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, idConsulta FROM consultas AS c 
                                          JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                          JOIN usuarios AS u ON u.idUsuario = c.medico 
                                          WHERE p.nomePaciente = '$busca' AND dataConsulta >= CURDATE() ORDER BY dataConsulta ASC, horaConsulta ASC"); 
              }elseif($_GET['rgPaciente'] != ""){
                $busca = $_GET['rgPaciente'];
                
                $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, idConsulta FROM consultas AS c 
                                          JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                          JOIN usuarios AS u ON u.idUsuario = c.medico 
                                          WHERE p.RG = $busca AND dataConsulta >= CURDATE() ORDER BY dataConsulta ASC, horaConsulta ASC"); 
              }else{
                $busca1 = $_GET['rgPaciente'];
                $busca2 = $_GET['nomePaciente'];
                
                $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, idConsulta FROM consultas AS c 
                                          JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                          JOIN usuarios AS u ON u.idUsuario = c.medico 
                                          WHERE p.RG = $busca1 AND p.nomePaciente = '$busca2' AND dataConsulta >= CURDATE() ORDER BY dataConsulta ASC, horaConsulta ASC"); 
              }
            }else{
             $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, idConsulta FROM consultas AS c 
                                          JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                          JOIN usuarios AS u ON u.idUsuario = c.medico 
                                          WHERE dataConsulta >= CURDATE() ORDER BY dataConsulta ASC, horaConsulta ASC"); 
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

                <!--Tipo de Consulta -->
                <td class="tg-yw4l">
                  <?php if($get['tipoConsulta'] == "retorno"){echo "Retorno";}elseif($get['tipoConsulta'] == "primeiraConsulta"){echo "Primeira Consulta";}?>
                </td>

                <!--Nome do Medico-->
                <td class="tg-yw4l">
                  <?php echo $get['nomeCompleto']; ?>
                </td>

                <!--Data da Consulta-->
                <td class="tg-yw4l">
                  <?php
                    $data = date('d/m/Y', strtotime($get['dataConsulta']));
                    $hora = date('H:i', strtotime($get['horaConsulta']));
                    echo $data . ' - ' . $hora;
                  ?>
                </td>

                <!--Editar/Remover Consultas-->
                <td class="tg-yw4l">
                  <a href="editarconsultas.php?editar=<?php echo $get['idConsulta']; ?>" title="Editar Consulta"><span class="glyphicon glyphicon-pencil" aria-hidden="true" /></a> &nbsp;
                  <a href="remover.php?remover=<?php echo $get['idConsulta']; ?>&confirmaRemover=0" title="Remover Consulta"><span class="glyphicon glyphicon-trash" aria-hidden="true" /></a>
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
