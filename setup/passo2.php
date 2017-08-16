<?php
include "../componentes/boot.php";
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
          <center><img src="../assets/minibrand.png" align="right"></center>
        </p>
        <br><br>

        <form method="post" action="passo2executar.php">
          <p>
            Agora vamos configurar o usuário Administrador do sistema. Com ele você gerenciará outros usuários e configurações do ConsuCloud. <br><br>Lembre-se de anotar os dados desta tela num lugar seguro!
            <br>
            <br>
            <br><br>O nome de usuário é fixo e sempre será <b>SysAdmin</b>. Qual será a senha dele?*
          </p>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"></span>
            <input required type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" name="senha" maxlength="100">
          </div>
          <br><br>

          <p>
            Qual email em que o Administrador pode ser contactado?*
          </p>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"></span>
            <input required type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" name="email" maxlength="100">
          </div>

          <br><br>
          <button required type="submit" class="btn btn-raised btn-primary btn-lg pull-right">Passo 2 >></button>
          <br>

        </form>
      </div>
    </div>

  </body>

  </html>