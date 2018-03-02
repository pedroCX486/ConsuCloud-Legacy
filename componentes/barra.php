<!--Corpo da Barra-->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo $_SESSION["installAddress"]; ?>dashboards/dashboard.php">
        <img alt="ConsuCloud" src="<?php echo $_SESSION["installAddress"]; ?>assets/brand.png">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a href="<?php echo $_SESSION["installAddress"]; ?>dashboards/dashboard.php">Início
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
                echo '<li><a class="anchor" href="'.$_SESSION["installAddress"].'pacientes/pacientes.php">Pacientes</a></li>';
                echo '<li><a class="anchor" href="'.$_SESSION["installAddress"].'consultas/consultas.php">Consultas</a></li>';
              }elseif($_SESSION["isMedico"] == true){
                echo '<li><a class="anchor" href="'.$_SESSION["installAddress"].'prontuarios/prontuarios.php">Prontuários</a></li>';
                echo '<li><a class="anchor" href="'.$_SESSION["installAddress"].'exames/exames.php">Exames</a></li>';
              }
            ?>

          </ul>
        </li>
        
        <!-- Filtrando Receituário -->
        <?php
          if($_SESSION["isMedico"] == true){
            echo '
              <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Receituário
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                   <li><a class="anchor" href="'.$_SESSION["installAddress"].'receituario/receitas.php">Gerenciamento de Receitas</a></li>
                    <li><a class="anchor" href="'.$_SESSION["installAddress"].'receituario/receitamanual.php">Receita Manual</a></li>
                </ul>
              </li>
            ';
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
                  echo'<li><a class="anchor" href="'.$_SESSION["installAddress"].'usuarios/usuarios.php">Usuários</a></li>';
                  echo'<li><a class="anchor" href="'.$_SESSION["installAddress"].'planos/planos.php">Planos de Saúde</a></li>';
                  echo'<li><a class="anchor" href="'.$_SESSION["installAddress"].'config/config.php">Configurações</a></li>';
                  echo'<li><a class="anchor" href="'.$_SESSION["installAddress"].'logs/logs.php">Logs</a></li>';
                  echo'<li><a class="anchor" href="'.$_SESSION["installAddress"].'backup/gerenciar_backup.php">Backup</a></li>';
                  echo'<li role="separator" class="divider"></li>';
                }
              ?>

              <!-- Filtrando Agenda e Histórico de Consulta -->
              <?php
                if($_SESSION["isMedico"] == true){
                  echo '<li><a class="anchor" href="'.$_SESSION["installAddress"].'agenda.php">Agenda</a></li>';
                  echo '<li><a class="anchor" href="'.$_SESSION["installAddress"].'historico/historico_medico.php">Histórico de Consultas</a></li>';
                }elseif($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true){
                  echo '<li><a class="anchor" href="'.$_SESSION["installAddress"].'historico/historico_secretaria.php">Histórico de Consultas</a></li>';
                  echo '<li><a class="anchor" href="'.$_SESSION["installAddress"].'relatorio/relatorio.php">Relatório de Consultas</a></li>';
                }
              ?>
            
              <!-- Opções básicas do Sistema -->
              <li role="separator" class="divider"></li>
              <li>
                <a class="anchor" href="<?php echo $_SESSION["installAddress"]; ?>usuarios/personalizacao/personalizacao.php">Personalização</a>
              </li>
              <li role="separator" class="divider"></li>
              <li>
                <a class="anchor" href="<?php echo $_SESSION["installAddress"]; ?>ajuda.php">Ajuda</a>
              </li>
              <li>
                <a class="anchor" href="<?php echo $_SESSION["installAddress"]; ?>reportar.php">Reportar um Erro</a>
              </li>
              <li>
                <a class="anchor" href="<?php echo $_SESSION["installAddress"]; ?>sobre.php">Sobre o ConsuCloud</a>
              </li>
            
              <li role="separator" class="divider"></li>
              <li>
                <a class="anchor" href="<?php echo $_SESSION["installAddress"]; ?>logout.php">Sair</a>
              </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>