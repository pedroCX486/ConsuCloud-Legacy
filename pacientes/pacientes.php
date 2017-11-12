<?php
require("../componentes/db/connect.php");

session_start();

if($_SESSION["isMedico"]){
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
  <title>Pacientes - ConsuCloud</title>

  <?php include "../componentes/boot.php";?>
</head>

<body>

  <div class="container">
    <div class="jumbotron">

      <h1>Pacientes</h1>

      <div class="container">
        <a href="cadastrarpacientes.php">
          <button class="btn btn-raised btn-success pull-right">CADASTRAR NOVO PACIENTE</button>
        </a>
        <button type="button" class="btn btn-info btn-raised pull-left" data-toggle="collapse" data-target="#filtros">FILTRAR PACIENTES</button>

        <br>
        <br>
        <br>

        <div id="filtros<?php if(!empty($_POST)){echo ' in';} ?>" class="collapse">

          <p>Filtrar pacientes:</p>

          <div class="buscar">
            <form method="post" action="pacientes.php">

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
                <button type="submit" class="btn btn-raised btn-info">Filtrar</button> &nbsp;
                <a href="pacientes.php">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
              </center>
            </form>

          </div>
        </div>
      </div>

      <br>

      <p>Pacientes cadastrados:</p>

      <br>
      <br>

      <center>
        <table id="rcorners1" class="tg table-hover">
          <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">RG</th>
            <th class="titulos">NASCIMENTO</th>
            <th class="titulos">EMAIL</th>
            <th class="titulos"></th>
          </tr>
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
                
                $select = $mysqli->query("SELECT * FROM pacientes WHERE RG = '$busca1' and nomePaciente = '$busca2'");
              }
            }else{
              $select = $mysqli->query("SELECT * FROM pacientes");
            }
            $row = $select->num_rows;
            if($row){
              while($get = $select->fetch_array()){
          ?>
          <tr>
            <td class="tg-yw4l">
              <?php echo $get['nomePaciente']; ?>
            </td>
            <td class="tg-yw4l">
              <?php echo $get['RG']; ?>
            </td>
            <td class="tg-yw4l">
              <?php echo $data = date('d/m/Y', strtotime($get['dataNasc'])); ?>
            </td>
            <td class="tg-yw4l">
              <?php echo $get['email']; ?>
            </td>
            <td class="tg-yw4l">
              <a href="editarpacientes.php?idPaciente=<?php echo $get['idPaciente']; ?>" title="Editar Paciente">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true" />
              </a>
            </td>
          </tr>
          <?php
              }
            }else{echo '<b>Não existem pacientes cadastrados.</b>';}
          ?>
        </table>
      </center>

    </div>
  </div>

</body>

</html>