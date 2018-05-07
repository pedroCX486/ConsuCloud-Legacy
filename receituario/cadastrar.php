<?php
header ('Content-type: text/html; charset=UTF-8');
session_start();

$paciente = trim(addslashes(strip_tags($_POST['paciente'])));
$medico = trim(addslashes(strip_tags($_POST['medico'])));
$dataReceita = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataReceita'])))));
$horaReceita = trim(addslashes(strip_tags($_POST['horaReceita'])));
$nomeReceita = trim(addslashes(strip_tags($_POST['nomeReceita'])));
$receita = trim(addslashes(strip_tags($_POST['receita'])));

$dataReceita = date('Y-m-d',$dataReceita);

require $_SESSION["installFolder"]."componentes/db/connect.php";

//Executar query
$query = $mysqli->query("INSERT INTO receitas (paciente,medico,dataReceita,horaReceita,nomeReceita,receita) 
VALUES ('$paciente', '$medico', '$dataReceita', '$horaReceita', '$nomeReceita', '$receita')"); 

if ($query){
  
  $select = $mysqli->query("SELECT LAST_INSERT_ID()");
  $row = $select->num_rows;
  if($row){              
    while($get = $select->fetch_array()){
      $idReceita = $get[0];
    }
  }
  
  if($_SESSION['WIZARD_start']){
    unset($_SESSION["WIZARD_paciente"]);
    unset($_SESSION["WIZARD_data"]);
    unset($_SESSION["WIZARD_hora"]);
    unset($_SESSION["WIZARD_start"]);
    
    echo '<script type="text/javascript">
           alert("Receita cadastrada com sucesso. Consulta concluída! Encerrando modo guiado.");
           location.href="'.$_SESSION["installAddress"].'receituario/receitas.php?imprimirRedirect='.$idReceita.'";
          </script>';
  }else{
   echo '<script type="text/javascript">
          alert("Receita cadastrada com sucesso.");
          location.href="'.$_SESSION["installAddress"].'receituario/receitas.php?imprimirRedirect='.$idReceita.'";
        </script>'; 
  }
  
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>