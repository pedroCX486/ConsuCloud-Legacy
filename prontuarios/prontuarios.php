<?php
session_start();

if(!$_SESSION["isMedico"] || empty($_SESSION["idUsuario"])){
  include("../componentes/redirect.php");
}

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

require($_SESSION["installFolder"]."componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Prontuários - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/tabBusca.js"></script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Prontuários</h1>
      <a class="anchor" href="cadastrarprontuarios.php">
        <button class="btn btn-raised btn-success pull-right">NOVO PRONTUÁRIO</button>
      </a>

      <p>Consultar prontuário:</p>

      <div class="buscar">
        
        <form method="post" action="prontuarios.php">
          
          <center>
            <b>Tipo de Busca:</b>
            <br>
            <input type="radio" name="tabBusca" onclick="showNome();" value="nome" <?php if($_POST['tabBusca'] == 'nome' || empty($_POST['tabBusca'])){echo 'checked';}?>/> Por Nome &nbsp;
            <input type="radio" name="tabBusca" onclick="showRG();" value="rg" <?php if($_POST['tabBusca'] == 'rg'){echo 'checked';}?>/> Por RG
          </center>

          <div class="input-group" id="divNOME" <?php if($_POST['tabBusca'] == 'nome' || empty($_POST['tabBusca'])){echo 'style="display: inline-table;"';}else{echo 'style="display: none;"';}?>>
            <span class="input-group-addon" id="basic-addon1">Nome do Paciente:</span>
            <input type="text" class="form-control" name="nomePaciente" id="nomePaciente" aria-describedby="basic-addon1" maxlength="150" value="<?php echo trim(addslashes(strip_tags($_POST['nomePaciente']))); ?>" pattern="([A-zÀ-ž\s]){2,}" title="Sr João da Silva Filho (Apenas Letras)">
          </div>

          <div class="input-group" id="divRG" <?php if($_POST['tabBusca'] == 'rg'){echo 'style="display: inline-table;"';}else{echo 'style="display: none;"';}?>>
            <span class="input-group-addon" id="basic-addon1">RG do Paciente:</span>
            <input type="number" class="form-control" name="rgPaciente" id="rgPaciente" aria-describedby="basic-addon1" maxlength="150" value="<?php echo trim(addslashes(strip_tags($_POST['rgPaciente']))); ?>">
          </div>

          <center class="submitBusca">
            <button type="submit" class="btn btn-raised btn-info">BUSCAR PACIENTE</button> &nbsp;
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
                      $busca = trim(addslashes(strip_tags($_POST['nomePaciente'])));

                      $select = $mysqli->query("SELECT * FROM pacientes WHERE nomePaciente LIKE '%$busca%'");

                    }elseif($_POST['rgPaciente'] != ""){
                      $busca = trim(addslashes(strip_tags($_POST['rgPaciente'])));

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
            <button type="submit" class="btn btn-raised btn-info">BUSCAR PRONTUÁRIOS</button>
          </center>
        </form>
      </div>

      <br>
      <br>

      <div class="panel-group" id="accordion">
        <?php
          if(!empty($_POST['idPaciente'])){
            
            $idUsuario = $_SESSION['idUsuario'];
            $buscaPront = trim(addslashes(strip_tags($_POST['idPaciente'])));
            
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
        ?>
      </div>

    </div>
  </div>

</body>

</html>