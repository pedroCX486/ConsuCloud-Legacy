<?php
session_start();

require($_SERVER['DOCUMENT_ROOT']."/componentes/sessionbuster.php");

if(!$_SESSION["isAdmin"] || empty($_SESSION)){
  echo "<script>top.window.location = '".$_SESSION["installAddress"]."index.php?erro=ERROFATAL'</script>";
  die;
}

require($_SERVER['DOCUMENT_ROOT']."/componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Logs - ConsuCloud</title>

  <?php include $_SERVER['DOCUMENT_ROOT']."/componentes/boot.php";?>
  
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/maskFormat.js"></script>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/tooltip.js"></script>
</head>

<body>
  
  <?php include $_SERVER['DOCUMENT_ROOT']."/componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Registro de Logs</h1>

      <div class="container">
        <button type="button" class="btn btn-info btn-raised pull-left" data-toggle="collapse" data-target="#filtros">FILTRAR LOGS</button>

        <br>
        <br>
        <br>

        <div id="filtros" class="collapse<?php if(!empty($_POST)){echo ' in';} ?>">

          <div class="buscar">
            <form method="post" action="logs.php">

              <div class="form-group">
                <select name="usuario" class="form-control">
                  <option disabled <?php if(empty($_POST)){echo "selected";} ?> value="">Nome de Usuário (Opcional)</option>
                  <?php        
                    $select = $mysqli->query("SELECT DISTINCT usuario FROM logs ORDER BY usuario ASC");
                    $row = $select->num_rows;
                    if($row){              
                      while($get = $select->fetch_array()){
                  ?>
                  <option <?php if(!empty($_POST) && $_POST['usuario'] == $get['usuario']){echo "selected";}?> value="<?php echo $get['usuario']; ?>">
                    <?php echo $get['usuario']; ?>
                  </option>
                  <?php
                        }
                      }
                  ?>
                </select>
              </div>

              <?php
                $dataInicio = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataInicio'])))));
                $dataFim = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataFim'])))));
                
                if($dataFim < $dataInicio && !empty($dataFim)){
                    echo '<div class="alert alert-warning" id="rcorners2" role="alert"><b>Data Inicial não pode ser menor que Data Final!</b></div>';
                }
                
                if(!empty($dataInicio)){
                  $dataInicio = date('Y-m-d',$dataInicio);
                }
              
                if(!empty($dataFim)){
                  $dataFim = date('Y-m-d',$dataFim);
                }
              ?>

              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Data Inicial:</span>
                <input value="<?php echo $dataInicio ?>" type="date" class="form-control" name="dataInicio" aria-describedby="basic-addon1"
                  max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
              </div>

              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Data Final:</span>
                <input value="<?php echo $dataFim ?>" type="date" class="form-control" name="dataFim" aria-describedby="basic-addon1" max="9999-12-31"
                  maxlength="10" OnKeyPress="formatar('##/##/####', this)">
              </div>

              <br>

              <center>
                <button type="submit" class="btn btn-raised btn-info">Filtrar</button> &nbsp;
                <a class="anchor" href="logs.php">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
              </center>

            </form>

            <br>

          </div>
        </div>

        <center>
          <div id="rcorners1" style="overflow-y: scroll; height: 400px; width: 80%; ">
            <table class="tg table-hover">
              <tr>
                <th class="titulos">LOG</th>
                <th class="titulos">USUÁRIO</th>
                <th class="titulos">IP</th>
                <th class="titulos">DIA</th>
                <th class="titulos">HORA</th>
                </b>
              </tr>
              <?php
                if(!empty($_POST)){
                    
                  $usuario = $_POST['usuario'];
                  $dataInicio = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataInicio'])))));
                  
                  $dataFim = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataFim'])))));
                  
                  if(!empty($dataInicio)){
                    $dataInicio = date('Y-m-d',$dataInicio);
                  }
                
                  if(!empty($dataFim)){
                    $dataFim = date('Y-m-d',$dataFim);
                  }
                    
                  if($usuario != "" && $dataInicio != "" && $dataFim != ""){
                    $select = $mysqli->query("SELECT * FROM logs WHERE dataLog BETWEEN '$dataInicio' AND '$dataFim' AND usuario = '$usuario' ORDER BY dataLog DESC, horaLog DESC");
                  }elseif($dataInicio != "" && $dataFim != ""){
                    $select = $mysqli->query("SELECT * FROM logs WHERE dataLog BETWEEN '$dataInicio' AND '$dataFim' ORDER BY dataLog DESC, horaLog DESC");
                  }elseif($usuario != "" && $dataInicio != ""){
                    $select = $mysqli->query("SELECT * FROM logs WHERE dataLog >= '$dataInicio' AND usuario = '$usuario' ORDER BY dataLog DESC, horaLog DESC");
                  }elseif($dataInicio != "" && $dataFim == ""){
                    $select = $mysqli->query("SELECT * FROM logs WHERE dataLog >= '$dataInicio' ORDER BY dataLog DESC, horaLog DESC");
                  }elseif($usuario != ""){
                    $select = $mysqli->query("SELECT * FROM logs WHERE usuario = '$usuario' ORDER BY dataLog DESC, horaLog DESC");
                  }
                }else{
                  $select = $mysqli->query("SELECT * FROM logs WHERE dataLog >= ( CURDATE() - INTERVAL 15 DAY ) ORDER BY dataLog DESC, horaLog DESC");
                }
                $row = $select->num_rows;
                if($row){
                  while($get = $select->fetch_array()){
              ?>
              <tr>
                <td class="tg-yw4l">
                  <?php echo $get['log']; ?>
                </td>
                <td class="tg-yw4l">
                  <?php echo $get['usuario']; ?>
                </td>
                <td class="tg-yw4l">
                  <?php echo $get['ip']; ?>
                </td>
                <td class="tg-yw4l">
                  <?php echo $data = date('d/m/Y', strtotime($get['dataLog'])); ?>
                </td>
                <td class="tg-yw4l">
                  <?php echo $get['horaLog']; ?>
                </td>
              </tr>
              <?php
                }
                  }else{echo '<b>Não existem registros de logs.</b>';}
              ?>
            </table>

          </div>
        </center>

        <br>
        <br>

        <form method="post" action="imprimirlogs.php" target="_blank">
          <center>
            <button type="submit" class="btn btn-raised btn-success">IMPRIMIR LOGS</button>
          </center>
          <input type="hidden" name="dataInicio" value="<?php echo $dataInicio; ?>">
          <input type="hidden" name="dataFim" value="<?php echo $dataFim; ?>">
          <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
        </form>

      </div>
    </div>

</body>

</html>