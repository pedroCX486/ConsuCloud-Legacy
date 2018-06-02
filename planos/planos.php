<?php
session_start();

if(!$_SESSION["isAdmin"] || empty($_SESSION["idUsuario"])){
  include("../componentes/redirect.php");
}

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

require($_SESSION["installFolder"]."componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Planos de Saúde - ConsuCloud</title>

   <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>
  
    <div class="container">
      <div class="jumbotron">

        <h1>Planos de Saúde</h1>

        <a class="anchor" href="cadastrarplanos.php"><button class="btn btn-raised btn-success pull-right">CADASTRAR NOVO PLANO</button></a>

        <p>Planos cadastrados:</p>

        <br><br>

        <center>
          <table id="rcorners1" class="tg table-hover">
            <tr>
              <th class="titulos">NOME</th>
              <th class="titulos">TELEFONE</th>
              <th class="titulos">EMAIL</th>
              <th class="titulos">INFORMAÇÕES</th>
              <th class="titulos"></th>
            </tr>
            <?php
              $select = $mysqli->query("SELECT * FROM planos");
              $row = $select->num_rows;
              if($row){
                while($get = $select->fetch_array()){
            ?>
            <tr>
              <td class="tg-yw4l">
                <?php echo $get['nomePlano']; ?>
              </td>
              <td class="tg-yw4l">
                <?php echo $get['telFixo']; ?>
              </td>
              <td class="tg-yw4l">
                <?php echo $get['email']; ?>
              </td>
              <td class="tg-yw4l">
                <?php echo $get['infoPlano']; ?>
              </td>
              <td class="tg-yw4l">
                <a class="anchor" href="editarplanos.php?editar=<?php echo $get['idPlano']; ?>" title="Editar Plano"><span class="glyphicon glyphicon-pencil" aria-hidden="true" /></a>
              </td>
            </tr>
            <?php
                }
              }else{echo '<b>Não existem planos cadastrados.</b>';}
            ?>
          </table>
        </center>

      </div>
    </div>

  </body>

  </html>