<?php
session_start();
$crm = $_SESSION['CRM'];

if($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}elseif(empty($_SESSION)){
  header("Location: ../logout.php");
  exit();
}

require("../assets/connect.php");

$select = $mysqli->query("SELECT * FROM usuarios WHERE crm = '$crm'");
$row = $select->num_rows;
if($row){
  while($get = $select->fetch_array()){
    $nomeComp = $get['nomeComp'];
    $areaAtuacao = $get['areaAtuacao'];
    $estado = $get['endereco_estado'];
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
  <?php include "../assets/bootstrap.php";?>
  <style>
    table {
      border-style: solid;
      border-width: 1px;
      height: 210mm;
      width: 140mm;
    }
    @page {
      size: A4;
      margin: 3mm;
	    size: landscape;
    }
    html, body { height: 100%; width: 100%; margin: 0; }
  </style>
</head>

<body>

  <table>
    <tr style="height: 25mm;">
      <th>
        <p>
          <img style="width: 20%; height: 20%; margin-right: 20px;" align="right" src="../config/<?php echo $logotipo; ?>"/>
          <div style="font-size: 250%; text-align: left; margin-left: 20px;">Dr. <?php echo $nomeComp; ?></div>
          <div style="font-size: 80%; text-align: left; margin-left: 20px;"><?php echo $areaAtuacao . ' - CRM-' . $estado . ": " .  $_SESSION['CRM']; ?></div>
        </p>
      </th>
    </tr>
    <tr style="height: 130mm;">
      <th>
        <div style="margin-left:10px; padding: auto 0; border-left: 3px solid; border-color: #5fba7d;">
					<div style="margin-left: 10px;">
						<?php
							echo nl2br($_POST["prontuario"]);
						?>
					</div>
        </div>
      </th>
    </tr>
    <tr style="height: 10mm;">
      <th>
        <div style="font-size: 80%; text-align: left; margin-left: 20px; margin-bottom: 10px;"><?php echo "<br><br><br>" . $nomeConsultorio . " - " . $endereco_logradouro . ", " . $endereco_numero . " - " . $endereco_complemento . " - CEP: " . $endereco_cep . "<br>" . $endereco_bairro . " - " . $endereco_cidade ." - " . $endereco_estado . "<br>" . "Telefones: " . $telefone; ?></div>
      </th>
    </tr>
  </table>

  <script type="text/JavaScript">
    setTimeout(function () { window.print(); }, 500);
    setTimeout(window.close, 500);
  </script>

</body>

</html>
