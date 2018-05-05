<?php
header ('Content-type: text/html; charset=UTF-8');

$senha = password_hash(trim(addslashes(strip_tags($_POST['senha']))), PASSWORD_DEFAULT);
$email = trim(addslashes(strip_tags($_POST['email'])));

require $_SERVER['DOCUMENT_ROOT']."componentes/db/connect.php";

//Executar queries
$query = $mysqli->query("INSERT INTO usuarios (crm,tipoUsuario,nomeCompleto,areaAtuacao,RG,RGUFEXP,dataNasc,telCel,telFixo,email,endereco_logradouro,
endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado,login,senha,nomeCurto) 
VALUES ('SysAdmin', 'admin', 'Administrador', 'Administrador', '0', 'ConsuCloud', '2000-01-01', '00 000000000', '00 00000000', '$email', 'ConsuCloud', '0', 
'ConsuCloud', 'ConsuCloud', 'ConsuCloud', '0', 'ConsuCloud', 'SysAdmin', '$senha', 'Admin')");

if ($query){
  echo '<script type="text/javascript">
					location.href="finish.php";
					</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>