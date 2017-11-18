<?php
header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set('America/Recife');
require("../componentes/db/connect.php");

if(file_exists("backup_consucloud.zip")){
  unlink('../backup/backup_consucloud.zip');
}
if(file_exists("backup_info.txt")){
  unlink('../backup/backup_info.txt');
}

/** Abrir Permissão para Escrever em Arquivos**/
$result .= $mysqli->query("GRANT FILE ON *.* TO 'root'@'localhost'");

/** Backup da Base de Dados **/
$file = $_SERVER['DOCUMENT_ROOT']."/backup/configs.sql";
$result .= $mysqli->query("SELECT * FROM configs INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/consultas.sql";
$result .= $mysqli->query("SELECT * FROM consultas INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/exames.sql";
$result .= $mysqli->query("SELECT * FROM exames INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/logs.sql";
$result .= $mysqli->query("SELECT * FROM logs INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/pacientes.sql";
$result .= $mysqli->query("SELECT * FROM pacientes INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/planos.sql";
$result .= $mysqli->query("SELECT * FROM planos INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/prontuarios.sql";
$result .= $mysqli->query("SELECT * FROM prontuarios INTO OUTFILE '$file'");

$file = $_SERVER['DOCUMENT_ROOT']."/backup/usuarios.sql";
$result .= $mysqli->query("SELECT * FROM usuarios INTO OUTFILE '$file'");

/** Fazer Backup dos Arquivos de Exames **/
$zipexames = '../backup/backup_exames.zip';
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
$zipcompleto = '../backup/backup_consucloud.zip';
$backupdir = $_SERVER['DOCUMENT_ROOT']."/backup";
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
unlink('../backup/backup_exames.zip');
unlink('../backup/configs.sql');
unlink('../backup/consultas.sql');
unlink('../backup/exames.sql');
unlink('../backup/logs.sql');
unlink('../backup/pacientes.sql');
unlink('../backup/planos.sql');
unlink('../backup/prontuarios.sql');
unlink('../backup/usuarios.sql');

/** Escrever Informação de Data Sobre o Backup **/
$backupinfo = "../backup/backup_info.txt";
$myfile = fopen($backupinfo, "w");
$txt = date("d-m-Y");
fwrite($myfile, $txt);
fclose($myfile);

/** Preparar Mensagem Básica Sobre Status ou Erro para Debug **/
if($result == 111111111){
  $status = 'Status: 200 - Sucesso';
}else{
  $status = 'Erro - Código: ' . $result;
}

/** Exibir PopUp e Finalizar **/
echo '<script type="text/javascript">
          alert("Backup efetuado com sucesso com data: ' . file_get_contents($backupinfo) . '\n\n' . $status .'");
          location.href="../backup/gerenciar_backup.php";
      </script>';
?>