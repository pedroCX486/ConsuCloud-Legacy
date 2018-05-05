<?php
session_start();

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

if(!$_SESSION["isMedico"] || empty($_SESSION)){
  echo "<script>top.window.location = '".$_SESSION["installAddress"]."index.php?erro=ERROFATAL'</script>";
  die;
}

$idUsuario = $_SESSION['idUsuario'];

require($_SESSION["installFolder"]."componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Receitas - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
</head>

<body>
	
	<?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      <h1>Receitas</h1>
      <a class="anchor" href="cadastrarreceitas.php">
        <button class="btn btn-raised btn-success pull-right">NOVA RECEITA</button>
      </a>

      <p>Consultar receita:</p>

      <div class="buscar">
        <form method="post" action="receitas.php">

          <center>
            <b>Tipo de Busca:</b>
            <br>
            <input type="radio" onClick="document.getElementById('contentBusca').placeholder = 'Digite o nome da medicação.';" name="tipoReceita" value="Receita de Medicação" <?php if($_POST['tipoReceita'] == 'Receita de Medicação' || empty($_POST['tipoReceita'])){echo 'checked';}?>/> Receitas de Medicação &nbsp;
	          <input type="radio" onClick="document.getElementById('contentBusca').placeholder = 'Digite o nome do paciente.';" name="tipoReceita" value="Receita de Paciente" <?php if($_POST['tipoReceita'] == 'Receita de Paciente'){echo 'checked';}?>/> Receitas de Paciente &nbsp;
            <input type="radio" onClick="document.getElementById('contentBusca').placeholder = 'Digite o nome do paciente.';" name="tipoReceita" value="Atestado" <?php if($_POST['tipoReceita'] == 'Atestado'){echo 'checked';}?>/> Atestado
            <br>
          </center>

          <div class="input-group" id="divBUSCA">
            <span class="input-group-addon" id="basic-addon1">Dados para busca:</span>
            <input required type="text" class="form-control" id="contentBusca" name="contentBusca" aria-describedby="basic-addon1" maxlength="150" value="<?php echo $_POST['contentBusca']; ?>" pattern="([0-9A-zÀ-ž\s]){2,}" title="Sr João da Silva Filho ou Oxalato de Escitalopram" placeholder="Digite o nome da medicação.">
          </div>

          <center>
            <button type="submit" class="btn btn-raised btn-info">BUSCAR RECEITAS</button> &nbsp;
            <a class="anchor" href="receitas.php">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
          </center>

          <br>

          <div class="form-group">
            <select name="idReceita" class="form-control">
              <option disabled <?php if(empty($_POST['idReceita'])){echo ' selected';} ?> value="">Receitas*</option>
              <?php
                if(!empty($_POST['contentBusca'])){

                    $idUsuario = $_SESSION['idUsuario'];

                    if($_POST['tipoReceita'] == 'Receita de Medicação'){
                      $busca = $_POST['contentBusca'];

                      $select = $mysqli->query("SELECT * FROM receitas WHERE tipoReceita = 'Receita de Medicação' AND receita LIKE '%$busca%' AND medico = '$idUsuario'");

                   }elseif($_POST['tipoReceita'] == "Receita de Paciente"){
                      $busca = $_POST['contentBusca'];

                      $select = $mysqli->query("SELECT p.nomePaciente AS nomePaciente, nomeReceita, idReceita, tipoReceita, dataReceita, horaReceita FROM receitas AS r 
                                                JOIN pacientes AS p ON p.idPaciente = r.paciente 
                                                JOIN usuarios AS u ON u.idUsuario = r.medico 
                                                WHERE p.nomePaciente LIKE '%$busca%' AND tipoReceita = 'Receita de Paciente' AND medico = '$idUsuario' ORDER BY dataReceita ASC, horaReceita ASC");

                    }elseif($_POST['tipoReceita'] == "Atestado"){
                      $busca = $_POST['contentBusca'];

                      $select = $mysqli->query("SELECT p.nomePaciente AS nomePaciente, nomeReceita, idReceita, tipoReceita, dataReceita, horaReceita FROM receitas AS r 
                                                JOIN pacientes AS p ON p.idPaciente = r.paciente 
                                                JOIN usuarios AS u ON u.idUsuario = r.medico 
                                                WHERE p.nomePaciente LIKE '%$busca%' AND tipoReceita = 'Atestado' AND medico = '$idUsuario' ORDER BY dataReceita ASC, horaReceita ASC");

                    }
                  }
                  $row = $select->num_rows;
                  if($row){              
                    while($get = $select->fetch_array()){
                ?>
              <option value="<?php echo $get['idReceita']; ?>" <?php if(!empty($_POST['nomeReceita']) && $_POST['nomeReceita'] == $get['nomeReceita']){echo ' selected';} ?>>
                <?php echo $get['nomeReceita'] . ' - ' . $get['nomePaciente'] . ' (' . $data = date('d-m-Y', strtotime($get['dataReceita'])) . ' ás ' . $get['horaReceita'] . ')'; ?>
              </option>
              <?php
                  }
                }
              ?>
            </select>
          </div>

          <center>
            <button type="submit" class="btn btn-raised btn-info">SELECIONAR RECEITA</button>
          </center>
        </form>
      </div>

      <br>
      <br>

      <div class="panel-group" id="accordion">
      <?php
        if(!empty($_POST['idReceita'])){
            $buscaReceita = $_POST['idReceita'];
            
            $select = $mysqli->query("SELECT * FROM receitas WHERE idReceita = '$buscaReceita' AND medico = '$idUsuario'");
        
        $row = $select->num_rows;
        if($row){
          while($get = $select->fetch_array()){
      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $get['idReceita'];?>">
              <?php
                  echo $get['nomeReceita'] . ' (' . $data = date('d-m-Y', strtotime($get['dataReceita']))  . ' ás ' . $get['horaReceita'] . ')';
              ?> ▾
            </a>
          </h4>
        </div>
        <div id="<?php echo $get['idReceita'];?>" class="panel-collapse collapse">
          <div class="panel-body">
            
             <a class="anchor" href="editarreceitas.php?editar=<?php echo $get['idReceita']; ?>">
              <button class="btn btn-raised btn-info pull-right">EDITAR RECEITA</button>
            </a>
            
            <a href="remover.php?remover=<?php echo $get['idReceita']; ?>">
              <button class="btn btn-raised btn-danger pull-right" onClick="return confirm('Tem certeza que deseja apagar esta receita?')">APAGAR RECEITA</button>
            </a>
            
            <h4>Receita:</h4>

            <?php echo nl2br($get['receita']); ?>

            <br>
            
            <a href="imprimir.php?receita=<?php echo $get['idReceita']; if(empty($get['paciente'])){echo "&noPaciente=true";}?>" target="_blank">
              <button class="btn btn-raised btn-primary btn-lg">IMPRIMIR RECEITA</button>
            </a>

          </div>
        </div>
      </div>
      <?php
            }
          }
        }
      ?>
      </div>
			
			<!--Listagem de Todas as Receitas -->
			
			<div class="panel-group" id="accordion">
      <?php
        if($_GET['todasReceitas'] == true){
            
            $select = $mysqli->query("SELECT * FROM receitas WHERE medico = '$idUsuario'");
        
        $row = $select->num_rows;
        if($row){
          while($get = $select->fetch_array()){
      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $get['idReceita'];?>">
              <?php
                  echo $get['nomeReceita'] . ' (' . $data = date('d-m-Y', strtotime($get['dataReceita']))  . ' ás ' . $get['horaReceita'] . ') - ' . $get['tipoReceita'];
              ?> ▾
            </a>
          </h4>
        </div>
        <div id="<?php echo $get['idReceita'];?>" class="panel-collapse collapse">
          <div class="panel-body">
            
             <a class="anchor" href="editarreceitas.php?editar=<?php echo $get['idReceita']; ?>">
              <button class="btn btn-raised btn-info pull-right">EDITAR RECEITA</button>
            </a>
            
            <a href="remover.php?remover=<?php echo $get['idReceita']; ?>">
              <button class="btn btn-raised btn-danger pull-right" onClick="return confirm('Tem certeza que deseja apagar esta receita?')">APAGAR RECEITA</button>
            </a>
            
            <h4>Receita:</h4>

            <?php echo nl2br($get['receita']); ?>

            <br>
            
            <a href="imprimir.php?receita=<?php echo $get['idReceita']; if(empty($get['paciente'])){echo "&noPaciente=true";}?>" target="_blank">
              <button class="btn btn-raised btn-primary btn-lg">IMPRIMIR RECEITA</button>
            </a>

          </div>
        </div>
      </div>
      <?php
            }
          }
        }
      ?>
      </div>
			
			<div>
				<a class="anchor" href="receitas.php?todasReceitas=true">
       		<button class="btn btn-raised btn-warning btn-sm">LISTAR TODAS AS RECEITAS</button>
      	</a>
			</div>

    </div>
  </div>

</body>

</html>