<?php
<<<<<<< HEAD
require("../componentes/db/connect.php");

session_start();

if($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}elseif(empty($_SESSION)){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}
=======
session_start();

require("../componentes/sessionbuster.php");

if(!$_SESSION["isMedico"]){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}elseif(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}

require("../componentes/db/connect.php");
>>>>>>> consucloud-2/master
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Prontuários - ConsuCloud</title>

  <?php include "../componentes/boot.php";?>
<<<<<<< HEAD
</head>

<body>

<?php include "../componentes/barra.php"; ?>
=======
  <script src="../componentes/tabBusca.js"></script>
</head>

<body>
  
  <?php include "../componentes/barra.php"; ?>
>>>>>>> consucloud-2/master

  <div class="container">
    <div class="jumbotron">

      <h1>Prontuários</h1>
<<<<<<< HEAD
      <a href="cadastrarprontuarios.php"><button class="btn btn-raised btn-success pull-right">Novo Prontuário</button></a>
=======
      <a class="anchor" href="cadastrarprontuarios.php">
        <button class="btn btn-raised btn-success pull-right">NOVO PRONTUÁRIO</button>
      </a>
>>>>>>> consucloud-2/master

      <p>Consultar prontuário:</p>

      <div class="buscar">
<<<<<<< HEAD
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
                
=======
        
        <form method="post" action="prontuarios.php">
          
          <center>
            <b>Tipo de Busca:</b>
            <br>
            <input type="radio" name="tabBusca" onclick="showNome();" value="nome" <?php if($_POST['tabBusca'] == 'nome' || empty($_POST['tabBusca'])){echo 'checked';}?>/> Por Nome &nbsp;
            <input type="radio" name="tabBusca" onclick="showRG();" value="rg" <?php if($_POST['tabBusca'] == 'rg'){echo 'checked';}?>/> Por RG
          </center>

          <div class="input-group" id="divNOME" <?php if($_POST['tabBusca'] == 'nome' || empty($_POST['tabBusca'])){echo 'style="display: inline-table;"';}else{echo 'style="display: none;"';}?>>
            <span class="input-group-addon" id="basic-addon1">Nome do Paciente:</span>
            <input type="text" class="form-control" name="nomePaciente" id="nomePaciente" aria-describedby="basic-addon1" maxlength="150" value="<?php echo $_POST['nomePaciente']; ?>" pattern="([A-zÀ-ž\s]){2,}" title="Sr João da Silva Filho (Apenas Letras)">
          </div>

          <div class="input-group" id="divRG" <?php if($_POST['tabBusca'] == 'rg'){echo 'style="display: inline-table;"';}else{echo 'style="display: none;"';}?>>
            <span class="input-group-addon" id="basic-addon1">RG do Paciente:</span>
            <input type="number" class="form-control" name="rgPaciente" id="rgPaciente" aria-describedby="basic-addon1" maxlength="150" value="<?php echo $_POST['rgPaciente']; ?>">
          </div>

          <center>
            <button type="submit" class="btn btn-raised btn-info">Buscar Paciente</button> &nbsp;
            <a class="anchor" href="prontuarios.php">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
          </center>

          <br>

          <div class="form-group">
            <select name="idPaciente" class="form-control">
              <option disabled <?php if(empty($_POST['idPaciente'])){echo ' selected';} ?> value="">Nome do Paciente*</option>
              <?php        
                if(!empty($_POST['nomePaciente']) || !empty($_POST['rgPaciente'])){

                    $idUsuario = $_SESSION['idUsuario'];

                    if($_POST['nomePaciente'] != ""){
                      $busca = $_POST['nomePaciente'];

                      $select = $mysqli->query("SELECT * FROM pacientes WHERE nomePaciente LIKE '%$busca%'");

                    }elseif($_POST['rgPaciente'] != ""){
                      $busca = $_POST['rgPaciente'];

                      $select = $mysqli->query("SELECT * FROM pacientes WHERE RG = '$busca'");

                    }              
>>>>>>> consucloud-2/master
                  }
                  $row = $select->num_rows;
                  if($row){              
                    while($get = $select->fetch_array()){
<<<<<<< HEAD
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
      
=======
                ?>
              <option value="<?php echo $get['idPaciente']; ?>" <?php if(!empty($_POST['idPaciente']) && $_POST['idPaciente'] == $get['idPaciente']){echo ' selected';} ?>>
                <?php echo $get['RG'] . ' - ' . $get['nomePaciente']; ?>
              </option>
              <?php
                  }
                }
              ?>
            </select>
          </div>

          <center>
            <button type="submit" class="btn btn-raised btn-info">Buscar Prontuários</button>
          </center>
        </form>
      </div>

      <br>
      <br>

>>>>>>> consucloud-2/master
      <div class="panel-group" id="accordion">
        <?php
          if(!empty($_POST['idPaciente'])){
            
            $idUsuario = $_SESSION['idUsuario'];
<<<<<<< HEAD
            
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
=======
            $buscaPront = $_POST['idPaciente'];
            
            $select = $mysqli->query("SELECT p.nomePaciente, dataProntuario, horaProntuario, prontuario, idProntuario FROM prontuarios AS pront 
                                      JOIN pacientes AS p ON p.idPaciente = pront.paciente 
                                      WHERE p.idPaciente = '$buscaPront' AND pront.medico = $idUsuario ORDER BY dataProntuario ASC, horaProntuario ASC");

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
>>>>>>> consucloud-2/master
        ?>
      </div>

    </div>
  </div>

</body>

<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> consucloud-2/master
