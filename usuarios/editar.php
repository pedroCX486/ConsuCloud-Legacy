<?php
header ('Content-type: text/html; charset=UTF-8');

$idUsuario = trim(addslashes(strip_tags($_POST['idUsuario'])));
$crm = trim(addslashes(strip_tags($_POST['crm'])));
$contaAtiva = trim(addslashes(strip_tags($_POST['contaAtiva'])));
$nomeCompleto = trim(addslashes(strip_tags($_POST['nomeCompleto'])));
$areaAtuacao = trim(addslashes(strip_tags($_POST['areaAtuacao'])));
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
$nomeCurto = trim(addslashes(strip_tags($_POST['nomeCurto'])));
$login = trim(addslashes(strip_tags($_POST['login'])));

$dataNasc = date('Y-m-d',$dataNasc);

//Chegacem de caracteres invalidos em alguns campos (caso usuário burle no front-end)
if(!ctype_digit($crm)) {
    echo '<script type="text/javascript">
<<<<<<< HEAD
					alert("ERRO: Caracteres inválidos no campo CRM.\nApenas caracteres numéricos são permitidos.");
					window.history.back();
				</script>';
	exit();
}elseif(!ctype_digit($RG)) {
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
=======
            alert("ERRO: Caracteres inválidos no campo CRM.\nApenas caracteres numéricos são permitidos.");
            window.history.back();
				  </script>';
	exit();
}elseif(!ctype_digit($RG)) {
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
>>>>>>> consucloud-2/master
	exit();
}

//Processar criptografia da senha
if(trim(addslashes(strip_tags($_POST['senha'])))){
	$senha = password_hash(trim(addslashes(strip_tags($_POST['senha']))), PASSWORD_DEFAULT);
}

require "../componentes/db/connect.php";

if($login != "" && $senha != ""){
	// Perform queries
	$query = $mysqli->query("UPDATE usuarios SET crm = '$crm', contaAtiva = '$contaAtiva', nomeCompleto = '$nomeCompleto', areaAtuacao = '$areaAtuacao', RG = '$RG', RGUFEXP = '$RGUFEXP', dataNasc = '$dataNasc', telCel ='$telCel',
	telFixo = '$telFixo', email = '$email', endereco_logradouro = '$endereco_logradouro', endereco_numero = '$endereco_numero', endereco_complemento = '$endereco_complemento', endereco_bairro = '$endereco_bairro',
	endereco_cidade = '$endereco_cidade', endereco_cep = '$endereco_cep', endereco_estado = '$endereco_estado', nomeCurto = '$nomeCurto', login = '$login', senha = '$senha' WHERE idUsuario = '$idUsuario'");
}else{
	// Perform queries
	$query = $mysqli->query("UPDATE usuarios SET crm = '$crm', contaAtiva = '$contaAtiva', nomeCompleto = '$nomeCompleto', areaAtuacao = '$areaAtuacao', RG = '$RG', RGUFEXP = '$RGUFEXP', dataNasc = '$dataNasc', telCel ='$telCel',
	telFixo = '$telFixo', email = '$email', endereco_logradouro = '$endereco_logradouro', endereco_numero = '$endereco_numero', endereco_complemento = '$endereco_complemento', endereco_bairro = '$endereco_bairro',
	endereco_cidade = '$endereco_cidade', endereco_cep = '$endereco_cep', endereco_estado = '$endereco_estado', nomeCurto = '$nomeCurto' WHERE idUsuario = '$idUsuario'");
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
