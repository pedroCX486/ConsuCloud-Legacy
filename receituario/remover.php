<?php
header ('Content-type: text/html; charset=UTF-8');
require("../componentes/db/connect.php");

$idReceita = $_GET['remover'];

// Perform queries 
$query = $mysqli->query("DELETE FROM receitas WHERE idReceita = '$idReceita'");

if ($query){
	echo '<script type="text/javascript">
					alert("Receita apagada com sucesso.");
					location.href="../receituario/receitas.php";
				</script>';
}else{
	echo $mysqli->error;
}

$mysqli->close();
?>