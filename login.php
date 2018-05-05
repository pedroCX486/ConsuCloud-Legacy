<?php
require($_SERVER['DOCUMENT_ROOT']."/componentes/db/connect.php");

//Matar seções prévias
session_start();
session_unset();
session_destroy();

$login = trim(addslashes(strip_tags($_POST['login'])));
$senhaDigitada = trim(addslashes(strip_tags($_POST['senha'])));

$select = $mysqli->query("SELECT * FROM usuarios WHERE BINARY login = '$login'");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    
    $loginBanco = $get['login'];
    $senhaBanco = $get['senha'];
    $nomeCurto = $get['nomeCurto'];
    $tipoUsuario = $get['tipoUsuario'];
    $idUsuario = $get['idUsuario'];
    $contaAtiva = $get['contaAtiva'];
    $tema = $get['tema'];
  
    $mysqli->close();
  }
}

//Pegar o Diretório de Instalação do Sistema
$select = $mysqli->query("SELECT * FROM configs");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    
    $installFolder = $get['installFolder'];
  
    $mysqli->close();
  }
}

session_start();

if(empty($installFolder)){
  $installFolder = "/";
  $_SESSION["installFolder"] = $_SERVER['DOCUMENT_ROOT'];
}else{
  $_SESSION["installFolder"] = $_SERVER['DOCUMENT_ROOT'].$installFolder;
}

$_SESSION["installAddress"] = "https://".$_SERVER['HTTP_HOST'].$installFolder;

//Pegar dados do usuario
$_SESSION["username"] = $nomeCurto;
$_SESSION["idUsuario"] = $idUsuario;
$_SESSION["tema"] = $tema;

//Validar Senha
//Nota - 11/11/2017: Se você tem problemas do coração, não leia esse trecho if/else
if(password_verify($senhaDigitada, $senhaBanco) && $contaAtiva == "1"){
  //Controle de permissões
  if($tipoUsuario == "medico"){ //Testar se usuário é tipo médico
    $_SESSION['isMedico'] = true;
    $_SESSION['isSecretaria'] = false;
    $_SESSION['isAdmin'] = false;
  }elseif($tipoUsuario == "secretaria"){ //Testar se usuário é tipo secretária
    $_SESSION['isSecretaria'] = true;
    $_SESSION['isAdmin'] = false;
    $_SESSION['isMedico'] = false;
  }elseif($tipoUsuario == "admin"){ //Testar se usuário é tipo admin
    $_SESSION['isAdmin'] = true;
    $_SESSION['isSecretaria'] = false;
    $_SESSION['isMedico'] = false;
  }
}else{
  if($contaAtiva == "1"){ //Se a conta estiver ativa mas a senha não for validada, retorne com erro
    header("Location: ".$_SESSION["installAddress"]."index.php?erro=LOGIN");
  }elseif(empty($loginBanco)){ //Se não for encontrado um login no banco, retorne com erro
    header("Location: ".$_SESSION["installAddress"]."index.php?erro=LOGIN");
  }else{ //Se nenhuma das opções cima passar, provavelmente é porquê a conta está inativa, então retorne com erro
    header("Location: ".$_SESSION["installAddress"]."index.php?erro=INATIVA");
  }
  exit();
}

$_SESSION['log'] = "LOGIN";
require($_SERVER['DOCUMENT_ROOT']."/logs/gravarlogs.php");

header("Location: ".$_SESSION["installAddress"]."dashboards/dashboard.php");
exit();
?>