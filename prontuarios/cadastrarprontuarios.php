<?php
require("../componentes/db/connect.php");

session_start();

if(!$_SESSION["isMedico"]){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}elseif(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Prontuários - ConsuCloud</title>

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
        <small>Cadastrar Prontuário</small>
      </h1>
      <br>

      <div class="buscar">
        <form method="post" action="cadastrarprontuarios.php">

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

          <br>

          <center>
            <button type="submit" class="btn btn-raised btn-info">Buscar Paciente</button> &nbsp;
            <a href="cadastrarprontuarios.php">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
          </center>
        </form>
      </div>

      <form method="post" action="cadastrar.php">

        <div class="form-group">
          <select required name="paciente" class="form-control">
            <option disabled selected value="">Nome do Paciente*</option>
            <?php
            if(!empty($_POST)){
              
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

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Data da Consulta:*</span>
          <input required type="date" class="form-control" name="dataProntuario" aria-describedby="basic-addon1" maxlength="10" max="9999-12-31"
            OnKeyPress="formatar('##/##/####', this)">
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