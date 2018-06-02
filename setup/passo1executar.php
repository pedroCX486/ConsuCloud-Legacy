<?php
header ('Content-type: text/html; charset=UTF-8');
session_start();

$nomeConsultorio = trim(addslashes(strip_tags($_POST['nomeConsultorio'])));
$email = trim(addslashes(strip_tags($_POST['email'])));
$telefone = trim(addslashes(strip_tags($_POST['telefone'])));
$endereco_logradouro = trim(addslashes(strip_tags($_POST['endereco_logradouro'])));
$endereco_numero = trim(addslashes(strip_tags($_POST['endereco_numero'])));
$endereco_complemento = trim(addslashes(strip_tags($_POST['endereco_complemento'])));
$endereco_bairro = trim(addslashes(strip_tags($_POST['endereco_bairro'])));
$endereco_cidade = trim(addslashes(strip_tags($_POST['endereco_cidade'])));
$endereco_cep = trim(addslashes(strip_tags($_POST['endereco_cep'])));
$endereco_estado = trim(addslashes(strip_tags($_POST['endereco_estado'])));
$diretorioInstalacao = $_SESSION['diretorioInstalacao'];

require "../componentes/db/connect.php";

$query = $mysqli->query("INSERT INTO configs (nomeConsultorio,email,telefone,logotipo,endereco_logradouro,
endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado, setupDate, installFolder) 
VALUES ('$nomeConsultorio', '$email', '$telefone', 'logotipo_consucloud.png', '$endereco_logradouro', '$endereco_numero', 
'$endereco_complemento', '$endereco_bairro', '$endereco_cidade', '$endereco_cep', '$endereco_estado', NOW(), '$diretorioInstalacao')");

$query1 = $mysqli->query("INSERT INTO planos (nomePlano,telFixo,email,infoPlano,endereco_logradouro,
endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado) 
VALUES ('Particular', '00 00000000', '$email', 'Consultas Particulares', '$endereco_logradouro', '$endereco_numero', 
'$endereco_complemento', '$endereco_bairro', '$endereco_cidade', '$endereco_cep', '$endereco_estado')");

if ($query && $query1){
  echo '<script type="text/javascript">
			location.href="passo2.php";
		</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>