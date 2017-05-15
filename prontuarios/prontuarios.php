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
            <select required name="paciente" class="form-control">
              <option disabled selected value="">Selecione o paciente ▾</option>
              <?php
              $select = $mysqli->query("SELECT * FROM pacientes");
              $row = $select->num_rows;
              if($row){
                while($get = $select->fetch_array()){
                  ?>
                  <option value="<?php echo $get['numIdRG']; ?>"><?php echo $get['numIdRG'] . " - " . $get['nomeComp']; ?></option>
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
          if(!empty($_GET['paciente'])){
            $paciente = $_GET['paciente'];
            $crm = $_SESSION['CRM'];
            $select = $mysqli->query("SELECT * FROM prontuarios WHERE paciente = $paciente AND medico = $crm ORDER BY dataProntuario DESC");
            $row = $select->num_rows;
            if($row){
              while($get = $select->fetch_array()){
                $rotacao++; //Sim isso é uma gambiarra
                $dataProntuario = $get['dataProntuario'];
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $dataProntuario.$rotacao;?>">
                      <?php
                        $select1 = $mysqli->query("SELECT * FROM pacientes where numIdRG = $paciente");
                        $row1 = $select1->num_rows;
                        if($row1){
                          while($get1 = $select1->fetch_array()){
                            $nomePaciente = $get1['nomeComp'];
                          }
                        }
                        if($get['paciente'] == $paciente){echo $nomePaciente . ' (' . $data = date('d-m-Y', strtotime($dataProntuario)) . ')';}
                      ?> ▾
                    </a>
                  </h4>
                </div>
                <div id="<?php echo $dataProntuario.$rotacao;?>" class="panel-collapse collapse">
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
