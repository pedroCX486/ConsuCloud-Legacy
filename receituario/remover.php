<?php
header ('Content-type: text/html; charset=UTF-8');
session_start();

require($_SESSION["installFolder"]."componentes/db/connect.php");

$idReceita = trim(addslashes(strip_tags($_GET['remover'])));

// Perform queries 
$query = $mysqli->query("DELETE FROM receitas WHERE idReceita = '$idReceita'");

if ($query){
	echo '<script type="text/javascript">
					alert("Receita apagada com sucesso.");
					location.href="'.$_SESSION["installAddress"].'receituario/receitas.php";
				</script>';
}else{
	echo $mysqli->error;
}

$mysqli->close();
?>