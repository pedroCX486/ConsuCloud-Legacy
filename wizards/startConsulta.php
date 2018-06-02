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
  <title>Consulta Guiada - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/maskFormat.js"></script>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/tabBusca.js"></script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>
  
  <div class="container">
    <div class="jumbotron">
      <h1>
        <small>Consulta Guiada</small>
        <a href="<?php echo $_SESSION["installAddress"];?>dashboards/dashboard.php">
          <button class="btn btn-raised btn-danger pull-right" onClick="return confirm('Tem certeza que deseja sair?')">CANCELAR CONSULTA</button>
        </a>
      </h1>
      <br>

      <div class="buscar">
        <form method="post" action="startConsulta.php">

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

          <center>
            <button type="submit" class="btn btn-raised btn-info">Buscar Paciente</button> &nbsp;
            <a class="anchor" href="cadastrarprontuarios.php">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
          </center>
        </form>
      </div>

      <form method="post" action="iniciarWizard.php?firstLaunch=true">

        <div class="form-group">
          <select required name="paciente" class="form-control">
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

                $row = $select->num_rows;
                if($row){              
                  while($get = $select->fetch_array()){
            ?>
            <option value="<?php echo $get['idPaciente']; ?>">
              <?php echo $get['RG'] . ' - ' . $get['nomePaciente']; ?>
            </option>
            <?php
                }
              }
            ?>
          </select>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Data da Consulta:*</span>
              <input required type="date" class="form-control" name="dataConsulta" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10"
                OnKeyPress="formatar('##/##/####', this)" value="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Hora da Consulta:*</span>
              <input required type="time" class="form-control" name="horaConsulta" aria-describedby="basic-addon1" maxlength="5" OnKeyPress="formatar('##:##', this)" value="<?php echo date('H:i'); ?>">
            </div>
          </div>
        </div>

        <br>

        <center>
          <button type="submit" class="btn btn-raised btn-primary btn-lg">INICIAR CONSULTA</button>
        </center>

      </form>

    </div>
  </div>

</body>

</html>