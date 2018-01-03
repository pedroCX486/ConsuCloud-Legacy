<?php
session_start();

require($_SERVER['DOCUMENT_ROOT']."/componentes/sessionbuster.php");

$idUsuario = $_SESSION['idUsuario'];

if(!$_SESSION["isMedico"]){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
 }elseif(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}

require($_SERVER['DOCUMENT_ROOT']."/componentes/db/connect.php");

$select = $mysqli->query("SELECT conf.nomeConsultorio, conf.telefone, conf.email, conf.endereco_logradouro, conf.endereco_numero, conf.endereco_complemento,
                          conf.endereco_bairro, conf.endereco_cidade, conf.endereco_cep, conf.endereco_estado AS consultorioEstado, areaAtuacao, nomeCompleto, u.endereco_estado, crm FROM usuarios AS u 
                          JOIN configs AS conf
                          WHERE idUsuario = $idUsuario");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    
    //Informações do Médico
    $areaAtuacao = $get['areaAtuacao'];
    $nomeCompleto = $get['nomeCompleto'];
    $estado = $get['endereco_estado'];
    $crm = $get['crm'];
    
    //Informações de Consultório
    $nomeConsultorio = $get['nomeConsultorio'];
    $telefone = $get['telefone'];
    $email = $get['email'];
    $endereco_logradouro = $get['endereco_logradouro'];
    $endereco_numero = $get['endereco_numero'];
    $endereco_complemento = $get['endereco_complemento'];
    $endereco_bairro = $get['endereco_bairro'];
    $endereco_cidade = $get['endereco_cidade'];
    $endereco_cep = $get['endereco_cep'];
    $endereco_estado = $get['consultorioEstado'];
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Receituário - ConsuCloud</title>

  <?php include $_SERVER['DOCUMENT_ROOT']."/componentes/boot.php";?>
</head>

<body>

  <div>

    <div class="container">
      <div class="jumbotron">
        <h1>Receituário</h1>
        <br>
        <p>

          <!-- Ele vai fazer uma query aqui e puxar info do médico e info do consultório das configs do sistema. Mesma coisa na página de impressão.-->
          <div id="infocheck">
            <b>Informações do Médico:</b>
            <br> Dr.
            <?php echo $nomeCompleto . ' - ' . $areaAtuacao . ' - '; ?> CRM -
            <?php echo $estado . ": " .  $crm; ?>
            <br>
            <br>
            <b>Informações do Consultório:</b>
            <?php echo "<br>" . $nomeConsultorio . " - " . $endereco_logradouro . ", " . $endereco_numero . " - " . $endereco_complemento . " - CEP: "
                                                          . $endereco_cep . " - " . $endereco_bairro . " - " . $endereco_cidade . " - " . $endereco_estado . " - " .  "Telefones: " . $telefone; ?>
          </div>

          <form action="imprimir.php" method="post" target="_blank">
            <textarea required style="border-style: groove; border-width: 1px;" name="receita" id="receita" class="form-control" rows="10"
              cols="70" wrap="hard"></textarea>
            <br>
            <center>
              <button type="submit" class="btn btn-raised btn-primary btn-lg">IMPRIMIR</button>
            </center>
          </form>

        </p>
        <br>
      </div>
    </div>

  </div>

  <script src="../componentes/slicer.js"></script>

</body>

</html>