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
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/maskFormat.js"></script>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/tabBusca.js"></script>

  <script>
  function loadDados(id)
  {
    $.post('<?php echo $_SESSION["installAddress"]; ?>componentes/getPacienteData.php',{idPaciente: id},function(data){
      dadosPaciente.innerHTML = "<strong>Dados do Paciente:</strong> <br>" + data;
    });
  }
</script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>
  
  <div class="container">
    <div class="jumbotron">
      <h1>
        <small>Cadastrar Prontuário</small>
        
        <?php
          if($_SESSION['WIZARD_start']){
            echo '<a href="'.$_SESSION["installAddress"].'wizards/cancelarWizard.php">
                    <button class="btn btn-raised btn-danger pull-right" onClick="return confirm("Tem certeza?")">CANCELAR MODO GUIADO</button>
                  </a>
                  <br>
                  <a href="'.$_SESSION["installAddress"].'exames/cadastrarexames.php">
                    <button class="btn btn-raised btn-danger pull-right" onClick="return confirm("Tem certeza?")">PULAR PRONTUÁRIO</button>
                  </a>';
          }else{
            echo '<a href="prontuarios.php">
                    <button class="btn btn-raised btn-danger pull-right" onClick="return confirm("Tem certeza que deseja sair?")">CANCELAR CADASTRO</button>
                  </a>';
          }
        ?>
      </h1>
      <br>

      <div class="buscar">
        <form method="post" action="cadastrarprontuarios.php">

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

          <br>

          <center class="submitBusca">
            <button type="submit" class="btn btn-raised btn-info">Buscar Paciente</button> &nbsp;
            <a class="anchor" href="cadastrarprontuarios.php">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
          </center>
        </form>
      </div>

      <form method="post" action="cadastrar.php">

        <div class="form-group">
          <select required name="paciente" class="form-control" onChange="loadDados(this.value);">
            <option disabled selected value="">Nome do Paciente*</option>
            <?php
              if(!empty($_POST)){

                  $idUsuario = $_SESSION['idUsuario'];

                  if($_POST['nomePaciente'] != ""){
                    $busca = trim(addslashes(strip_tags($_POST['nomePaciente'])));

                    $select = $mysqli->query("SELECT * FROM pacientes WHERE nomePaciente LIKE '%$busca%'");

                  }elseif($_POST['rgPaciente'] != ""){
                    $busca = trim(addslashes(strip_tags($_POST['rgPaciente'])));

                    $select = $mysqli->query("SELECT * FROM pacientes WHERE RG = '$busca'");

                  }
                }
            
              if($_SESSION['WIZARD_start']){
                $wizardPaciente = $_SESSION['WIZARD_start'];
                $select = $mysqli->query("SELECT * FROM pacientes WHERE idPaciente = '$wizardPaciente'");
              }

                $row = $select->num_rows;
                if($row){              
                  while($get = $select->fetch_array()){
            ?>
            <option value="<?php echo $get['idPaciente']; ?>" <?php if($_SESSION['WIZARD_start']){echo 'selected';}?>>
              <?php echo $get['RG'] . ' - ' . $get['nomePaciente']; ?>
            </option>
            <?php
                }
              }
            ?>
          </select>
        </div>

        <div id="dadosPaciente"></div>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Data da Consulta:*</span>
          <input required type="date" class="form-control" name="dataProntuario" aria-describedby="basic-addon1" maxlength="10" max="9999-12-31"
            OnKeyPress="formatar('##/##/####', this)" value="<?php echo $_SESSION['WIZARD_data']; ?>">
        </div>

        <br>

        <div class="form-group">
          <label id="prontuario">Prontuário</label>
          <textarea required name="prontuario" class="form-control" rows="10"></textarea>
        </div>

        <br>

        <center>
          <button type="submit" class="btn btn-raised btn-primary btn-lg">SALVAR PRONTUÁRIO</button>
        </center>

      </form>

    </div>
  </div>

</body>

</html>