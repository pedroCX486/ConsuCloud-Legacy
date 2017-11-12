<?php
header ('Content-type: text/html; charset=UTF-8');

$crm = trim(addslashes(strip_tags($_POST['crm'])));
$tipoUsuario = trim(addslashes(strip_tags($_POST['tipoUsuario'])));
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
$login = trim(addslashes(strip_tags($_POST['login'])));
$nomeCurto = trim(addslashes(strip_tags($_POST['nomeCurto'])));

//Chegacem de caracteres invalidos em alguns campos (caso usuário burle no front-end)
if(!ctype_digit($crm)) {
    echo '<script type="text/javascript">
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
	exit();
}elseif($tipoUsuario == "admin"){
    echo '<script type="text/javascript">
            alert("ERRO FATAL: Dados inválidos foram enviados ao servidor. Se você está vendo este erro, contacte a equipe de desenvolvimento.\n\n Um registro foi feito no log de eventos.");
            location.href="../index.php?erro=ERROFATAL";
			  	</script>';
	exit();
}

//Processar criptografia da senha
$senha = password_hash(trim(addslashes(strip_tags($_POST['senha']))), PASSWORD_DEFAULT);

//Processar data
$dataNasc = date('Y-m-d',$dataNasc);

//Conectar ao db
require "../componentes/db/connect.php";


//Checar se nome de usuário já existe
$select = $mysqli->query("SELECT * FROM usuarios WHERE login = '" . $login . "'");
if($select->num_rows) {
	echo '<script type="text/javascript">
          alert("ERRO: Nome de usuário já existe.");
          window.history.back();
        </script>';
	exit();
}else{
	
	//Executar query de acorco com tipo de usuário
	if($tipoUsuario == 'medico'){
		//Query Secretária
		$query = $mysqli->query("INSERT INTO usuarios (crm,tipoUsuario,nomeCompleto,areaAtuacao,RG,RGUFEXP,dataNasc,telCel,telFixo,email,endereco_logradouro,
		endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado,login,senha,nomeCurto) 
		VALUES ('$crm', '$tipoUsuario', '$nomeCompleto', '$areaAtuacao', '$RG', '$RGUFEXP', '$dataNasc', '$telCel', '$telFixo', '$email', '$endereco_logradouro', '$endereco_numero', 
		'$endereco_complemento', '$endereco_bairro', '$endereco_cidade', '$endereco_cep', '$endereco_estado', '$login', '$senha', '$nomeCurto')"); 
	}elseif($tipoUsuario == 'secretaria'){
		//Query Secretária
		$query = $mysqli->query("INSERT INTO usuarios (crm,tipoUsuario,nomeCompleto,areaAtuacao,RG,RGUFEXP,dataNasc,telCel,telFixo,email,endereco_logradouro,
		endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado,login,senha,nomeCurto) 
		VALUES ('$crm', '$tipoUsuario', '$nomeCompleto', 'Secr. de Atendimento', '$RG', '$RGUFEXP', '$dataNasc', '$telCel', '$telFixo', '$email', '$endereco_logradouro', '$endereco_numero', 
		'$endereco_complemento', '$endereco_bairro', '$endereco_cidade', '$endereco_cep', '$endereco_estado', '$login', '$senha', '$nomeCurto')"); 
	}
	
	if ($query){
	  echo '<script type="text/javascript">
						alert("Cadastro realizado com sucesso.");
						location.href="../usuarios/usuarios.php";
					</script>';
	}else{
	  echo $mysqli->error;
	}
	
	$mysqli->close();
}
?>