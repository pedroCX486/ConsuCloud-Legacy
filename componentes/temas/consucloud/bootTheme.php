<!-- Material Design Theme -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.min.css" crossorigin="anonymous"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js" crossorigin="anonymous"></script>

<!-- Ripples Effect -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css" crossorigin="anonymous"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js" crossorigin="anonymous"></script>

<!-- Roboto Font -->
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" crossorigin="anonymous"/>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons" crossorigin="anonymous"/>

<?php
//Só inicializar o MD dentro do sistema
if($_SERVER['PHP_SELF'] != '/index.php'){
  echo '<script src="'.$_SESSION["installAddress"].'componentes/temas/consucloud/materialInit.js"> </script>';
}
?>

<!-- Folha de Estilos do Tema -->
<link rel="stylesheet" href="<?php echo $_SESSION["installAddress"]; ?>componentes/temas/consucloud/consucloud.css">