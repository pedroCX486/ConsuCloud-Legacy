<?php
require("componentes/db/connect.php");

date_default_timezone_set('America/Recife');

session_start();

$idUsuario = $_SESSION["idUsuario"];

if(empty($_SESSION)){
    echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
    die;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>ConsuCloud</title>

   <?php include "componentes/boot.php";?>

   <script>

    $(document).ready(function() {
        currentLocation = localStorage.prevUrl || 'painel.php';

        $('#navegador').attr('src', currentLocation);
        $('#navegador').load(function() {
            localStorage.prevUrl = $(this)[0].contentWindow.location.href;
        })
    })

   </script>
</head>

<body class="navbody">

<?php include "componentes/barra.php"; ?>

<iframe id="navegador" name="navegador" allowtransparency="true" frameborder="0" height="100%" width="100%"
style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:90%;width:100%;position:absolute;top:80px;left:0px;right:0px;bottom:0px">
        Seu browser não suporta iframes.
</iframe>

</body>

</html>
