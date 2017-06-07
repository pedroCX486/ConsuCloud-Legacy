<?php
    //Sistema de Logging

    //Configurar Timezone
    date_default_timezone_set('America/Recife');
    
    //Fazer request pelo IP do client (nem sempre retorna o IP real)
    $ip = $_SERVER['REMOTE_ADDR'];
    
    //Buscar por Username (se aplicável) e aplicar a string do log
    if(!isset($_SESSION["username"]) && $ip == ""){
        $user = "Sem Username/Sem IP";
    }elseif($ip == ""){
        $user = $_SESSION["username"];
    }elseif($_SESSION['username'] == ""){
        $user = "Sem Username - " . $ip;
    }else{
        $user = $_SESSION["username"] . " - " . $ip;
    }
    
    //Processar tipo de Log
    if($_SESSION['log'] == "Login"){
        $log = "Login Efetuado - Usuário/IP: " . $user . " - Data/Hora: " . date('d/m/Y - h:i:s a', time()) . "\r\n";
    }elseif($_SESSION['log'] == "403"){
        $log = "Acesso Não Autorizado - Usuário/IP: " . $user . " - Data/Hora: " . date('d/m/Y - h:i:s a', time()) . "\r\n";
    }elseif($_SESSION['log'] == "Upload"){
        $log = "Upload Executado - Usuário/IP: " . $user . " - Data/Hora: " . date('d/m/Y - h:i:s a', time()) . "\r\n";
    }elseif($_SESSION['log'] == "Banco"){
        $log = "Erro de Conexão ao Banco de Dados - Usuário/IP: " . $user . " - Data/Hora: " . date('d/m/Y - h:i:s a', time()) . ' - ' . $_SESSION["ERROBANCO"] . "\r\n";
    }
    
    //Gravar o log
    //$BaseDir = getcwd();
    $logfile = fopen("{$_SERVER['DOCUMENT_ROOT']}/logs/logs.txt", 'a');
    fwrite($logfile, $log);
    fclose($logfile);

?>