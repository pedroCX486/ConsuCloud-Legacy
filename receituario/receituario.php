<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Receituário - ConsuCloud</title>

  <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

    <div>

      <div class="container">
        <div class="jumbotron">
          <h1>Receituário</h1>
          <br>
          <p>

            <div id="infocheck">
              <b>Informações do Médico:</b><br> Dr. Fulano ---
              <b>Informações do Consultório:</b> Consultório -----
            </div>

            <form action="" method="post" target="_blank">
              <textarea required name="prontuario" class="form-control" rows="10" cols="5" wrap="hard" maxlength="1632"></textarea>
              <br>
              <center><button type="submit" class="btn btn-raised btn-primary btn-lg">IMPRIMIR</button></center>
            </form>

          </p>
          <br>
        </div>
      </div>

    </div>
  </body>

  </html>