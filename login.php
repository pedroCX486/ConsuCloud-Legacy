<?php
require("assets/connect.php");

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
  
    $mysqli->close();
  }
}

  //Validar Senha
  if(password_verify($senhaDigitada, $senhaBanco) && $contaAtiva == "1"){
    session_start();
    $_SESSION["username"] = $nomeCurto;
    $_SESSION["idUsuario"] = $idUsuario;
  
    if($tipoUsuario == "medico"){ //Testar se usuário é tipo médico
      $_SESSION['isMedico'] = true;
    }elseif($tipoUsuario == "secretaria"){ //Testar se usuário é tipo secretária
      $_SESSION['isSecretaria'] = true;
    }elseif($tipoUsuario == "admin"){ //Testar se usuário é tipo admin
      $_SESSION['isAdmin'] = true;
    }elseif($tipoUsuario == "debug"){ //Testar se usuário é tipo debug
      $_SESSION['isDebug'] = true;
    }
  }else{
    if($contaAtiva == "1"){ //Se a conta estiver ativa mas a senha não for validada, retorne com erro
      header("Location: ../index.php?erro=LOGIN");
    }elseif(empty($loginBanco)){ //Se não for encontrado um login no banco, retorne com erro
      header("Location: ../index.php?erro=LOGIN");
    }else{ //Se nenhuma das opções cima passar, provavelmente é porquê a conta está inativa, então retorne com erro
      header("Location: ../index.php?erro=INATIVA");
    }
    exit();
  }

$_SESSION['log'] = "Login";
require("logs/gravarlog.php");

header("Location: ../painel.php");
exit();
?>