<?php
header ('Content-type: text/html; charset=UTF-8');

$idConsulta = trim(addslashes(strip_tags($_GET['confirmar'])));
$confirmaConsulta = trim(addslashes(strip_tags($_GET['cod'])));

require "../componentes/db/connect.php";

// Perform queries 
$query = $mysqli->query("UPDATE consultas SET confirmaConsulta = '$confirmaConsulta' WHERE idConsulta = '$idConsulta'");


if ($query){
	if($confirmaConsulta == '1'){
		echo '<script type="text/javascript">
					alert("Consulta confirmada com sucesso.");
					location.href="../painel.php";
					</script>';
	}else{
		echo '<script type="text/javascript">
					alert("Consulta desconfirmada com sucesso.");
					location.href="../painel.php";
					</script>';
	}
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>