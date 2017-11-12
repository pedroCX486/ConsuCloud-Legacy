<?php
//Erros Baseado em Browser
if(stripos($_SERVER["HTTP_USER_AGENT"], 'Trident')) {
  echo '<div class="alert alert-danger" id="rcorners2" role="alert"><b>O ConsuCloud não é compatível com o Internet Explorer.<br>Recomendamos o uso  o <a href="http://chrome.google.com">Google Chrome</a> para melhor eficiência e desempenho.</div>';
  echo '<style>#login {visibility: hidden;}</style>';
}else if(stripos($_SERVER["HTTP_USER_AGENT"], 'Firefox')){
  echo '<div class="alert alert-danger" id="rcorners2" role="alert"><b>O ConsuCloud não é compatível com o Firefox.<br>Recomendamos o uso com o <a href="http://chrome.google.com">Google Chrome</a> para melhor eficiência e desempenho.</div>';
  echo '<style>#login {visibility: hidden;}</style>';
}

//Erros do Sistema
if($erro == "LOGIN"){
  echo '<div class="alert alert-danger" id="rcorners2" role="alert">Nome de usuário ou senha inválidos.</div>';

  //Destruir session
  session_unset();
  session_destroy();
}elseif($erro == "ERROFATAL"){
  echo '<div class="alert alert-danger" id="rcorners2" role="alert"><b>UMA TENTATIVA DE ACESSO NÃO AUTORIZADO FOI DETECTADA E REGISTRADA.</b><br>Para continuar informe novamente seu nome de usuário e senha.</div>';
  
  //Gravar Log
  $_SESSION['log'] = "403";
  require("logs/gravarlogs.php");

  //Destruir session
  session_unset();
  session_destroy();
}elseif($erro == "INATIVA"){
  echo '<div class="alert alert-danger" id="rcorners2" role="alert"><b>CONTA DESATIVADA.</b><br>Por favor entre em contato com o administrador do sistema.</div>';

  //Gravar Log
  $_SESSION['log'] = "INATIVA";
  require("logs/gravarlogs.php");

  //Destruir session
  session_unset();
  session_destroy();
}elseif($erro == "ERROBANCO"){
  echo '<div class="alert alert-danger" id="rcorners2" role="alert"><b>ERRO DE CONEXÃO AO BANCO MYSQL.</b><br>Houve um erro de conexão com o Banco de Dados MySQL: <b>' . $_SESSION["ERROBANCO"] . '</b></div>';
  
  //Gravar Log
  $_SESSION['log'] = "ERROBANCO";
  require("logs/gravarlogs.php");
  
  //Destruir session
  session_unset();
  session_destroy();
}
?>