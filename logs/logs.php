<?php

session_start();

if($_SESSION["isSecretaria"] == true || $_SESSION["isMedico"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}

require "../componentes/db/connect.php";
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Logs - ConsuCloud</title>

   <?php include "../componentes/boot.php";?>
</head>

<body>

<?php include "../componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      
      <h1>Registro de Logs</h1>
      
        <div class="container">
          <button type="button" class="btn btn-info btn-raised pull-left" data-toggle="collapse" data-target="#filtros">FILTRAR LOGS</button>
          
          <br><br><br>
          
          <div id="filtros" class="collapse">
  
            <div class="buscar">
              <form method="post" action="logs.php">
      
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Nome de Usuário:</span>
                <input type="text" class="form-control" name="usuario" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional." value="<?php echo $_POST['usuario']; ?>">
              </div>
              
              <br>
              
              <center>
                <table>
                  <tr>
                    <th width="100px">Data Inicial:</th>
                    <td width="100px"><input type="number" min="1" max="31" class="form-control" name="diaInicio" placeholder="Dia" maxlength="2" value="<?php echo $_POST['diaInicio']; ?>"></td>
                    <td width="100px"><input type="number" min="1" max="12" class="form-control" name="mesInicio" placeholder="Mês" maxlength="2" value="<?php echo $_POST['mesInicio']; ?>"></td>
                    <td width="100px"><input type="number" min="1500" max="3999" class="form-control" name="anoInicio" placeholder="Ano" maxlength="4" value="<?php echo $_POST['anoInicio']; ?>"></td>
                  </tr>
                  <tr>
                    <th width="100px">Data Final:</th>
                    <td width="100px"><input type="number" min="1" max="31" class="form-control" name="diaFim" placeholder="Dia" maxlength="2" value="<?php echo $_POST['diaFim']; ?>"></td>
                    <td width="100px"><input type="number" min="1" max="12" class="form-control" name="mesFim" placeholder="Mês" maxlength="2" value="<?php echo $_POST['mesFim']; ?>"></td>
                    <td width="100px"><input type="number" min="1500" max="3999" class="form-control" name="anoFim" placeholder="Ano" maxlength="4" value="<?php echo $_POST['anoFim']; ?>"></td>
                  </tr>
                </table>
              </center>
      
              <br>
      
                <center><button type="submit" class="btn btn-raised btn-info">Filtrar</button> &nbsp; <a href="logs.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></center>
              </form>
              
              <br>
              
            </div>
          </div>
        </div>
      
       <center>
        <div id="rcorners1" style="overflow-y: scroll; height: 400px; width: 80%; ">
          <table class="tg">
            <tr>
              <b>
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
               $dataInicio = $_POST['anoInicio'] . '-' . $_POST['mesInicio'] . '-' . $_POST['diaInicio'];
               $dataFim = $_POST['anoFim'] . '-' . $_POST['mesFim'] . '-' . $_POST['diaFim'];
                
              if($usuario != "" && $dataInicio != "--" && $dataFim != "--"){
                $select = $mysqli->query("SELECT * FROM logs WHERE dataLog BETWEEN '$dataInicio' AND '$dataFim' AND usuario = '$usuario' ORDER BY dataLog DESC, horaLog DESC");
              }elseif($dataInicio != "--" && $dataFim != "--"){
                $select = $mysqli->query("SELECT * FROM logs WHERE dataLog BETWEEN '$dataInicio' AND '$dataFim' ORDER BY dataLog DESC, horaLog DESC");
              }elseif($usuario != "" && $dataInicio != "--"){
                $select = $mysqli->query("SELECT * FROM logs WHERE dataLog >= '$dataInicio' AND usuario = '$usuario' ORDER BY dataLog DESC, horaLog DESC");
              }elseif($dataInicio != "--" && $dataFim == "--"){
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
        
        <br><br>
        
        <form method="post" action="imprimirlogs.php" target="_blank">
        <center><button type="submit" class="btn btn-raised btn-success">IMPRIMIR LOGS</button></center>
          <input type="hidden" name="dataInicio" value="<?php echo $dataInicio; ?>">
          <input type="hidden" name="dataFim" value="<?php echo $dataFim; ?>">
          <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
        </form>

    </div>
  </div>

</body>

</html>