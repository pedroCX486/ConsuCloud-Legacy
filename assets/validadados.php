<?php
// Campo que fez requisição
$campo = $_GET['campo'];
// Valor do campo que fez requisição
$valor = $_GET['valor'];
 
// Verificando o campo email
if ($campo == "email") {
 
	if (!eregi("^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$", $valor)) {
		echo 'E-Mail inválido <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
	}else{
		echo '';
	}
}
 
// Verificando o campo CPF
if ($campo == "cpf") {
 
	if (!eregi("([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})", $valor)) {
		echo 'CPF INVÁLIDO <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
	}else{
		echo '';
	}
}
 
// Acentuação
header("Content-Type: text/html; charset=UTF-8",true);
?>