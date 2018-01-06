<?php
header ('Content-type: text/html; charset=UTF-8');

$paciente = trim(addslashes(strip_tags($_POST['paciente'])));
$medico = trim(addslashes(strip_tags($_POST['medico'])));
$dataReceita = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataReceita'])))));
$horaReceita = trim(addslashes(strip_tags($_POST['horaReceita'])));
$nomeReceita = trim(addslashes(strip_tags($_POST['nomeReceita'])));
$tipoReceita = trim(addslashes(strip_tags($_POST['tipoReceita'])));
$receita = trim(addslashes(strip_tags($_POST['receita'])));

$dataReceita = date('Y-m-d',$dataReceita);

if($tipoReceita != "Receita de Medicação" && empty($paciente)){
	echo '<script type="text/javascript">
					alert("ERRO: Tipo de receita não é medicação, é obrigatório informar paciente!");
					window.history.back();
        </script>';
	exit();
}

require "../componentes/db/connect.php";

//Executar query
$query = $mysqli->query("INSERT INTO receitas (paciente,medico,dataReceita,horaReceita,nomeReceita,tipoReceita,receita) 
VALUES ('$paciente', '$medico', '$dataReceita', '$horaReceita', '$nomeReceita', '$tipoReceita', '$receita')"); 

if ($query){
  echo '<script type="text/javascript">
					alert("Cadastro realizado com sucesso.");
					location.href="../receituario/receitas.php";
        </script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>