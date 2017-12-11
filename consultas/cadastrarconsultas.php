<?php
session_start();

require("../componentes/sessionbuster.php");

if($_SESSION["isMedico"]){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;  
 }elseif(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}

require("../componentes/db/connect.php");
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
      <h1>
        <small>Cadastrar Consultas</small>
      </h1>
      <br>
      <div class="cadastro">

        <div class="buscar">
          <form method="post" action="cadastrarconsultas.php">

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Nome do Paciente:</span>
              <input type="text" class="form-control" name="nomePaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos."
                value="<?php echo $_POST['nomePaciente']; ?>">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">RG do Paciente:</span>
              <input type="number" class="form-control" name="rgPaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos."
                value="<?php echo $_POST['rgPaciente']; ?>">
            </div>

            <center>
              <button type="submit" class="btn btn-raised btn-info">Buscar Paciente</button> &nbsp;
              <a href="cadastrarconsultas.php">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </a>
            </center>

          </form>
        </div>

        <form method="post" action="cadastrar.php">

          <div class="form-group">
            <select name="paciente" class="form-control">
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
                  OnKeyPress="formatar('##/##/####', this)">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Hora da Consulta:*</span>
                <input required type="time" class="form-control" name="horaConsulta" aria-describedby="basic-addon1" maxlength="5" OnKeyPress="formatar('##:##', this)">
              </div>
            </div>
          </div>

          <p>
            <div class="form-group">
              <select required name="medico" class="form-control">
                <option disabled selected value="">Médico da Consulta*</option>
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

          <div class="form-group">
            <select required name="planoConsulta" class="form-control">
              <option disabled selected value="">Plano de Consulta*</option>
              <?php        
                $select = $mysqli->query("SELECT * FROM planos");
                $row = $select->num_rows;
                if($row){              
                  while($get = $select->fetch_array()){
              ?>
              <option value="<?php echo $get['idPlano']; ?>"><?php echo $get['nomePlano']; ?></option>
              <?php
                  }
                }
              ?>
            </select>
          </div>

          <p>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Número da Carteira do Plano:*</span>
              <input required type="text" class="form-control" name="carteiraPlano" aria-describedby="basic-addon1" maxlength="20" placeholder="Digite apenas números, sem pontos ou traços. Em caso de consulta particular, digite apenas o número 0 (ZERO).">
            </div>
          </p>

          <div class="form-group">
            <select required name="tipoConsulta" class="form-control">
              <option disabled selected value="">Tipo de Consulta*</option>
              <option value="primeiraConsulta">Primeira Consulta</option>
              <option value="retorno">Retorno</option>
            </select>
          </div>

          <br>

          <center>
            <button type="submit" class="btn btn-raised btn-primary btn-lg">CADASTRAR CONSULTA</button>
          </center>

        </form>

      </div>
    </div>
  </div>

</body>

</html>