<?php
header('Content-type: text/html; charset=UTF-8');
session_start();
$idUsuario = $_SESSION['idUsuario'];

$tema = trim(addslashes(strip_tags($_POST['tema'])));

//Conexão com db
require($_SESSION["installFolder"]."/componentes/db/connect.php");

//Executar query
$query = $mysqli->query("UPDATE usuarios SET tema = '$tema' WHERE idUsuario = '$idUsuario'");

if($query){
	$_SESSION["tema"] = $tema;
  echo '<script type="text/javascript">
					alert("Configurações atualizadas com sucesso.");
					location.href="'.$_SESSION["installAddress"].'/usuarios/personalizacao/personalizacao.php";
        </script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>