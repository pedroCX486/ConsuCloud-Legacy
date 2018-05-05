<?php
header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set("America/Recife"); 

$paciente = trim(addslashes(strip_tags($_POST['paciente'])));
$dataProntuario = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataProntuario'])))));
$horaProntuario = date("H:i:s");
$prontuario = trim(addslashes(strip_tags($_POST['prontuario'])));

$dataProntuario = date('Y-m-d', $dataProntuario);

session_start();
$medico = $_SESSION["idUsuario"];

require $_SERVER['DOCUMENT_ROOT']."componentes/db/connect.php";

// Perform queries 
$query = $mysqli->query("INSERT INTO prontuarios (paciente,medico,dataProntuario,horaProntuario,prontuario) 
VALUES ('$paciente', '$medico', '$dataProntuario', '$horaProntuario', '$prontuario')"); 

if ($query){
  echo '<script type="text/javascript">
					alert("Cadastro realizado com sucesso.");
					location.href="'.$_SESSION["installAddress"].'prontuarios/prontuarios.php";
				</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>