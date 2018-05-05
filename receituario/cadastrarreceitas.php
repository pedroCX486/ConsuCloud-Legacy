<?php
session_start();

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

if(!$_SESSION["isMedico"] || empty($_SESSION)){
  echo "<script>top.window.location = '".$_SESSION["installAddress"]."index.php?erro=ERROFATAL'</script>";
  die;
}

require($_SESSION["installFolder"]."componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Receitas - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/maskFormat.js"></script>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/tabBusca.js"></script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>
  
  <div class="container">
    <div class="jumbotron">
      <h1>
        <small>Cadastrar Receitas</small>
        <a href="receitas.php">
          <button class="btn btn-raised btn-danger pull-right" onClick="return confirm('Tem certeza que deseja sair?')">CANCELAR CADASTRO</button>
        </a>
      </h1>
      
      <br>
      <div class="cadastro">

        <div class="buscar">
          <form method="post" action="cadastrarreceitas.php">

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
              <a class="anchor" href="cadastrarreceitas.php">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </a>
            </center>

          </form>
        </div>

        <form method="post" action="cadastrar.php">

          <div class="form-group">
            <select id="paciente" name="paciente" class="form-control">
              <option disabled selected value="">Nome do Paciente*</option>
              <?php
                if(!empty($_POST)){

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
              <option value="<?php echo $get['idPaciente']; ?>">
                <?php echo $get['RG'] . ' - ' . $get['nomePaciente']; ?>
              </option>
              <?php
                  }
                }
              ?>
            </select>
          </div>
          
          <div class="form-group">
            <select required name="tipoReceita" class="form-control">
              <option disabled selected value="">Tipo de Receita*</option>
              <option value="Receita de Medicação">Receita de Medicação</option>
              <option value="Receita de Paciente">Receita de Paciente</option>
              <option value="Atestado">Atestado</option>
            </select>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Data do Cadastro da Receita:*</span>
                <input required type="date" class="form-control" name="dataReceita" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10"
                  OnKeyPress="formatar('##/##/####', this)">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Hora do Cadastro da Receita:*</span>
                <input required type="time" class="form-control" name="horaReceita" aria-describedby="basic-addon1" maxlength="5" OnKeyPress="formatar('##:##', this)">
              </div>
            </div>
          </div>

          <p>
            <div class="form-group">
              <select required name="medico" class="form-control">
                <option disabled selected value="">Médico Prescritor*</option>
                <?php
                  $select = $mysqli->query("SELECT * FROM usuarios WHERE tipoUsuario = 'Medico'");
                  $row = $select->num_rows;
                    if($row){              
                      while($get = $select->fetch_array()){
                ?>
                <option value="<?php echo $get['idUsuario']; ?>"><?php echo $get['nomeCompleto']; ?></option>
                <?php
                    }
                  }
                ?>
              </select>
            </div>
          </p>

          <p>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Nome Descritivo da Receita:*</span>
              <input required type="text" class="form-control" name="nomeReceita" aria-describedby="basic-addon1" maxlength="250" placeholder="Um nome curto para descrever a receita: Receita de Gláucio Silva ou Receita de Oxalato de Escitalopram">
            </div>
          </p>

          <br>
      
          <span class="input-group-addon" style="text-align: left;" id="basic-addon1">Receita:*</span>
          <textarea required style="border-style: groove; border-width: 1px;" name="receita" id="receita" class="form-control" rows="10" cols="70" wrap="hard"></textarea>
      
          <br>

          <center>
            <button type="submit" class="btn btn-raised btn-primary btn-lg">CADASTRAR RECEITA</button>
          </center>

        </form>

      </div>
    </div>
  </div>

  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/slicer.js"></script>

</body>

</html>