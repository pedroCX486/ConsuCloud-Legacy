<?php
require("../componentes/db/connect.php");

session_start();

if($_SESSION["isMedico"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}

$idConsulta = trim(addslashes(strip_tags($_GET['editar'])));

$select = $mysqli->query("SELECT * FROM consultas WHERE idConsulta = $idConsulta");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    $medico = $get['medico'];
    $paciente = $get['paciente'];
    $dataConsulta = $get['dataConsulta'];
    $horaConsulta = $get['horaConsulta'];
    $planoConsulta = $get['planoConsulta'];
    $carteiraPlano = $get['carteiraPlano'];
    $tipoConsulta = $get['tipoConsulta'];
  }
}

if(stripos($_SERVER["HTTP_USER_AGENT"], 'Firefox') !== false) {$dataConsulta = date("d/m/Y", strtotime($dataConsulta));}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Consultas - ConsuCloud</title>
    
  <?php include "../componentes/boot.php";?>
</head>

<body>

<script>
      function formatar(mascara, documento) {
        var i = documento.value.length;
        var saida = mascara.substring(0, 1);
        var texto = mascara.substring(i)

        if (texto.substring(0, 1) != saida) {
          documento.value += texto.substring(0, 1);
        }

      }
    </script>

    <div class="container">
      <div class="jumbotron">
        <h1><small>Editar Consultas</small></h1><br>
        <div class="cadastro">

          <form method="post" action="editar.php">
		  
            <div class="form-group">
              <select required name="paciente" class="form-control">
                <option disabled >Nome do Paciente</option>
                  <?php        
                  $select = $mysqli->query("SELECT * FROM pacientes WHERE idPaciente = $paciente");
                    $row = $select->num_rows;
                    if($row){              
                      while($get = $select->fetch_array()){
                  ?>
                <option value="<?php echo $get['idPaciente'];?>" selected><?php echo $get['RG'] . " - " . $get['nomePaciente']; ?></option>
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
                  <input required type="date" class="form-control" name="dataConsulta" aria-describedby="basic-addon1" value="<?php echo $dataConsulta; ?>" max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Hora da Consulta:*</span>
                  <input required type="time" class="form-control" name="horaConsulta" aria-describedby="basic-addon1" value="<?php echo $horaConsulta = date("H:i", strtotime($horaConsulta)); ?>" maxlength="5" OnKeyPress="formatar('##:##', this)">
                </div>
              </div>
            </div>

            <p>
              <div class="form-group">
                <select required name="medico" class="form-control">
                  <option disabled>Médico da Consulta</option>
                    <?php        
                    $select = $mysqli->query("SELECT * FROM usuarios WHERE tipoUsuario = 'Medico'");
                    $row = $select->num_rows;
                      if($row){              
                        while($get = $select->fetch_array()){
                    ?>
                    <option value="<?php echo $get['idUsuario'] . '"'; if($medico == $get['idUsuario']){echo 'selected';}?>><?php echo $get['nomeCompleto']; ?></option>
                    <?php
                        }
                      }
                    ?>
                </select>
              </div>
            </p>

            <div class="form-group">
              <select required name="planoConsulta" class="form-control">
                <option disabled>Plano de Consulta</option>
                  <?php        
                  $select = $mysqli->query("SELECT * FROM planos");
                  $row = $select->num_rows;
                    if($row){              
                      while($get = $select->fetch_array()){
                  ?>
                <option value="<?php echo $get['idPlano'] . '"'; if($planoConsulta == $get['idPlano']){echo 'selected';}?>><?php echo $get['nomePlano']; ?></option>
                  <?php
                      }
                    }
                  ?>
              </select>
            </div>

            <p>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Número da Carteira do Plano:*</span>
                <input required type="text" class="form-control" name="carteiraPlano" aria-describedby="basic-addon1" maxlength="20" value="<?php echo $carteiraPlano; ?>">
              </div>
            </p>

            <div class="form-group">
              <select required name="tipoConsulta" class="form-control">
                <option disabled>Tipo de Consulta</option>
                <option value="primeiraConsulta" <?php if($tipoConsulta == 'primeiraConsulta'){echo 'selected';} ?>>Primeira Consulta</option>
                <option value="retorno" <?php if($tipoConsulta == 'retorno'){echo 'selected';} ?>>Retorno</option>
              </select>
            </div>

            <br>

            <input type="hidden" name="idConsulta" value="<?php echo $idConsulta; ?>">

            <center><button type="submit" class="btn btn-raised btn-primary btn-lg">ATUALIZAR CONSULTA</button></center>

          </form>

        </div>
      </div>
    </div>

  </body>

  </html>