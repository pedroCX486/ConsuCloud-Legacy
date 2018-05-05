<?php
include $_SESSION["installFolder"]."componentes/boot.php";

$diretorio = basename(dirname(__FILE__));
$diretorio = str_replace("setup", "", $diretorio);
if(empty($diretorio)){
  $diretorio = "/";
}else{
  $diretorio = $diretorio."/";
}
?>


  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title>ConsuCloud</title>
  </head>

  <style>
    body {
      margin-top: 30px;
    }
    
    div.input-group {
      margin-bottom: 5px;
    }
  </style>

  <body>

    <div class="container">
      <div class="jumbotron">

        <p>
          <center><img src="<?php echo $_SESSION["installAddress"]; ?>assets/minibrand.png" align="right"></center>
        </p>
        <br><br>

        <form method="post" action="savePreConfig.php">
          <p>
            <h2>
              Antes de começarmos...<br><small>O ConsuCloud detectou que foi instalado no diretório abaixo. Está correto?</small>
          </h2>
          </p>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"></span>
            <input required type="text" class="form-control" aria-describedby="basic-addon1" name="diretorioInstalacao" value="<?php echo $diretorio; ?>">
          </div>
          <br><br>

          <br><br>
          <button type="submit" class="btn btn-raised btn-primary btn-lg pull-right">Passo 1 >></button>
          <br>

        </form>
      </div>
    </div>

  </body>

  </html>