<?php
session_start();
$crm = $_SESSION['CRM'];

if($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true || !$_SESSION){
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
    $areaAtuacao = $get['areaAtuacao'];
    $nomeComp = $get['nomeComp'];
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
    <meta charset="UTF-8">
    <title>Receituário - ConsuCloud</title>

  <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

    <div>

      <div class="container">
        <div class="jumbotron">
          <h1>Receituário</h1>
          <br>
          <p>

            <!-- Ele vai fazer uma query aqui e puxar info do médico e info do consultório das configs do sistema. Mesma coisa na página de impressão.-->
            <div id="infocheck">
              <b>Informações do Médico:</b><br> Dr.
              <?php echo $nomeComp . ' - ' . $areaAtuacao . ' - '; ?>  CRM -
              <?php echo $estado . ": " .  $_SESSION['CRM']; ?><br><br>
              <b>Informações do Consultório:</b>
              <?php echo "<br>" . $nomeConsultorio . " - " . $endereco_logradouro . ", " . $endereco_numero . " - " . $endereco_complemento . " - CEP: "
                                                          . $endereco_cep . " - " . $endereco_bairro . " - " . $endereco_cidade . " - " . $endereco_estado . " - " .  "Telefones: " . $telefone; ?>
            </div>

            <form action="imprimir.php" method="post" target="_blank">
              <textarea required style="border-style: groove; border-width: 1px;"name="prontuario" class="form-control" rows="10" cols="5" wrap="hard" maxlength="1632"></textarea>
              <br>
              <center><button type="submit" class="btn btn-raised btn-primary btn-lg">IMPRIMIR</button></center>
            </form>

          </p>
          <br>
        </div>
      </div>

    </div>
  </body>

  </html>