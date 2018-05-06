<?php
header ('Content-type: text/html; charset=UTF-8');
session_start();

require($_SESSION["installFolder"]."componentes/db/connect.php");

$idConsulta = $_GET['remover'];

// Perform queries 
$query = $mysqli->query("DELETE FROM consultas WHERE idConsulta = '$idConsulta'");

if ($query){
	echo '<script type="text/javascript">
					alert("Consulta cancelada com sucesso.");
					location.href="'.$_SESSION["installAddress"].'consultas/consultas.php";
				</script>';
}else{
	echo $mysqli->error;
}

$mysqli->close();
?>