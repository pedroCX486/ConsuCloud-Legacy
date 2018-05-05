<?php
session_start();

require($_SERVER['DOCUMENT_ROOT']."/componentes/sessionbuster.php");

if(!$_SESSION["isAdmin"] || empty($_SESSION)){
  echo "<script>top.window.location = '".$_SESSION["installAddress"]."/index.php?erro=ERROFATAL'</script>";
  die;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Ajuda - ConsuCloud</title>

  <?php include $_SERVER['DOCUMENT_ROOT']."/componentes/boot.php";?>
</head>

<body>
  
  <?php include $_SERVER['DOCUMENT_ROOT']."/componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      <h1>Backup do Sistema</h1>
      <p>Execute aqui um backup completo do sistema.</p>

      <?php
        $backupinfo = "../backup/generated/backup_info.txt";
        
        if (file_exists($backupinfo)) {
          echo '<center>
                  <br><br>
                  Existe um backup com a data ' . file_get_contents($backupinfo) . '.
                  <br><br>
                  <a target="_blank" href="'.$_SESSION["installAddress"].'/componentes/contentdelivery.php?arquivo=backup_consucloud.zip&backup=true">
                    <button class="btn btn-raised btn-info btn-lg">FAZER DOWNLOAD DO BACKUP</button>
                  </a>
                </center>';
        }
      ?>

      <br><br>
      <center>
        <a class="anchor" href="executar_backup.php" target="navegador">
          <button class="btn btn-raised btn-primary btn-lg">EXECUTAR NOVO BACKUP</button>
        </a>
      </center>

      <br>

    </div>
  </div>

</body>

</html>