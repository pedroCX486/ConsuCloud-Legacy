<?php
header ('Content-type: text/html; charset=UTF-8');

$nomeComp = trim(addslashes(strip_tags($_POST['nomeComp'])));
$numIdRG = trim(addslashes(strip_tags($_POST['numIdRG'])));
$RG_UFEXP = trim(addslashes(strip_tags($_POST['RG_UFEXP'])));
$dataNasc = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataNasc'])))));
$telCel = trim(addslashes(strip_tags($_POST['telCel'])));
$telFixo = trim(addslashes(strip_tags($_POST['telFixo'])));
$email = trim(addslashes(strip_tags($_POST['email'])));
$endereco_logradouro = trim(addslashes(strip_tags($_POST['endereco_logradouro'])));
$endereco_numero = trim(addslashes(strip_tags($_POST['endereco_numero'])));
$endereco_complemento = trim(addslashes(strip_tags($_POST['endereco_complemento'])));
$endereco_bairro = trim(addslashes(strip_tags($_POST['endereco_bairro'])));
$endereco_cidade = trim(addslashes(strip_tags($_POST['endereco_cidade'])));
$endereco_cep = trim(addslashes(strip_tags($_POST['endereco_cep'])));
$endereco_estado = trim(addslashes(strip_tags($_POST['endereco_estado'])));

$dataNasc = date('Y-m-d',$dataNasc);

//Chegacem de caracteres invalidos em alguns campos (caso usuário burle no front-end)
if(!ctype_digit($numIdRG)) {
    echo '<script type="text/javascript">
					alert("ERRO: Caracteres inválidos no campo Documento de Identidade\/RG.\nApenas caracteres numéricos são permitidos.");
					location.href="../usuarios/cadastrarusuarios.php";
					</script>';
	exit();
}elseif(!ctype_digit($endereco_cep)) {
    echo '<script type="text/javascript">
					alert("ERRO: Caracteres inválidos no campo CEP.\nApenas caracteres numéricos são permitidos.");
					location.href="../usuarios/cadastrarusuarios.php";
					</script>';
	exit();
}

require "../assets/connect.php";

// Perform queries 
$query = $mysqli->query("UPDATE pacientes SET numIdRG = '$numIdRG', nomeComp = '$nomeComp', numIdRG = '$numIdRG', RG_UFEXP = '$RG_UFEXP', dataNasc = '$dataNasc', telCel ='$telCel', 
telFixo = '$telFixo', email = '$email', endereco_logradouro = '$endereco_logradouro', endereco_numero = '$endereco_numero', endereco_complemento = '$endereco_complemento', endereco_bairro = '$endereco_bairro', 
endereco_cidade = '$endereco_cidade', endereco_cep = '$endereco_cep', endereco_estado = '$endereco_estado' WHERE numIdRG = '$numIdRG'");


if ($query){
  echo '<script type="text/javascript">
					alert("Atualização realizada com sucesso.");
					location.href="../pacientes/pacientes.php";
					</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>