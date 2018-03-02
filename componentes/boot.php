<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Carregando o Favicon -->
<link rel="icon" href="<?php echo $_SESSION["installAddress"]; ?>/assets/favicon.ico" type="image/x-icon"/>

<!-- Carregando a Folha de Estilos Base -->
<link rel="stylesheet" href="<?php echo $_SESSION["installAddress"]; ?>/componentes/estilos.css">

<?php
if($_SESSION["tema"] == "consucloud"){
  include $_SESSION["installFolder"].'/componentes/temas/consucloud/bootTheme.php';
}elseif($_SESSION["tema"] == "mustang"){
  include $_SESSION["installFolder"].'/componentes/temas/mustang/bootTheme.php';
}
?>

<!-- Gambiarra pra Evitar Usuários de Fazerem Merda -->
<script src="<?php echo $_SESSION["installAddress"]; ?>/componentes/anchorKidnap.js"></script>

<!-- Impedir CTRL-Click -->
<script src="<?php echo $_SESSION["installAddress"]; ?>/componentes/noCtrlClick.js"></script>