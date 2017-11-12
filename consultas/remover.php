<?php
header ('Content-type: text/html; charset=UTF-8');
require("../componentes/db/connect.php");

$idConsulta = $_GET['remover'];
$confirmaRemover = $_GET['confirmaRemover'];

if($confirmaRemover == 0){
	echo'<script type="text/javascript">
			var remover = confirm("Deseja realmente remover esta consulta?");
			if (remover == true){
				location.href="remover.php?remover=' . $idConsulta . '&confirmaRemover=1";
			}else{
  			location.href="../consultas/consultas.php";
			}
		</script>';
}else{
	// Perform queries 
	$query = $mysqli->query("DELETE FROM consultas WHERE idConsulta = '$idConsulta'");

	if ($query){
  	echo '<script type="text/javascript">
            alert("Consulta removida com sucesso.");
            location.href="../consultas/consultas.php";
					</script>';
	}else{
  	echo $mysqli->error;
	}
	
	$mysqli->close();
}
?>