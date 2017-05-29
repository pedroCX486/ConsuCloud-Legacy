<?php
session_start();
$idUsuario = $_SESSION['idUsuario'];

if($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}elseif(empty($_SESSION)){
  header("Location: ../logout.php");
  exit();
}

require("../assets/connect.php");

$select = $mysqli->query("SELECT * FROM usuarios WHERE idUsuario = '$idUsuario'");
$row = $select->num_rows;
if($row){
  while($get = $select->fetch_array()){
    $nomeCompleto = $get['nomeCompleto'];
    $areaAtuacao = $get['areaAtuacao'];
    $estado = $get['endereco_estado'];
    $crm = $get['crm'];
  }
}

$select1 = $mysqli->query("SELECT * FROM configs");
$row1 = $select1->num_rows;
if($row1){
  while($get1 = $select1->fetch_array()){
    $nomeConsultorio = $get1['nomeConsultorio'];
    $telefone = $get1['telefone'];
    $email = $get1['email'];
    $logotipo = $get1['logotipo'];
    $endereco_logradouro = $get1['endereco_logradouro'];
    $endereco_numero = $get1['endereco_numero'];
    $endereco_complemento = $get1['endereco_complemento'];
    $endereco_bairro = $get1['endereco_bairro'];
    $endereco_cidade = $get1['endereco_cidade'];
    $endereco_cep = $get1['endereco_cep'];
    $endereco_estado = $get1['endereco_estado'];

    $mysqli->close();
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <?php include "../assets/bootstrap.php";?>
  <style>
    @page { size: A4 landscape; margin: 3mm; }
    html, body { height: 100%; width: 100%; margin: 0; }
  </style>

<body>
  
  <div style="border-style: solid; border-width: 1px; height: 100%; width: 50%">

  <!--Cabeçallho-->
  <div style="position: relative; height: 80px;">
    <div>
      <img style="width: 12%; height: 12%; margin-left: 10px; margin-top: 15px;" align="left" src="../config/<?php echo $logotipo; ?>"/>
    </div>
    
    <div style="position: absolute; left: 15%; top: 5%;">
      <div style="font-size: 35px;">Dr. <?php echo $nomeCompleto; ?></div>
      <?php echo $areaAtuacao . ' - CRM-' . $estado . ": " .  $crm; ?>
    </div>
  </div>
  
  <!--Corpo-->
  <div style="position: relative; height: 165mm;">
    <div style="position: absolute; height: 163mm">
      <div style="margin-left: 10px; height: 100%; border-left: 3px solid; border-color: #8c8c8c;"></div>
    </div>
    
    <div style="margin-left: 20px;">
      <br>
      <?php echo nl2br($_POST["receita"]); ?>
    </div>
  </div>
  
  <!--Rodapé-->
  <div style="position: relative;">
    <div style="position: absolute; text-align: left; vertical-align: bottom; margin-left: 10px;">
      <?php echo $nomeConsultorio . " - " . $endereco_logradouro . ", " . $endereco_numero . " - " . $endereco_complemento . " - CEP: " . $endereco_cep . "<br>" . $endereco_bairro . " - " . $endereco_cidade ." - " . $endereco_estado . "<br>" . "Telefones: " . $telefone; ?>
    </div>
  </div>
  
  </div>
  
  <!--JS para Invocar Impressão-->
  <script type="text/JavaScript">
    $(window).bind("load", function() {
      window.print();
      window.top.close();
    });
  </script>

</body>

</html>