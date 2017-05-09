<?php
header ('Content-type: text/html; charset=UTF-8');

$medico = trim(addslashes(strip_tags($_POST['medico'])));
$paciente = trim(addslashes(strip_tags($_POST['paciente'])));
$dataConsulta = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataConsulta'])))));
$horaConsulta = trim(addslashes(strip_tags($_POST['horaConsulta'])));
$planoConsulta = trim(addslashes(strip_tags($_POST['planoConsulta'])));
$carteiraPlano = trim(addslashes(strip_tags($_POST['carteiraPlano'])));
$tipoConsulta = trim(addslashes(strip_tags($_POST['tipoConsulta'])));
$idConsulta = trim(addslashes(strip_tags($_POST['idConsulta'])));

$dataConsulta = date('Y-m-d',$dataConsulta);

require "../assets/connect.php";

// Perform queries 
$query = $mysqli->query("UPDATE consultas SET medico = '$medico', paciente = '$paciente', dataConsulta = '$dataConsulta', horaConsulta = '$horaConsulta',
 planoConsulta = '$planoConsulta', carteiraPlano = '$carteiraPlano', tipoConsulta = '$tipoConsulta' WHERE idConsulta = '$idConsulta'");

if ($query){
  echo '<script type="text/javascript">
					alert("Atualização realizada com sucesso.");
					location.href="../consultas/consultas.php";
					</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>