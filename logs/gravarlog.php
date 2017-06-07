<?php
    //Sistema de Logging

    //Configurar Timezone
    date_default_timezone_set('America/Recife');
    
    //Buscar por Username e/ou IP
    if($_SESSION['username'] == ""){
        $user = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }elseif($_SERVER['HTTP_X_FORWARDED_FOR'] == ""){
        $user = $_SESSION["username"];
    }elseif(empty($_SESSION) && $_SERVER['HTTP_X_FORWARDED_FOR'] == ""){
        $user = "Sem Username/Sem IP";
    }else{
        $user = $_SESSION["username"] . " - " . $_SERVER['HTTP_X_FORWARDED_FOR'];
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