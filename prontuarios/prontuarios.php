<?php
require("../assets/connect.php");

session_start();

if($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true || !$_SESSION){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}elseif(empty($_SESSION)){
  header("Location: ../logout.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Prontuários - ConsuCloud</title>

  <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Prontuários</h1>
      <a href="cadastrarprontuarios.php"><button class="btn btn-raised btn-success pull-right">Novo Prontuário</button></a>

      <p>Consultar prontuário:</p>

      <div class="buscar">
        <form method="get" action="prontuarios.php">
          <div class="form-group">
            <select required name="idPaciente" class="form-control">
              <option disabled selected value="">Selecione o paciente ▾</option>
              <?php
              $select = $mysqli->query("SELECT * FROM pacientes");
              $row = $select->num_rows;
              if($row){
                while($get = $select->fetch_array()){
                  ?>
                  <option value="<?php echo $get['idPaciente']; ?>"><?php echo $get['RG'] . " - " . $get['nomePaciente']; ?></option>
                  <?php
                }
              }
              ?>
            </select>
          </div>

          <br>

          <center><button type="submit" class="btn btn-raised btn-info">Buscar Prontuários</button></center>
        </form>
      </div>

      <br><br>
      
      <div class="panel-group" id="accordion">
        <?php
          if(!empty($_GET['idPaciente'])){
            
            $idPaciente = $_GET['idPaciente'];
            $idUsuario = $_SESSION['idUsuario'];
            
            $select = $mysqli->query("SELECT p.nomePaciente, dataProntuario, horaProntuario, prontuario FROM prontuarios AS pront 
                                        JOIN pacientes AS p ON p.idPaciente = pront.paciente 
                                        WHERE pront.paciente = $idPaciente AND pront.medico = $idUsuario ORDER BY dataProntuario ASC, horaProntuario ASC");
            $row = $select->num_rows;
            if($row){
              while($get = $select->fetch_array()){
                $hiperlink = $get['dataProntuario'].date('H-i-s', strtotime($get['horaProntuario']));
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $hiperlink;?>">
                      <?php
                        echo $get['nomePaciente'] . ' (' . date('d-m-Y', strtotime($get['dataProntuario'])) . ' - ' . $get['horaProntuario'] . ')';
                      ?> ▾
                    </a>
                  </h4>
                </div>
                <div id="<?php echo $hiperlink;?>" class="panel-collapse collapse">
                  <div class="panel-body">
                    <?php echo nl2br($get['prontuario']); ?>
                  </div>
                </div>
              </div>
              <?php
            }
          }
        }
        ?>
      </div>

    </div>
  </div>

</body>

</html>
