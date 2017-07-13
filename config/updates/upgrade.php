<?php
header ('Content-type: text/html; charset=UTF-8');

$zip = new ZipArchive;
$zip->open('deploy.zip');

if($zip->extractTo("updateVerify") === TRUE){
    echo '<script type="text/javascript">
                        alert("Pacote de atualização inválido, tente novamente mais tarde ou contacte a equipe de suporte.");
                        location.href="/config/config.php";
          </script>';
      
    array_map('unlink', glob("updateVerify/*.*"));
    rmdir("updateVerify");
}elseif($zip->extractTo("updateVerify") === FALSE && $zip->setPassword("C0Sult8r10sp8wnom4yhemsoftw8ks") === TRUE && $zip->extractTo($_SERVER['DOCUMENT_ROOT']) === TRUE){
    array_map('unlink', glob("updateVerify/*.*"));
    rmdir("updateVerify");

    $zip->close();

    $versionfile = file($_SERVER['DOCUMENT_ROOT']."/version.txt");
    $version = preg_replace('/\s+/', '', $versionfile[0]);

    unlink($_SERVER['DOCUMENT_ROOT']."/version.txt");
    unlink($_SERVER['DOCUMENT_ROOT']."/config/updates/deploy.zip");

    //Conexão com db
    require $_SERVER['DOCUMENT_ROOT']."/assets/connect.php";

    //Executar query
    $query = $mysqli->query("UPDATE configs SET version = '$version'");

    if($query){
    echo '<script type="text/javascript">
                        alert("Atualização realizada com sucesso.\n\nVersão: '. $version .'");
                        location.href="/config/config.php";
                    </script>';
    }else{
    echo $mysqli->error;
    }

    $mysqli->close();
}else{
    echo '<script type="text/javascript">
                        alert("Ocorreu um erro durante a atualização, tente novamente mais tarde ou contacte a equipe de suporte.");
                        location.href="/config/config.php";
                    </script>';
    array_map('unlink', glob("updateVerify/*.*"));
    rmdir("updateVerify");
}
?>