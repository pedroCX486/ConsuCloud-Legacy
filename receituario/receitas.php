<?php
session_start();

if(!$_SESSION["isMedico"] || empty($_SESSION["idUsuario"])){
  if (file_exists('../index.php')){
    include("../componentes/installdir.php");
  }elseif(file_exists('../../index.php')){
    include("../../componentes/installdir.php");
  }elseif(file_exists('../../../index.php')){
    include("../../../componentes/installdir.php");
  }
  
  if(empty($installDir)){
      $installDir = "/";
      $installAddr = "https://".$_SERVER['HTTP_HOST'].$installDir;
    }else{
      $installAddr = "https://".$_SERVER['HTTP_HOST'].$installDir;
    }
  
  echo "<script>top.window.location = '".$installAddr."index.php?erro=ERROFATAL'</script>";
  die();
}

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

$idUsuario = $_SESSION['idUsuario'];

require($_SESSION["installFolder"]."componentes/db/connect.php");

if(!empty($_GET['imprimirRedirect'])){
 echo '<script type="text/javascript">
         var ret = confirm("Deseja imprimir receita?");
         if(ret == true){
            window.open("'.$_SESSION["installAddress"].'receituario/imprimir.php?receita='.$_GET['imprimirRedirect'].'");
         }else{
            location.href="'.$_SESSION["installAddress"].'receituario/receitas.php";
         }
        </script>';
}
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

          <div class="input-group" id="divBUSCA">
            <span class="input-group-addon" id="basic-addon1">Dados para busca:</span>
            <input required type="text" class="form-control" id="contentBusca" name="contentBusca" aria-describedby="basic-addon1" maxlength="150" value="<?php echo $_POST['contentBusca']; ?>" pattern="([0-9A-zÀ-ž\s]){2,}" title="Sr João da Silva Filho ou Oxalato de Escitalopram" placeholder="Digite o nome da medicação ou do paciente.">
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
              <option disabled <?php if(empty($_POST['idReceita'])){echo ' selected';} ?> value="">Selecione uma receita...</option>
              <?php
                if(!empty($_POST['contentBusca'])){

                    $idUsuario = $_SESSION['idUsuario'];

                    $busca = $_POST['contentBusca'];

                    //Data: 06/05/2018
                    // Que fique marcado que eu fiquei rindo da gambiarra com CONCAT usada aqui.
                    $select = $mysqli->query("SELECT p.nomePaciente, idReceita, nomeReceita, medico, paciente, dataReceita, horaReceita, receita FROM receitas AS r
                                              JOIN pacientes AS p ON p.idPaciente = r.paciente 
                                              WHERE CONCAT (p.nomePaciente, ' ', nomeReceita, ' ', receita) LIKE '%$busca%' AND medico = '$idUsuario'");

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
            
            $select = $mysqli->query("SELECT p.nomePaciente, idReceita, nomeReceita, medico, paciente, dataReceita, horaReceita, receita FROM receitas AS r
                                      JOIN pacientes AS p ON p.idPaciente = r.paciente 
                                      WHERE idReceita = '$buscaReceita' AND medico = '$idUsuario'");
        
        $row = $select->num_rows;
        if($row){
          while($get = $select->fetch_array()){
      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $get['idReceita'];?>">
              <?php
                  echo $get['nomeReceita'] . ' (' . $data = date('d-m-Y', strtotime($get['dataReceita']))  . ' ás ' . $get['horaReceita'] . ') - ' . $get['nomePaciente'];
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
            
            <a href="imprimir.php?receita=<?php echo $get['idReceita'];?>" target="_blank">
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
            
            $select = $mysqli->query("SELECT p.nomePaciente, idReceita, nomeReceita, medico, paciente, dataReceita, horaReceita, receita FROM receitas AS r
                                      JOIN pacientes AS p ON p.idPaciente = r.paciente 
                                      WHERE medico = '$idUsuario'");
        
        $row = $select->num_rows;
        if($row){
          while($get = $select->fetch_array()){
      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $get['idReceita'];?>">
              <?php
                  echo $get['nomeReceita'] . ' (' . $data = date('d-m-Y', strtotime($get['dataReceita']))  . ' ás ' . $get['horaReceita'] . ') - ' . $get['nomePaciente'];
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
            
            <a href="imprimir.php?receita=<?php echo $get['idReceita'];?>" target="_blank">
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