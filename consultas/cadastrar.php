<?php
header ('Content-type: text/html; charset=UTF-8');

$paciente = trim(addslashes(strip_tags($_POST['paciente'])));
$medico = trim(addslashes(strip_tags($_POST['medico'])));
$dataConsulta = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataConsulta'])))));
$horaConsulta = trim(addslashes(strip_tags($_POST['horaConsulta'])));
$planoConsulta = trim(addslashes(strip_tags($_POST['planoConsulta'])));
$carteiraPlano = trim(addslashes(strip_tags($_POST['carteiraPlano'])));
$tipoConsulta = trim(addslashes(strip_tags($_POST['tipoConsulta'])));

$dataConsulta = date('Y-m-d',$dataConsulta);

require $_SERVER['DOCUMENT_ROOT']."/componentes/db/connect.php";

//Para consultas particulares, o campo fica em branco, então defaultamos para zero
if(empty($carteiraPlano)){
	$carteiraPlano = 0;
}

//Executar query
$query = $mysqli->query("INSERT INTO consultas (paciente,medico,dataConsulta,horaConsulta,planoConsulta,carteiraPlano,tipoConsulta) 
VALUES ('$paciente', '$medico', '$dataConsulta', '$horaConsulta', '$planoConsulta', '$carteiraPlano', '$tipoConsulta')"); 

if ($query){
  echo '<script type="text/javascript">
					alert("Cadastro realizado com sucesso.");
					location.href="../consultas/consultas.php";
        </script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>