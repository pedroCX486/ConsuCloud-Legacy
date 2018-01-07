<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>

<!-- Material Design -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.min.css" crossorigin="anonymous"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css" crossorigin="anonymous"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" crossorigin="anonymous"/>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons" crossorigin="anonymous"/>

<?php
//Só inicializar o MD dentro do sistema
if($_SERVER['PHP_SELF'] != '/index.php'){
  echo '<script src="https://'.$_SERVER['HTTP_HOST'].'/componentes/materialInit.js"> </script>';
}
?>

<!-- Carregando o Favicon -->
<link rel="icon" href="https://<?php echo $_SERVER['HTTP_HOST'];?>/assets/favicon.ico" type="image/x-icon"/>

<!-- Carregando a Folha de Estilos -->
<link rel="stylesheet" href="https://<?php echo $_SERVER['HTTP_HOST'];?>/componentes/estilos.css">

<!-- Gambiarra pra Evitar Usuários de Fazerem Merda -->
<script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/componentes/anchorKidnap.js"></script>

<!-- Impedir CTRL-Click -->
<script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/componentes/noCtrlClick.js"></script>