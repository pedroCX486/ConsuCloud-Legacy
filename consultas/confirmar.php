<?php
header ('Content-type: text/html; charset=UTF-8');

<<<<<<< HEAD
$idConsulta = trim(addslashes(strip_tags($_GET['confirmar'])));
=======
$idConsulta = trim(addslashes(strip_tags($_GET['consulta'])));
>>>>>>> consucloud-2/master
$confirmaConsulta = trim(addslashes(strip_tags($_GET['cod'])));

require "../componentes/db/connect.php";

// Perform queries 
$query = $mysqli->query("UPDATE consultas SET confirmaConsulta = '$confirmaConsulta' WHERE idConsulta = '$idConsulta'");

<<<<<<< HEAD

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
=======
if ($query){
	if($confirmaConsulta == '1'){
		echo '<script type="text/javascript">
            alert("Consulta confirmada com sucesso.");
            location.href="../dashboards/dashboard.php";
					</script>';
	}else{
		echo '<script type="text/javascript">
            alert("Consulta desconfirmada com sucesso.");
            location.href="../dashboards/dashboard.php";
>>>>>>> consucloud-2/master
					</script>';
	}
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>