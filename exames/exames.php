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
  <title>Exames - ConsuCloud</title>

<<<<<<< HEAD
   <?php include "../componentes/boot.php";?>
</head>

<body>

<?php include "../componentes/barra.php"; ?>
=======
  <?php include "../componentes/boot.php";?>
  <script src="../componentes/tabBusca.js"></script>
</head>

<body>
  
  <?php include "../componentes/barra.php"; ?>
>>>>>>> consucloud-2/master

  <div class="container">
    <div class="jumbotron">

      <h1>Exames</h1>
<<<<<<< HEAD
      <a href="cadastrarexames.php"><button class="btn btn-raised btn-success pull-right">Novo Exame</button></a>
=======
      <a class="anchor" href="cadastrarexames.php">
        <button class="btn btn-raised btn-success pull-right">NOVO EXAME</button>
      </a>
>>>>>>> consucloud-2/master

      <p>Consultar exame:</p>

      <div class="buscar">
        <form method="post" action="exames.php">
<<<<<<< HEAD
        
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Nome do Paciente:</span>
          <input type="text" class="form-control" name="nomePaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos." value="<?php echo $_POST['nomePaciente']; ?>">
        </div>
        
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">RG do Paciente:</span>
          <input type="number" class="form-control" name="rgPaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos." value="<?php echo $_POST['rgPaciente']; ?>">
        </div>
        
        <center><button type="submit" class="btn btn-raised btn-info">Buscar Paciente</button> &nbsp; <a href="exames.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></center>

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
            <a class="anchor" href="exames.php">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
          </center>

          <br>

          <div class="form-group">
            <select name="idPaciente" class="form-control">
              <option disabled selected value="">Nome do Paciente*</option>
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

          <center><button type="submit" class="btn btn-raised btn-info">Buscar Exames</button></center>
        </form>
      </div>

      <br><br>

      
      <div class="panel-group" id="accordion">
        <?php
        if(!empty($_POST['idPaciente'])){
        if($_POST['nomePaciente'] != ""){
            $busca = $_POST['nomePaciente'];
            
            $select = $mysqli->query("SELECT p.nomePaciente, idExame, medico, paciente, dataExame, nomeExame, descExame, arqsExame FROM exames AS ex 
                                    JOIN pacientes AS p ON p.idPaciente = ex.paciente 
                                    WHERE p.nomePaciente = '$busca' ORDER BY dataExame ASC");
          }elseif($_POST['rgPaciente'] != ""){
            $busca = $_POST['rgPaciente'];
            
            $select = $mysqli->query("SELECT p.nomePaciente, idExame, medico, paciente, dataExame, nomeExame, descExame, arqsExame FROM exames AS ex 
                                    JOIN pacientes AS p ON p.idPaciente = ex.paciente 
                                    WHERE p.RG = $busca ORDER BY dataExame ASC");
          }else{
            $busca1 = $_POST['rgPaciente'];
            $busca2 = $_POST['nomePaciente'];
            
            $select = $mysqli->query("SELECT p.nomePaciente, idExame, medico, paciente, dataExame, nomeExame, descExame, arqsExame FROM exames AS ex 
                                    JOIN pacientes AS p ON p.idPaciente = ex.paciente 
                                    WHERE p.RG = $busca1 AND p.nomePaciente = '$busca2' ORDER BY dataExame ASC");
          }
          $row = $select->num_rows;
          if($row){
            while($get = $select->fetch_array()){
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $get['idExame'];?>">
                      <?php
                        echo $get['nomePaciente'] . ' - ' . $get['nomeExame']  . ' (' . $data = date('d-m-Y', strtotime($get['dataExame'])) . ')';
                      ?> ▾
                    </a>
                  </h4>
                </div>
                <div id="<?php echo $get['idExame'];?>" class="panel-collapse collapse">
                  <div class="panel-body">
                    <h4>Descrição do Exame:</h4>
                    
                    <?php echo nl2br($get['descExame']); ?>

                    <br><br>
                    
                    <h4>Arquivos do Exame:<br><h5>(clique para baixar)</h5></h4>

                    <?php
                    $arquivos = explode(",", $get['arqsExame']);
                      
                      foreach($arquivos as $arquivo){
                        $mimeType = mime_content_type('arquivos/' . $_POST['idPaciente'] . '/' . $arquivo);
                        $encodedFile = chunk_split(base64_encode(file_get_contents('arquivos/' . $_POST['idPaciente'] . '/' . $arquivo)));
                        
                        echo '<a href="data:'.$mimeType.';base64,'.$encodedFile.'" download="'.$arquivo.'" /> <img style="width: 3%; height: 3%" src="../assets/baixar.png" /> ' . $arquivo . '<br>';
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
            <button type="submit" class="btn btn-raised btn-info">Buscar Exames</button>
          </center>
        </form>
      </div>

      <br>
      <br>

      <div class="panel-group" id="accordion">
      <?php
        if(!empty($_POST['idPaciente'])){
            $buscaExame = $_POST['idPaciente'];
            
            $select = $mysqli->query("SELECT p.nomePaciente, idExame, medico, paciente, dataExame, nomeExame, descExame, arqsExame FROM exames AS ex 
                                    JOIN pacientes AS p ON p.idPaciente = ex.paciente 
                                    WHERE p.idPaciente = '$buscaExame' ORDER BY dataExame ASC");
        
        $row = $select->num_rows;
        if($row){
          while($get = $select->fetch_array()){
      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $get['idExame'];?>">
              <?php
                  echo $get['nomePaciente'] . ' - ' . $get['nomeExame']  . ' (' . $data = date('d-m-Y', strtotime($get['dataExame'])) . ')';
              ?> ▾
            </a>
          </h4>
        </div>
        <div id="<?php echo $get['idExame'];?>" class="panel-collapse collapse">
          <div class="panel-body">
            <h4>Descrição do Exame:</h4>

            <?php echo nl2br($get['descExame']); ?>

            <br>
            <br>

            <h4>Arquivos do Exame:
              <br>
              <h5>(clique para baixar)</h5>
            </h4>

            <?php
              $arquivos = explode(",", $get['arqsExame']);
                
              foreach($arquivos as $arquivo){
                
                echo '<a class="anchor" target="_blank" href="../componentes/contentdelivery.php?arquivo=' . $arquivo . '&paciente=' . $_POST['idPaciente'] . '"> <img style="width: 3%; height: 3%" src="../assets/baixar.png" /> ' . $arquivo . '<br>';
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
>>>>>>> consucloud-2/master
      </div>

    </div>
  </div>

</body>

<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> consucloud-2/master
