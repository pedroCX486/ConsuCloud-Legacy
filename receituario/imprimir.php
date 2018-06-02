<?php
session_start();

if(!$_SESSION["isMedico"] || empty($_SESSION)){
  echo "<script>top.window.location = '".$_SESSION["installAddress"]."index.php?erro=ERROFATAL'</script>";
  die();
}

$idUsuario = $_SESSION['idUsuario'];

require($_SESSION["installFolder"]."componentes/db/connect.php");

$select = $mysqli->query("SELECT conf.nomeConsultorio, conf.telefone, conf.email, conf.endereco_logradouro, conf.endereco_numero, conf.endereco_complemento,
                          conf.endereco_bairro, conf.endereco_cidade, conf.endereco_cep, conf.endereco_estado AS consultorioEstado, conf.logotipo,
                          areaAtuacao, nomeCompleto, u.endereco_estado, crm FROM usuarios AS u 
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
    $logotipo = $get['logotipo'];
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  <style>
    @page { size: A4 landscape; margin: 3mm; }
    html, body { height: 100%; width: 100%; margin: 0; }
  </style>
  
</head>

<body>
  
  <div style="border-style: solid; border-width: 1px; height: 100%; width: 50%">

  <!--Cabeçallho-->
  <div style="position: relative; height: 80px;">
    <div>
      <img style="width: 12%; height: 12%; margin-left: 10px; margin-top: 15px;" align="left" src="<?php echo $_SESSION["installAddress"]; ?>config/<?php echo $logotipo; ?>"/>
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
      <?php 
      if(!empty($_GET["receita"])){
        $receita = $_GET["receita"];          
        $select = $mysqli->query("SELECT p.nomePaciente AS nomePaciente, paciente, idReceita, receita FROM receitas AS r 
                                  JOIN pacientes AS p ON p.idPaciente = r.paciente
                                  WHERE idReceita = '$receita'");
        $row = $select->num_rows;
        if($row){
          while($get = $select->fetch_array()){
            if(!empty($get['paciente'])){
              echo "Paciente: " . $get['nomePaciente'];
              echo "<br><br>";
            }
            echo nl2br($get['receita']);
          }
        }
      }else{
        echo nl2br($_POST["receita"]);
      }?>
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