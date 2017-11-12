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