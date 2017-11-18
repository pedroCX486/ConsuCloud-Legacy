<?php
session_start();

require("../componentes/sessionbuster.php");

if(!$_SESSION["isAdmin"]){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}elseif(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Ajuda - ConsuCloud</title>

  <?php include "../componentes/boot.php";?>
</head>

<body>

  <div class="container">
    <div class="jumbotron">
      <h1>Backup do Sistema</h1>
      <p>Execute aqui um backup completo do sistema.</p>

      <?php
        $backupinfo = "../backup/backup_info.txt";
        
        if (file_exists($backupinfo)) {
          echo '<center>
          <br><br>
          Existe um backup com a data ' . file_get_contents($backupinfo) . '.
          <br><br>
          <a target="_blank" href="../componentes/contentdelivery.php?arquivo=backup_consucloud.zip&backup=true">
            <button class="btn btn-raised btn-info btn-lg">FAZER DOWNLOAD DO BACKUP</button>
          </a>
          </center>';
        }
      ?>

      <br><br>
      <center>
        <a href="executar_backup.php" target="navegador">
            <button class="btn btn-raised btn-primary btn-lg">EXECUTAR NOVO BACKUP</button>
        </a>
      </center>

      <br>

    </div>
  </div>

</body>

</html>