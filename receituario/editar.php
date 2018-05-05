<?php
header ('Content-type: text/html; charset=UTF-8');

$paciente = trim(addslashes(strip_tags($_POST['paciente'])));
$medico = trim(addslashes(strip_tags($_POST['medico'])));
$dataReceita = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataReceita'])))));
$horaReceita = trim(addslashes(strip_tags($_POST['horaReceita'])));
$nomeReceita = trim(addslashes(strip_tags($_POST['nomeReceita'])));
$tipoReceita = trim(addslashes(strip_tags($_POST['tipoReceita'])));
$receita = trim(addslashes(strip_tags($_POST['receita'])));
$idReceita = trim(addslashes(strip_tags($_POST['idReceita'])));

$dataReceita = date('Y-m-d',$dataReceita);

require $_SESSION["installFolder"]."componentes/db/connect.php";

//Executar query
$query = $mysqli->query("UPDATE receitas SET medico = '$medico', paciente = '$paciente', dataReceita = '$dataReceita', horaReceita = '$horaReceita',
 nomeReceita = '$nomeReceita', tipoReceita = '$tipoReceita', receita = '$receita' WHERE idReceita = '$idReceita'"); 

if ($query){
  echo '<script type="text/javascript">
					alert("Edição realizada com sucesso.");
					location.href="'.$_SESSION["installAddress"].'receituario/receitas.php";
        </script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>