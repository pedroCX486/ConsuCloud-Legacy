<?php
require("../componentes/db/connect.php");

session_start();

if($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true){
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
  <title>Prontuários - ConsuCloud</title>

  <?php include "../componentes/boot.php";?>
</head>

<body>

<?php include "../componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Prontuários</h1>
      <a href="cadastrarprontuarios.php"><button class="btn btn-raised btn-success pull-right">Novo Prontuário</button></a>

      <p>Consultar prontuário:</p>

      <div class="buscar">
        <form method="post" action="prontuarios.php">
        
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Nome do Paciente:</span>
          <input type="text" class="form-control" name="nomePaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos." value="<?php echo $_POST['nomePaciente']; ?>">
        </div>
        
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">RG do Paciente:</span>
          <input type="number" class="form-control" name="rgPaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos." value="<?php echo $_POST['rgPaciente']; ?>">
        </div>
        
        <center><button type="submit" class="btn btn-raised btn-info">Buscar Paciente</button> &nbsp; <a href="prontuarios.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></center>

          <br>
          
        <div class="form-group">
          <select name="idPaciente" class="form-control">
              <option disabled selected value="">Nome do Paciente*</option>
                <?php        
                if(!empty($_POST['nomePaciente']) || !empty($_POST['rgPaciente'])){
                  
                    $idUsuario = $_SESSION['idUsuario'];
              
                    if($_POST['nomePaciente'] != ""){
                      $busca = $_POST['nomePaciente'];
                      
                      $select = $mysqli->query("SELECT * FROM pacientes WHERE nomePaciente = '$busca'");
                      
                    }elseif($_POST['rgPaciente'] != ""){
                      $busca = $_POST['rgPaciente'];
                      
                      $select = $mysqli->query("SELECT * FROM pacientes WHERE RG = '$busca'");
                      
                    }else{
                      $busca1 = $_POST['rgPaciente'];
                      $busca2 = $_POST['nomePaciente'];
                      
                      $select = $mysqli->query("SELECT * FROM pacientes WHERE nomePaciente = '$busca1' AND RG = '$busca2'");
                      
                    }
                
                  }
                  $row = $select->num_rows;
                  if($row){              
                    while($get = $select->fetch_array()){
                      ?>
                        <option value="<?php echo $get['idPaciente']; ?>" ><?php echo $get['RG'] . ' - ' . $get['nomePaciente']; ?></option>
                      <?php
                    }
                  }
                ?>
              </select>
        </div>

          <center><button type="submit" class="btn btn-raised btn-info">Buscar Prontuários</button></center>
        </form>
      </div>

      <br><br>
      
      <div class="panel-group" id="accordion">
        <?php
          if(!empty($_POST['idPaciente'])){
            
            $idUsuario = $_SESSION['idUsuario'];
            
            if($_POST['nomePaciente'] != ""){
            $busca = $_POST['nomePaciente'];
            
            $select = $mysqli->query("SELECT p.nomePaciente, dataProntuario, horaProntuario, prontuario, idProntuario FROM prontuarios AS pront 
                                        JOIN pacientes AS p ON p.idPaciente = pront.paciente 
                                        WHERE p.nomePaciente = '$busca' AND pront.medico = $idUsuario ORDER BY dataProntuario ASC, horaProntuario ASC");
          }elseif($_POST['rgPaciente'] != ""){
            $busca = $_POST['rgPaciente'];
            
            $select = $mysqli->query("SELECT p.nomePaciente, dataProntuario, horaProntuario, prontuario, idProntuario FROM prontuarios AS pront 
                                        JOIN pacientes AS p ON p.idPaciente = pront.paciente 
                                        WHERE p.RG = $busca AND pront.medico = $idUsuario ORDER BY dataProntuario ASC, horaProntuario ASC");
          }else{
            $busca1 = $_POST['rgPaciente'];
            $busca2 = $_POST['nomePaciente'];
            
            $select = $mysqli->query("SELECT p.nomePaciente, dataProntuario, horaProntuario, prontuario, idProntuario FROM prontuarios AS pront 
                                        JOIN pacientes AS p ON p.idPaciente = pront.paciente 
                                        WHERE p.RG = $busca1 AND p.nomePaciente = '$busca2' AND pront.medico = $idUsuario ORDER BY dataProntuario ASC, horaProntuario ASC");
          }

            $row = $select->num_rows;
            if($row){
              while($get = $select->fetch_array()){
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $get['idProntuario'];?>">
                      <?php
                        echo $get['nomePaciente'] . ' (' . date('d-m-Y', strtotime($get['dataProntuario'])) . ' - ' . $get['horaProntuario'] . ')';
                      ?> ▾
                    </a>
                  </h4>
                </div>
                <div id="<?php echo $get['idProntuario'];?>" class="panel-collapse collapse">
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
