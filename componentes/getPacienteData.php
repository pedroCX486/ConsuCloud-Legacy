<?php
header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set("America/Recife"); 

session_start();

require $_SESSION["installFolder"]."componentes/db/connect.php";

$idPaciente = trim(addslashes(strip_tags($_POST['idPaciente'])));

$select = $mysqli->query("SELECT * FROM pacientes WHERE idPaciente = $idPaciente");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    $nomePaciente = $get['nomePaciente'];
    $RG = $get['RG'];
    $RGUFEXP = $get['RGUFEXP'];
    $CPF = $get['CPF'];
    $dataNasc = $get['dataNasc'];
    $telCel = $get['telCel'];
    $telFixo = $get['telFixo'];
    $email = $get['email'];
    $profissao = $get['profissao'];
    $endereco_logradouro = $get['endereco_logradouro'];
    $endereco_numero = $get['endereco_numero'];
    $endereco_complemento = $get['endereco_complemento'];
    $endereco_bairro = $get['endereco_bairro'];
    $endereco_cidade = $get['endereco_cidade'];
    $endereco_cep = $get['endereco_cep'];
    $endereco_estado = $get['endereco_estado'];
    $notas = $get['notas'];
  }
}

$dataNasc = date("d/m/Y", strtotime($dataNasc));

echo "RG: " . $RG . "-" . $RGUFEXP . "<br>CPF: " . $CPF . "<br>Data de Nascimento: " . $dataNasc . "<br>Profissão: " . $profissao . "<br>Endereço: " . $endereco_logradouro . " " . $endereco_numero . " " . $endereco_complemento . " - " . $endereco_bairro . " - " .  $endereco_cidade  . " - " . $endereco_estado . "<br>Notas: " . $notas;

exit();
