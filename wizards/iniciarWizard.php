<?php
header('Content-type: text/html; charset=UTF-8');
session_start();

if(trim(addslashes(strip_tags($_GET['firstLaunch']))) == true){
  $_SESSION["WIZARD_start"] = true;
  
  $_SESSION["WIZARD_paciente"] = trim(addslashes(strip_tags($_POST['paciente'])));
  $_SESSION["WIZARD_data"] = trim(addslashes(strip_tags($_POST['dataConsulta'])));
  $_SESSION["WIZARD_hora"] = trim(addslashes(strip_tags($_POST['horaConsulta'])));
  
  header('Location: '.$_SESSION["installAddress"].'prontuarios/cadastrarprontuarios.php'); 
}


?>