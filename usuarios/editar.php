<?php
header ('Content-type: text/html; charset=UTF-8');

$crm = trim(addslashes(strip_tags($_POST['crm'])));
$contaAtiva = trim(addslashes(strip_tags($_POST['contaAtiva'])));
$nomeComp = trim(addslashes(strip_tags($_POST['nomeComp'])));
$areaAtuacao = trim(addslashes(strip_tags($_POST['areaAtuacao'])));
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
$nomeCurto = trim(addslashes(strip_tags($_POST['nomeCurto'])));
$login = trim(addslashes(strip_tags($_POST['login'])));

$dataNasc = date('Y-m-d',$dataNasc);

//Chegacem de caracteres invalidos em alguns campos (caso usuário burle no front-end)
if(!ctype_digit($crm)) {
    echo '<script type="text/javascript">
					alert("ERRO: Caracteres inválidos no campo CRM.\nApenas caracteres numéricos são permitidos.");
					location.href="../usuarios/cadastrarusuarios.php";
					</script>';
	exit();
}elseif(!ctype_digit($numIdRG)) {
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

//Processar criptografia da senha
if(trim(addslashes(strip_tags($_POST['senha'])))){
	$senha = password_hash(trim(addslashes(strip_tags($_POST['senha']))), PASSWORD_DEFAULT);
}

require "../assets/connect.php";

if($login != "" && $senha != ""){
	// Perform queries
	$query = $mysqli->query("UPDATE usuarios SET crm = '$crm', contaAtiva = '$contaAtiva', nomeComp = '$nomeComp', areaAtuacao = '$areaAtuacao', numIdRG = '$numIdRG', RG_UFEXP = '$RG_UFEXP', dataNasc = '$dataNasc', telCel ='$telCel',
	telFixo = '$telFixo', email = '$email', endereco_logradouro = '$endereco_logradouro', endereco_numero = '$endereco_numero', endereco_complemento = '$endereco_complemento', endereco_bairro = '$endereco_bairro',
	endereco_cidade = '$endereco_cidade', endereco_cep = '$endereco_cep', endereco_estado = '$endereco_estado', nomeCurto = '$nomeCurto', login = '$login', senha = '$senha' WHERE crm = '$crm'");
}else{
	// Perform queries
	$query = $mysqli->query("UPDATE usuarios SET crm = '$crm', contaAtiva = '$contaAtiva', nomeComp = '$nomeComp', areaAtuacao = '$areaAtuacao', numIdRG = '$numIdRG', RG_UFEXP = '$RG_UFEXP', dataNasc = '$dataNasc', telCel ='$telCel',
	telFixo = '$telFixo', email = '$email', endereco_logradouro = '$endereco_logradouro', endereco_numero = '$endereco_numero', endereco_complemento = '$endereco_complemento', endereco_bairro = '$endereco_bairro',
	endereco_cidade = '$endereco_cidade', endereco_cep = '$endereco_cep', endereco_estado = '$endereco_estado', nomeCurto = '$nomeCurto' WHERE crm = '$crm'");
}

if ($query){
  echo '<script type="text/javascript">
					alert("Atualização realizada com sucesso.");
					location.href="../usuarios/usuarios.php";
					</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>
