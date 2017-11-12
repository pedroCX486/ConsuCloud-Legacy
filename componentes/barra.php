<!--Corpo da Barra-->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a target="navegador" class="navbar-brand" href="../dashboards/dashboard.php">
        <img alt="ConsuCloud" src="../assets/brand.png">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a target="navegador" href="../dashboards/dashboard.php">Início
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">

            <!-- Filtrando Menu de Cadastros -->
            <?php
              if($_SESSION["isAdmin"] == true || $_SESSION["isSecretaria"] == true){
                echo '<li><a target="navegador" href="../pacientes/pacientes.php">Pacientes</a></li>';
                echo '<li><a target="navegador" href="../consultas/consultas.php">Consultas</a></li>';
              }elseif($_SESSION["isMedico"] == true){
                echo '<li><a target="navegador" href="../prontuarios/prontuarios.php">Prontuários</a></li>';
                echo '<li><a target="navegador" href="../exames/exames.php">Exames</a></li>';
              }
            ?>

          </ul>
        </li>

        <!-- Filtrando Receituário -->
        <?php
          if($_SESSION["isMedico"] == true){
            echo '<li><a target="navegador" href="../receituario/receituario.php">Receituário</a></li>';
          }
        ?>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION["username"]; ?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">

            <!-- Filtrando Menu de Usuário/Configurações -->
            <?php
                if($_SESSION["isAdmin"] == true){
                  echo'<li><a target="navegador" href="../usuarios/usuarios.php">Usuários</a></li>';
                  echo'<li><a target="navegador" href="../planos/planos.php">Planos de Saúde</a></li>';
                  echo'<li><a target="navegador" href="../config/config.php">Configurações</a></li>';
                  echo'<li><a target="navegador" href="../logs/logs.php">Logs</a></li>';
                  echo'<li role="separator" class="divider"></li>';
                }
              ?>
              <li>
                <a target="navegador" href="../ajuda.php">Ajuda</a>
              </li>
              <li>
                <a target="navegador" href="../reportar.php">Reportar um Erro</a>
              </li>
              <li>
                <a target="navegador" href="../sobre.php">Sobre o ConsuCloud</a>
              </li>

              <!-- Filtrando Agenda e Histórico de Consulta -->
              <?php
                if($_SESSION["isMedico"] == true){
                  echo '<li role="separator" class="divider"></li>';
                  echo '<li><a target="navegador" href="../agenda.php">Agenda</a></li>';
                  echo '<li><a target="navegador" href="../historico/historico_medico.php">Histórico de Consultas</a></li>';
                }elseif($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true){
                  echo '<li role="separator" class="divider"></li>';
                  echo '<li><a target="navegador" href="../historico/historico_secretaria.php">Histórico de Consultas</a></li>';
                  echo '<li><a target="navegador" href="../relatorio/relatorio.php">Relatório de Consultas</a></li>';
                }
              ?>
              <li role="separator" class="divider"></li>
              <li>
                <a href="../logout.php">Sair</a>
              </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>