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
  <title>Exames - ConsuCloud</title>

   <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Exames</h1>
      <a href="cadastrarexames.php"><button class="btn btn-raised btn-success pull-right">Novo Exame</button></a>

      <p>Consultar exame:</p>

      <div class="buscar">
        <form method="get" action="exames.php">
          <div class="form-group">
            <select required name="paciente" class="form-control">
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

          <center><button type="submit" class="btn btn-raised btn-info">Buscar Exames</button></center>
        </form>
      </div>

      <br><br>
      
      <div class="panel-group" id="accordion">
        <?php
        if(!empty($_GET['idPaciente'])){
          $idPaciente = $_GET['idPaciente'];
          //$crm = $_SESSION['CRM']; | AND medico = $crm 
          $select = $mysqli->query("SELECT * FROM exames WHERE paciente = $idPaciente ORDER BY dataExame DESC");
          $row = $select->num_rows;
          if($row){
            while($get = $select->fetch_array()){
              $rotacao++; //Sim isso é uma gambiarra
              $dataExame = $get['dataExame'];
              $nomeExame = $get['nomeExame'];
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $dataExame.$rotacao;?>">
                      <?php
                      $select1 = $mysqli->query("SELECT * FROM pacientes where idPaciente = $idPaciente");
                      $row1 = $select1->num_rows;
                      if($row1){
                        while($get1 = $select1->fetch_array()){
                          $nomePaciente = $get1['nomePaciente'];
                        }
                      }
                      if($get['paciente'] == $paciente){echo $nomePaciente . ' - ' . $nomeExame  . ' (' . $data = date('d-m-Y', strtotime($dataExame)) . ')';}
                      ?> ▾
                    </a>
                  </h4>
                </div>
                <div id="<?php echo $dataExame.$rotacao;?>" class="panel-collapse collapse">
                  <div class="panel-body">
                    <h4>Descrição do Exame:</h4>
                    <?php echo nl2br($get['descExame']); ?>

                    <br><br>
                    
                    <h4>Arquivos do Exame:<br><h5>(clique para baixar)</h5></h4>

                    <?php
                    $arquivos = explode(",", $get['arqsExame']);
                      
                      foreach($arquivos as $arquivo){
                        echo '<a href="arquivos/' . $idPaciente . '/' . $arquivo . '" download /> <img style="width: 3%; height: 3%" src="../assets/baixar.png" /> ' . $arquivo . '<br>';
                      }
                    ?>

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
