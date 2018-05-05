<?php
header ('Content-type: text/html; charset=UTF-8');

$idConsulta = trim(addslashes(strip_tags($_GET['consulta'])));
$finalizaConsulta = trim(addslashes(strip_tags($_GET['cod'])));

require $_SESSION["installFolder"]."componentes/db/connect.php";

// Perform queries 
$query = $mysqli->query("UPDATE consultas SET consultaFinalizada = '$finalizaConsulta' WHERE idConsulta = '$idConsulta'");

if($query){
	if($finalizaConsulta == '1'){
		echo '<script type="text/javascript">
            alert("Consulta finalizada com sucesso.");
            location.href="'.$_SESSION["installAddress"].'dashboards/dashboard.php";
					</script>';
	}else{
		echo '<script type="text/javascript">
            alert("Consulta reaberta com sucesso.");
            location.href="'.$_SESSION["installAddress"].'dashboards/dashboard.php";
					</script>';
	}
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>