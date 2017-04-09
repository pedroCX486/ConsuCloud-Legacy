 <!--Corpo da Barra-->
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="../painel.php">
          <img alt="ConsuCloud" src="../assets/brand.png">
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="../painel.php">Início <span class="sr-only">(current)</span></a></li>
          <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="../pacientes/pacientes.php">Pacientes</a></li>
                <li><a href="../consultas/consultas.php">Consultas</a></li>
                <li><a href="../prontuarios/prontuarios.php">Prontuários</a></li>
                <li><a href="../exames/exames.php">Exames</a></li>
            </ul>
          </li>

         <li><a href="../receituario/receituario.php">Receituário</a></li>


        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION["username"]; ?>
              <span class="caret"></span></a>
              <ul class="dropdown-menu">

                <li><a href="../sobre.php">Sobre o ConsuCloud</a></li>

                <li role="separator" class="divider"></li>
                <li><a href="../index.php">Sair</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>