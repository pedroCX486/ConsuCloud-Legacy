<?php
header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set('America/Recife');
require("../componentes/db/connect.php");

/** Informação Sobre a Data do Backup **/
$backupinfo = "../backups/backup.txt";

/** Checar Se Existe Backup **/
if (file_exists($backupinfo)) {
    echo "Já existe um backup com a data " . file_get_contents($backupinfo) . ".";
} else {

    echo "Status: ";

    /** Abrir Permissão para Escrever em Arquivos**/
    $result = $mysqli->query("GRANT FILE ON *.* TO 'root'@'localhost'");

    echo $result;

    /** Backup da Base de Dados **/
    $file = $_SERVER['DOCUMENT_ROOT']."/backups/configs.sql";
    $result = $mysqli->query("SELECT * FROM configs INTO OUTFILE '$file'");

    echo $result;

    $file = $_SERVER['DOCUMENT_ROOT']."/backups/consultas.sql";
    $result = $mysqli->query("SELECT * FROM consultas INTO OUTFILE '$file'");

    echo $result;

    $file = $_SERVER['DOCUMENT_ROOT']."/backups/exames.sql";
    $result = $mysqli->query("SELECT * FROM exames INTO OUTFILE '$file'");

    echo $result;

    $file = $_SERVER['DOCUMENT_ROOT']."/backups/logs.sql";
    $result = $mysqli->query("SELECT * FROM logs INTO OUTFILE '$file'");

    echo $result;

    $file = $_SERVER['DOCUMENT_ROOT']."/backups/pacientes.sql";
    $result = $mysqli->query("SELECT * FROM pacientes INTO OUTFILE '$file'");

    echo $result;

    $file = $_SERVER['DOCUMENT_ROOT']."/backups/planos.sql";
    $result = $mysqli->query("SELECT * FROM planos INTO OUTFILE '$file'");

    echo $result;

    $file = $_SERVER['DOCUMENT_ROOT']."/backups/prontuarios.sql";
    $result = $mysqli->query("SELECT * FROM prontuarios INTO OUTFILE '$file'");

    echo $result;

    $file = $_SERVER['DOCUMENT_ROOT']."/backups/usuarios.sql";
    $result = $mysqli->query("SELECT * FROM usuarios INTO OUTFILE '$file'");

    echo $result;

    /** Fazer Backup dos Arquivos de Exames **/
    $zipexames = '../backups/backup_exames.zip';
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
    $zipcompleto = '../backups/backup_consucloud.zip';
    $backupdir = $_SERVER['DOCUMENT_ROOT']."/backups";
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
    unlink('../backups/backup_exames.zip');
    unlink('../backups/configs.sql');
    unlink('../backups/consultas.sql');
    unlink('../backups/exames.sql');
    unlink('../backups/logs.sql');
    unlink('../backups/pacientes.sql');
    unlink('../backups/planos.sql');
    unlink('../backups/prontuarios.sql');
    unlink('../backups/usuarios.sql');

    /** Escrever Informação de Data Sobre o Backup **/
    $myfile = fopen($backupinfo, "w");
    $txt = date("d-m-Y");
    fwrite($myfile, $txt);
    fclose($myfile);

    echo "<br><br>Backup efetuado com data: " . file_get_contents($backupinfo);
}
?>