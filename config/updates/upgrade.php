<?php
header ('Content-type: text/html; charset=UTF-8');

$zip = new ZipArchive;

if ($zip->open('deploy.zip') === TRUE) {
    $zip->extractTo($_SERVER['DOCUMENT_ROOT']);
    $zip->close();

    $version = file($_SERVER['DOCUMENT_ROOT']."/version.txt");

    unlink($_SERVER['DOCUMENT_ROOT']."/version.txt");
    unlink($_SERVER['DOCUMENT_ROOT']."/config/updates/deploy.zip");

    //Conexão com db
    require $_SERVER['DOCUMENT_ROOT']."/assets/connect.php";

    //Executar query
    $query = $mysqli->query("UPDATE configs SET version = '$version[0]'");

    if ($query){
    echo '<script type="text/javascript">
                        alert("Atualização realizada com sucesso.\n\nVersão: '. $version[0] .'");
                        location.href="/config/config.php";
                    </script>';
    }else{
    echo $mysqli->error;
    }

    $mysqli->close();
} else {
    echo '<script type="text/javascript">
                        alert("Ocorreu um erro durante a atualização, tente novamente mais tarde ou contacte a equipe de suporte.");
                        location.href="/config/config.php";
                    </script>';
}
?>