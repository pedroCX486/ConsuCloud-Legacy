<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Relógio do Sistema (GMT-3)</h3>
  </div>
  <div class="panel-body">
    <?php echo date('d/m/Y - H:i'); ?>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Versão do PHP</h3>
  </div>
  <div class="panel-body">
    <?php echo phpversion(); ?>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Versão do Banco de Dados</h3>
  </div>
  <div class="panel-body">
    <?php printf($mysqli->server_info); ?>
  </div>
</div>

<?php
  $query = $mysqli->query("SELECT * FROM logs WHERE dataLog < ( CURDATE() - INTERVAL 365 DAY )");
  if(mysqli_num_rows($query) != 0){
    echo '<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Limpeza de Logs Disponível</h3>
            </div>
            <div class="panel-body">
              Existe uma limpeza de logs anteriores a 365 dias disponível. &nbsp;
              <a href="../componentes/systemcleanup.php?logs=true" target="navegador">
                <button class="btn btn-raised btn-primary btn-sm">EXECUTAR LIMPEZA</button>
              </a>
            </div>
          </div>';
  }
?>