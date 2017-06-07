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

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Versão do Servidor HTTP</h3>
  </div>
  <div class="panel-body">
    <?php echo apache_get_version(); ?>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Status do Sistema</h3>
  </div>
  <div class="panel-body">
    <?php
      if(apache_get_version() && $_SESSION["isDebug"] == false){echo "<span class='label label-success'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> OK</span>";}
      elseif($_SESSION["isDebug"] == true){echo "<span class='label label-warning'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Sistema sendo executado em modo Debug. Suas ações aqui podem ser perigosas.</span>";}
    ?>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Registro de Logs</h3>
  </div>
  <div class="panel-body">
    <div id="log" style="overflow-y: scroll; height: 100px;">
      <?php
        if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/logs/logs.txt")){
          $logfile = fopen("{$_SERVER['DOCUMENT_ROOT']}/logs/logs.txt","r");
          while ($line = fgets($logfile)) {
            echo($line) . '<br> ';
          }
          fclose($logfile);
        }else{
          echo "Não existem logs gravados.";
        }
      ?>
    </div>
    <!--Animar Scroll -->
    <script>$("#log").animate({ scrollTop: $('#log')[0].scrollHeight}, 1000);</script>
  </div>
</div>

