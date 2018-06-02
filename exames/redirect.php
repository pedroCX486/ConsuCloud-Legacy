<?php

require("componentes/db/connect.php");

//Pegar o Diretório de Instalação do Sistema
$select = $mysqli->query("SELECT installFolder FROM configs");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    
    $installFolder = $get['installFolder'];
  
    $mysqli->close();
  }
}

$installAddress = "https://".$_SERVER['HTTP_HOST'].$installFolder;

echo "<script>top.window.location = '".$installAddress."index.php?erro=ERROFATAL'</script>";
die();

?>