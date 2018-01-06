<?php
header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set('America/Recife');
require("../componentes/db/connect.php");

if(file_exists("generated/backup_consucloud.zip")){
  unlink('../backup/generated/backup_consucloud.zip');
}
if(file_exists("generated/backup_info.txt")){
  unlink('../backup/generated/backup_info.txt');
}

/** Abrir Permissão para Escrever em Arquivos**/
$result .= $mysqli->query("GRANT FILE ON *.* TO 'root'@'localhost'");

/** Backup da Base de Dados **/
$file = $_SERVER['DOCUMENT_ROOT']."/backup/generated/configs.sql";
$result .= $mysqli->query("SELECT * FROM configs INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/generated/consultas.sql";
$result .= $mysqli->query("SELECT * FROM consultas INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/generated/exames.sql";
$result .= $mysqli->query("SELECT * FROM exames INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/generated/logs.sql";
$result .= $mysqli->query("SELECT * FROM logs INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/generated/pacientes.sql";
$result .= $mysqli->query("SELECT * FROM pacientes INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/generated/planos.sql";
$result .= $mysqli->query("SELECT * FROM planos INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/generated/prontuarios.sql";
$result .= $mysqli->query("SELECT * FROM prontuarios INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/generated/usuarios.sql";
$result .= $mysqli->query("SELECT * FROM usuarios INTO OUTFILE '$file'");

/** Fazer Backup dos Arquivos de Exames **/
$zipexames = '../backup/generated/backup_exames.zip';
$examesdir = $_SERVER['DOCUMENT_ROOT']."/exames/arquivos";
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
$zipcompleto = '../backup/generated/backup_consucloud.zip';
$backupdir = $_SERVER['DOCUMENT_ROOT']."/backup/generated";
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
unlink('../backup/generated/backup_exames.zip');
unlink('../backup/generated/configs.sql');
unlink('../backup/generated/consultas.sql');
unlink('../backup/generated/exames.sql');
unlink('../backup/generated/logs.sql');
unlink('../backup/generated/pacientes.sql');
unlink('../backup/generated/planos.sql');
unlink('../backup/generated/prontuarios.sql');
unlink('../backup/generated/usuarios.sql');

/** Escrever Informação de Data Sobre o Backup **/
$backupinfo = "../backup/generated/backup_info.txt";
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
    location.href="../backup/gerenciar_backup.php";
  </script>'; 
}else{
  echo '<script type="text/javascript">
    alert("Backup completo efetuado com sucesso! Data do Backup: ' . file_get_contents($backupinfo) . '\n\n' . $status .'");
    location.href="../backup/gerenciar_backup.php";
  </script>'; 
}

?>