<?php
session_start();

require($_SESSION["installFolder"]."/componentes/sessionbuster.php");

if(empty($_SESSION)){
  echo "<script>top.window.location = '".$_SESSION["installAddress"]."/index.php?erro=ERROFATAL'</script>";
  die;
}

$idUsuario = $_SESSION['idUsuario'];

require($_SESSION["installFolder"]."/componentes/db/connect.php");

$select = $mysqli->query("SELECT * FROM usuarios WHERE idUsuario = $idUsuario");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    $tema = $get['tema'];
  }
  
  $mysqli->close();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Personalização - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."/componentes/boot.php";?>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."/componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      <h1>Personalização</h1>
      <a class="anchor" href="<?php echo $_SESSION["installAddress"]; ?>/dashboards/dashboard.php">
        <button class="btn btn-raised btn-danger pull-right">VOLTAR AO INÍCIO</button>
      </a>
      <p>Aqui você pode mudar o tema do sistema.</p>
      <br>
      <p>

        <form method="post" action="salvar.php">

				<center>
				
				<input type="radio" name="tema" value="consucloud" <?php if($tema == "consucloud"){echo 'checked';}?>> ConsuCloud &nbsp;
  			<input type="radio" name="tema" value="mustang" <?php if($tema == "mustang"){echo 'checked';}?>> Mustang<br>
				
				<br>

				<button type="submit" class="btn btn-raised btn-primary btn-lg">SALVAR</button>
			
				</center>

        </form>

      </p>
      <br>

    </div>
  </div>

</body>

</html>