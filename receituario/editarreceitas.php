<?php
session_start();

if(!$_SESSION["isMedico"] || empty($_SESSION["idUsuario"])){
  include("../componentes/redirect.php");
}

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

require($_SESSION["installFolder"]."componentes/db/connect.php");

$idReceita = trim(addslashes(strip_tags($_GET['editar'])));

$select = $mysqli->query("SELECT * FROM receitas WHERE idReceita = $idReceita");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    $medico = $get['medico'];
    $paciente = $get['paciente'];
    $dataReceita = $get['dataReceita'];
    $horaReceita = $get['horaReceita'];
    $nomeReceita = $get['nomeReceita'];
    $receita = $get['receita'];
  }
}

if(stripos($_SERVER["HTTP_USER_AGENT"], 'Firefox') !== false) {$dataConsulta = date("d/m/Y", strtotime($dataConsulta));}
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
        <small>Editar Receitas</small>
        <a href="receitas.php">
          <button class="btn btn-raised btn-danger pull-right" onClick="return confirm('Tem certeza que deseja sair?')">CANCELAR EDIÇÃO</button>
        </a>
      </h1>
      
      <br>
      <div class="cadastro">

        <form method="post" action="editar.php">

          <div class="form-group">
            <select required name="paciente" class="form-control">
              <option disabled>Nome do Paciente</option>
              <?php        
                $select = $mysqli->query("SELECT * FROM pacientes WHERE idPaciente = $paciente");
                  $row = $select->num_rows;
                  if($row){              
                    while($get = $select->fetch_array()){
                ?>
              <option value="<?php echo $get['idPaciente'];?>" selected>
                <?php echo $get['RG'] . " - " . $get['nomePaciente']; ?>
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
                <span class="input-group-addon" id="basic-addon1">Data do Cadastro da Receita:*</span>
                <input required type="date" class="form-control" name="dataReceita" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)" value="<?php echo $dataReceita; ?>">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Hora do Cadastro da Receita:*</span>
                <input required type="time" class="form-control" name="horaReceita" aria-describedby="basic-addon1" maxlength="5" OnKeyPress="formatar('##:##', this)" value="<?php echo $horaReceita; ?>">
              </div>
            </div>
          </div>

          <p>
            <div class="form-group">
              <select required name="medico" class="form-control">
                <option disabled>Médico Prescritor*</option>
                <?php        
                  $select = $mysqli->query("SELECT * FROM usuarios WHERE tipoUsuario = 'Medico'");
                  $row = $select->num_rows;
                    if($row){              
                      while($get = $select->fetch_array()){
                  ?>
                <option value="<?php echo $get['idUsuario'] . '" '; if($medico == $get['idUsuario']){echo 'selected';}?>><?php echo $get['nomeCompleto']; ?></option>
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
              <input required type="text" class="form-control" name="nomeReceita" aria-describedby="basic-addon1" maxlength="250" placeholder="Um nome curto para descrever a receita: Receita de Gláucio Silva ou Receita de Oxalato de Escitalopram" value="<?php echo $nomeReceita; ?>">
            </div>
          </p>

          <br>
      
          <span class="input-group-addon" style="text-align: left;" id="basic-addon1">Receita:*</span>
          <textarea required style="border-style: groove; border-width: 1px;" name="receita" id="receita" class="form-control" rows="10" cols="70" wrap="hard"><?php echo $receita; ?></textarea>
      
          <br>
        
          <input type="hidden" name="idReceita" value="<?php echo $idReceita; ?>">

          <center>
            <button type="submit" class="btn btn-raised btn-primary btn-lg">SALVAR EDIÇÃO</button>
          </center>

        </form>

      </div>
    </div>
  </div>

  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/slicer.js"></script>

</body>

</html>