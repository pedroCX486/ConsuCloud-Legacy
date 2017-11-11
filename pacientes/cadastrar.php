<?php
header ('Content-type: text/html; charset=UTF-8');

$nomePaciente = trim(addslashes(strip_tags($_POST['nomePaciente'])));
$RG = trim(addslashes(strip_tags($_POST['RG'])));
$RGUFEXP = trim(addslashes(strip_tags($_POST['RGUFEXP'])));
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
if(!ctype_digit($RG)) {
    echo '<script type="text/javascript">
					alert("ERRO: Caracteres inválidos no campo Documento de Identidade\/RG.\nApenas caracteres numéricos são permitidos.");
					window.history.back();
				</script>';
	exit();
}elseif(!ctype_digit($endereco_cep)) {
    echo '<script type="text/javascript">
					alert("ERRO: Caracteres inválidos no campo CEP.\nApenas caracteres numéricos são permitidos.");
					window.history.back();
				</script>';
	exit();
}

require "../componentes/db/connect.php";

// Perform queries 
$query = $mysqli->query("INSERT INTO pacientes (nomePaciente,RG,RGUFEXP,dataNasc,telCel,telFixo,email,endereco_logradouro,
endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado) 
VALUES ('$nomePaciente', '$RG', '$RGUFEXP', '$dataNasc', '$telCel', '$telFixo', '$email', '$endereco_logradouro', '$endereco_numero', 
'$endereco_complemento', '$endereco_bairro', '$endereco_cidade', '$endereco_cep', '$endereco_estado')"); 

if ($query){
  echo '<script type="text/javascript">
					alert("Cadastro realizado com sucesso.");
					location.href="../pacientes/pacientes.php";
				</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>