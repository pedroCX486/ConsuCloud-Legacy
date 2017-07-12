<?php
header ('Content-type: text/html; charset=UTF-8');

function zip_is_encrypted($filename) {
  $handle = fopen($filename, "rb");
  $contents = fread($handle, 7);
  fclose($handle);
  return $contents[6] == 0x09;
}

var_dump(zip_is_encrypted("deploy.zip"));

exit();

$zip = new ZipArchive;
$zip->open('deploy.zip');

if ($zip->setPassword("C0Sult8r10sp8wnom4yhemsoftw8ks") === TRUE) {
    $zip->extractTo($_SERVER['DOCUMENT_ROOT']);
    $zip->close();

    $versionfile = file($_SERVER['DOCUMENT_ROOT']."/version.txt");
    $version = preg_replace('/\s+/', '', $versionfile[0]);

    unlink($_SERVER['DOCUMENT_ROOT']."/version.txt");
    unlink($_SERVER['DOCUMENT_ROOT']."/config/updates/deploy.zip");

    //Conexão com db
    require $_SERVER['DOCUMENT_ROOT']."/assets/connect.php";

    //Executar query
    $query = $mysqli->query("UPDATE configs SET version = '$version'");

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