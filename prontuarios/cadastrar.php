<?php
header ('Content-type: text/html; charset=UTF-8');

$paciente = trim(addslashes(strip_tags($_POST['paciente'])));
$dataProntuario = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataProntuario'])))));
$prontuario = trim(addslashes(strip_tags($_POST['prontuario'])));

$dataProntuario = date('Y-m-d',$dataProntuario);

session_start();
$medico = $_SESSION["CRM"];

require "../assets/connect.php";

// Perform queries 
$query = $mysqli->query("INSERT INTO prontuarios (paciente,medico,dataProntuario,prontuario) 
VALUES ('$paciente', '$medico', '$dataProntuario', '$prontuario')"); 

if ($query){
  echo '<script type="text/javascript">
					alert("Cadastro realizado com sucesso.");
					location.href="../prontuarios/prontuarios.php";
				</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>