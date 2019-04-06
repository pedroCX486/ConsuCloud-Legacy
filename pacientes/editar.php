<?php
header ('Content-type: text/html; charset=UTF-8');
session_start();

$idPaciente = trim(addslashes(strip_tags($_POST['idPaciente'])));
$nomePaciente = trim(addslashes(strip_tags($_POST['nomePaciente'])));
$RG = trim(addslashes(strip_tags($_POST['RG'])));
$RGUFEXP = trim(addslashes(strip_tags($_POST['RGUFEXP'])));
$CPF = trim(addslashes(strip_tags($_POST['CPF'])));
$dataNasc = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataNasc'])))));
$telCel = trim(addslashes(strip_tags($_POST['telCel'])));
$telFixo = trim(addslashes(strip_tags($_POST['telFixo'])));
$email = trim(addslashes(strip_tags($_POST['email'])));
$profissao = trim(addslashes(strip_tags($_POST['profissao'])));
$endereco_logradouro = trim(addslashes(strip_tags($_POST['endereco_logradouro'])));
$endereco_numero = trim(addslashes(strip_tags($_POST['endereco_numero'])));
$endereco_complemento = trim(addslashes(strip_tags($_POST['endereco_complemento'])));
$endereco_bairro = trim(addslashes(strip_tags($_POST['endereco_bairro'])));
$endereco_cidade = trim(addslashes(strip_tags($_POST['endereco_cidade'])));
$endereco_cep = trim(addslashes(strip_tags($_POST['endereco_cep'])));
$endereco_estado = trim(addslashes(strip_tags($_POST['endereco_estado'])));
$notas = trim(addslashes(strip_tags($_POST['notas'])));

$dataNasc = date('Y-m-d',$dataNasc);

//Chegacem de caracteres invalidos em alguns campos (caso usuário burle no front-end)
if(!ctype_digit($RG)) {
    echo '<script type="text/javascript">
			  		alert("ERRO: Caracteres inválidos no campo Documento de Identidade\/RG.\nApenas caracteres numéricos são permitidos.");
			  		window.history.back();
			  	</script>';
	exit();
}elseif(!ctype_digit($endereco_cep) && !empty($endereco_cep)) {
    echo '<script type="text/javascript">
			  		alert("ERRO: Caracteres inválidos no campo CEP.\nApenas caracteres numéricos são permitidos.");
			  		window.history.back();
			  	</script>';
	exit();
}

require $_SESSION["installFolder"]."componentes/db/connect.php";

// Perform queries 
$query = $mysqli->query("UPDATE pacientes SET nomePaciente = '$nomePaciente', RG = '$RG', RGUFEXP = '$RGUFEXP', CPF = '$CPF', dataNasc = '$dataNasc', telCel ='$telCel', 
telFixo = '$telFixo', email = '$email', profissao = '$profissao', endereco_logradouro = '$endereco_logradouro', endereco_numero = '$endereco_numero', endereco_complemento = '$endereco_complemento', endereco_bairro = '$endereco_bairro', 
endereco_cidade = '$endereco_cidade', endereco_cep = '$endereco_cep', endereco_estado = '$endereco_estado', notas = '$notas' WHERE idPaciente = '$idPaciente'");

if ($query){
  echo '<script type="text/javascript">
					alert("Atualização realizada com sucesso.");
					location.href="'.$_SESSION["installAddress"].'pacientes/pacientes.php";
				</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>
