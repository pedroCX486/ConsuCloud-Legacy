<?php
session_start();

if(!$_SESSION["isMedico"] || empty($_SESSION)){  
  if (file_exists('../index.php')){
    include("../componentes/installdir.php");
  }elseif(file_exists('../../index.php')){
    include("../../componentes/installdir.php");
  }elseif(file_exists('../../../index.php')){
    include("../../../componentes/installdir.php");
  }
  
  if(empty($installDir)){
      $installDir = "/";
      $installAddr = "https://".$_SERVER['HTTP_HOST'].$installDir;
    }else{
      $installAddr = "https://".$_SERVER['HTTP_HOST'].$installDir;
    }
  
  echo "<script>top.window.location = '".$installAddr."index.php?erro=ERROFATAL'</script>";
  die();
}

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

require($_SESSION["installFolder"]."componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Exames - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/tabBusca.js"></script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Exames</h1>
      <a class="anchor" href="cadastrarexames.php">
        <button class="btn btn-raised btn-success pull-right">NOVO EXAME</button>
      </a>

      <p>Consultar exame:</p>

      <div class="buscar">
        <form method="post" action="exames.php">

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

          <center class="submitBusca">
            <button type="submit" class="btn btn-raised btn-info">BUBSCAR PACIENTE</button> &nbsp;
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
                  }
                  $row = $select->num_rows;
                  if($row){              
                    while($get = $select->fetch_array()){
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
            <button type="submit" class="btn btn-raised btn-info">BUSCAR EXAMES</button>
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
                
                echo '<a class="anchor" target="_blank" href="'.$_SESSION["installAddress"].'componentes/contentdelivery.php?arquivo=' . $arquivo . '&paciente=' . $_POST['idPaciente'] . '"> <img style="width: 3%; height: 3%" src="<?php echo $_SESSION["installAddress"]; ?>assets/baixar.png" /> ' . $arquivo . '<br>';
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