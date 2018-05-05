<?php
header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set('America/Recife');
require($_SESSION["installFolder"]."componentes/db/connect.php");

if(file_exists("generated/backup_consucloud.zip")){
  unlink($_SESSION["installFolder"].'/backup/generated/backup_consucloud.zip');
}
if(file_exists("generated/backup_info.txt")){
  unlink($_SESSION["installFolder"].'/backup/generated/backup_info.txt');
}

/** Abrir Permissão para Escrever em Arquivos**/
$result .= $mysqli->query("GRANT FILE ON *.* TO 'root'@'localhost'");

/** Backup da Base de Dados **/
$file = $_SESSION["installFolder"]."backup/generated/configs.sql";
$result .= $mysqli->query("SELECT * FROM configs INTO OUTFILE '$file'");

$file = $_SESSION["installFolder"]."backup/generated/consultas.sql";
$result .= $mysqli->query("SELECT * FROM consultas INTO OUTFILE '$file'");

$file = $_SESSION["installFolder"]."backup/generated/exames.sql";
$result .= $mysqli->query("SELECT * FROM exames INTO OUTFILE '$file'");

$file = $_SESSION["installFolder"]."backup/generated/logs.sql";
$result .= $mysqli->query("SELECT * FROM logs INTO OUTFILE '$file'");

$file = $_SESSION["installFolder"]."backup/generated/pacientes.sql";
$result .= $mysqli->query("SELECT * FROM pacientes INTO OUTFILE '$file'");

$file = $_SESSION["installFolder"]."backup/generated/planos.sql";
$result .= $mysqli->query("SELECT * FROM planos INTO OUTFILE '$file'");

$file = $_SESSION["installFolder"]."backup/generated/prontuarios.sql";
$result .= $mysqli->query("SELECT * FROM prontuarios INTO OUTFILE '$file'");

$file = $_SESSION["installFolder"]."backup/generated/usuarios.sql";
$result .= $mysqli->query("SELECT * FROM usuarios INTO OUTFILE '$file'");

$file = $_SESSION["installFolder"]."backup/generated/receitas.sql";
$result .= $mysqli->query("SELECT * FROM receitas INTO OUTFILE '$file'");

/** Fazer Backup dos Arquivos de Exames **/
$zipexames = $_SESSION["installFolder"].'/backup/generated/backup_exames.zip';
$examesdir = $_SESSION["installFolder"]."exames/arquivos";
$zip = new ZipArchive();
$zip->open($zipexames, ZipArchive::CREATE | ZipArchive::OVERWRITE);

/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
  new RecursiveDirectoryIterator($examesdir),
  RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
  if (!$file->isDir())
  {
    $filePath = $file->getRealPath();
    $relativePath = substr($filePath, strlen($examesdir) + 1);

    $zip->addFile($filePath, $relativePath);
  }
}
$zip->close();


/** Zipar Backup Completo do Sistema **/
$zipcompleto = $_SESSION["installFolder"].'/backup/generated/backup_consucloud.zip';
$backupdir = $_SESSION["installFolder"].'/backup/generated';
$zip = new ZipArchive();
$zip->open($zipcompleto, ZipArchive::CREATE | ZipArchive::OVERWRITE);

/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
  new RecursiveDirectoryIterator($backupdir),
  RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
  if (!$file->isDir())
  {
    $filePath = $file->getRealPath();
    $relativePath = substr($filePath, strlen($backupdir) + 1);

    $zip->addFile($filePath, $relativePath);
  }
}
$zip->close();

/** Sanitizar Sistema **/
unlink($_SESSION["installFolder"].'/backup/generated/backup_exames.zip');
unlink($_SESSION["installFolder"].'/backup/generated/configs.sql');
unlink($_SESSION["installFolder"].'/backup/generated/consultas.sql');
unlink($_SESSION["installFolder"].'/backup/generated/exames.sql');
unlink($_SESSION["installFolder"].'/backup/generated/logs.sql');
unlink($_SESSION["installFolder"].'/backup/generated/pacientes.sql');
unlink($_SESSION["installFolder"].'/backup/generated/planos.sql');
unlink($_SESSION["installFolder"].'/backup/generated/prontuarios.sql');
unlink($_SESSION["installFolder"].'/backup/generated/usuarios.sql');
unlink($_SESSION["installFolder"].'/backup/generated/receitas.sql');

/** Escrever Informação de Data Sobre o Backup **/
$backupinfo = "$_SESSION["installFolder"]./backup/generated/backup_info.txt";
$myfile = fopen($backupinfo, "w");
$txt = date("d-m-Y");
fwrite($myfile, $txt);
fclose($myfile);

/** Preparar Mensagem Básica Sobre Status ou Erro para Debug **/
if($result == 111111111){
  $status = 'Status: 200 - Sucesso';
}else{
  $erro = true;
}

/** Exibir PopUp e Finalizar **/
if($erro){
  echo '<script type="text/javascript">
    alert("Erro ao executar backup completo! Código do Erro: ' . $result .'");
    location.href="'.$_SESSION["installAddress"].'backup/gerenciar_backup.php";
  </script>'; 
}else{
  echo '<script type="text/javascript">
    alert("Backup completo efetuado com sucesso! Data do Backup: ' . file_get_contents($backupinfo) . '\n\n' . $status .'");
    location.href="'.$_SESSION["installAddress"].'backup/gerenciar_backup.php";
  </script>'; 
}

?>