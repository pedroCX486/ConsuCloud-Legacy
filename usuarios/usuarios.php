<?php
require("../assets/connect.php");

session_start();

if($_SESSION["isSecretaria"] == true || $_SESSION["isMedico"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title>Usuários - ConsuCloud</title>

   <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

    <div class="container">
      <div class="jumbotron">

        <h1>Usuários</h1>

        <a href="cadastrarusuarios.php"><button class="btn btn-raised btn-success pull-right">CADASTRAR NOVO USUÁRIO</button></a>

        <p>Usuário cadastrados:</p>
        <br><br>

        <center>
          <table id="rcorners1" class="tg">
            <tr>
              <td class="titulos">TIPO DE CONTA</td>
              <td class="titulos">NOME</td>
              <td class="titulos">ATUAÇÃO</td>
              <td class="titulos">CRM/CPF</td>
              <td class="titulos">TELEFONE</td>
              <td class="titulos">EMAIL</td>
              </b>
            </tr>
            <?php
              $select = $mysqli->query("SELECT * FROM usuarios WHERE crm REGEXP '^-?[0-9]+$';");
              $row = $select->num_rows;
              if($row){
                while($get = $select->fetch_array()){
            ?>
              <tr>
                <td class="tg-yw4l">
                  <?php if($get['tipoUsuario'] == 'medico'){echo "Médico";} else{echo "Secretária";} ?>
                </td>
                <td class="tg-yw4l">
                  <?php echo $get['nomeCompleto']; ?>
                </td>
                <td class="tg-yw4l">
                  <?php echo $get['areaAtuacao']; ?>
                </td>
                <td class="tg-yw4l">
                  <?php echo $get['crm']; ?>
                </td>
                <td class="tg-yw4l">
                  <?php echo $get['telCel']; ?>
                </td>
                <td class="tg-yw4l">
                  <?php echo $get['email']; ?>
                </td>
                <td class="tg-yw4l">
                  <a href="editarusuarios.php?idUsuario=<?php echo $get['idUsuario']; ?>" title="Editar Usuário"><span class="glyphicon glyphicon-pencil" aria-hidden="true" /></a>
                </td>
              </tr>
              <?php
               }
                }else{echo '<b>Não existem usuários cadastrados.</b>';}
             ?>
          </table>
        </center>

      </div>
    </div>

  </body>

  </html>
