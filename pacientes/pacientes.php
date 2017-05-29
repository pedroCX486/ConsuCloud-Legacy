<?php
require("../assets/connect.php");

session_start();

if($_SESSION["isMedico"] == true || !$_SESSION){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../logout.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Pacientes - ConsuCloud</title>
  
  <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

    <div class="container">
      <div class="jumbotron">

        <h1>Pacientes</h1>

        <a href="cadastrarpacientes.php"><button class="btn btn-raised btn-success pull-right">CADASTRAR NOVO PACIENTE</button></a>

        <p>Pacientes cadastrados:</p>

        <br><br>

        <center>
          <table id="rcorners1" class="tg">
            <tr>
              <b>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">RG</th>
            <th class="titulos">NASCIMENTO</th>
            <th class="titulos">EMAIL</th>
            </b>
            </tr>
            <?php
              $select = $mysqli->query("SELECT * FROM pacientes");
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
                  <a href="editarpacientes.php?idPaciente=<?php echo $get['idPaciente']; ?>" title="Editar Paciente"><span class="glyphicon glyphicon-pencil" aria-hidden="true" /></a>
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