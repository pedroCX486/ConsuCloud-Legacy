<?php
session_start();

if($_SESSION["isMedico"] || empty($_SESSION["idUsuario"])){
  include("../componentes/redirect.php");
}

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

require($_SESSION["installFolder"]."componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Pacientes - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/tabBusca.js"></script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Pacientes</h1>

      <div class="container">
        <a class="anchor" href="cadastrarpacientes.php">
          <button class="btn btn-raised btn-success pull-right">CADASTRAR NOVO PACIENTE</button>
        </a>
        <button type="button" class="btn btn-info btn-raised pull-left" data-toggle="collapse" data-target="#filtros">FILTRAR PACIENTES</button>

        <br>
        <br>
        <br>

        <div id="filtros" class="collapse <?php if(!empty($_POST['rgPaciente']) || !empty($_POST['nomePaciente'])){echo ' in';}?>">

          <p>Filtrar pacientes:</p>

          <div class="buscar">
            <form method="post" action="pacientes.php">

              <center>
                <b>Tipo de Busca:</b>
                <br>
                <input type="radio" name="tabBusca" onClick="showNome();" value="nome" <?php if($_POST['tabBusca'] == 'nome' || empty($_POST['tabBusca'])){echo 'checked';}?>/> Por Nome &nbsp;
                <input type="radio" name="tabBusca" onClick="showRG();" value="rg" <?php if($_POST['tabBusca'] == 'rg'){echo 'checked';}?>/> Por RG
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
                <a class="anchor" href="pacientes.php">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
              </center>
              
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
                <button type="submit" class="btn btn-raised btn-info">SELECIONAR PACIENTE</button> &nbsp;
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
                $buscaPaciente = trim(addslashes(strip_tags($_POST['idPaciente'])));
              
                $select = $mysqli->query("SELECT * FROM pacientes WHERE idPaciente = '$buscaPaciente'");
              
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
              <a class="anchor" href="editarpacientes.php?idPaciente=<?php echo $get['idPaciente']; ?>" title="Editar Paciente">
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