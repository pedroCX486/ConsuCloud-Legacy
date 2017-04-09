<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Exames - ConsuCloud</title>

   <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Exames</h1>
      <a href="cadastrarexames.php"><button class="btn btn-raised btn-success pull-right">Novo Exame</button></a>

      <p>Consultar exame:</p>

      <div class="buscar">
        <form method="get" action="exames.php">
          <div class="form-group">
            <select required name="paciente" class="form-control">
              <option disabled selected value="">Selecione o paciente ▾</option>
            </select>
          </div>

          <br>

          <center><button type="submit" class="btn btn-raised btn-info">Buscar Exames</button></center>
        </form>
      </div>

      <br><br>
      

    </div>
  </div>

</body>

</html>
