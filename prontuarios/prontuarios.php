<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Prontuários - ConsuCloud</title>

  <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Prontuários</h1>
      <a href="cadastrarprontuarios.php"><button class="btn btn-raised btn-success pull-right">Novo Prontuário</button></a>

      <p>Consultar prontuário:</p>

      <div class="buscar">
        <form method="get" action="prontuarios.php">
          <div class="form-group">
            <select required name="paciente" class="form-control">
              <option disabled selected value="">Selecione o paciente ▾</option>
            </select>
          </div>

          <br>

          <center><button type="submit" class="btn btn-raised btn-info">Buscar Prontuários</button></center>
        </form>
      </div>

      <br><br>
      
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
              Collapsible Group 1</a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat.</div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
              Collapsible Group 2</a>
            </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat.</div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
              Collapsible Group 3</a>
            </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat.</div>
          </div>
        </div>
      </div>

    </div>
  </div>

</body>

</html>
