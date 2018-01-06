<?php
//Header UTF-8
header ('Content-type: text/html; charset=UTF-8');

//Configurar Timezone
date_default_timezone_set('America/Recife');

//Buscar por Username (se aplicável)
if(!isset($_SESSION["username"])){
    $usuario = "Sem Username";
}elseif($_SESSION['username'] == ""){
    $usuario = "Sem Username";
}else{
    $usuario = $_SESSION["username"];
}

//Fazer request pelo IP do client (nem sempre retorna o IP real)
$ip = $_SERVER['REMOTE_ADDR'];
if($ip == ""){
    $ip = "Sem IP";
}

//Dia - Em formato MySQL
$dia = date('Y/m/d');

//Hora
$hora = date('h:i a');

//Processar tipo de Log
if($_SESSION['log'] == "LOGIN"){
    $log = "Login Efetuado";
}elseif($_SESSION['log'] == "403"){
    $log = "Acesso Não Autorizado";
}elseif($_SESSION['log'] == "UPLOAD"){
    $log = "Upload de Exame Executado";
}elseif($_SESSION['log'] == "ERROBANCO"){
    $log = '<a href="#" data-toggle="tooltip" data-container="body" title="'. $_SESSION['ERROBANCO'] .'">Erro no Banco de Dados</a>';
}elseif($_SESSION['log'] == "INATIVA"){
    $log = "Tentativa de Login";
}

//Connect
require $_SERVER['DOCUMENT_ROOT']."/componentes/db/connect.php";

//Salvar no banco
$query = $mysqli->query("INSERT INTO logs (log,usuario,ip,dataLog,horaLog) VALUES ('$log', '$usuario', '$ip', '$dia', '$hora')");

//Um breve teste, só para debug
//if (!$query){
//    echo $mysqli->error;
//}

//Fim
$mysqli->close();
?>