<?php
header('Content-type: text/html; charset=UTF-8');
session_start();
  
unset($_SESSION["WIZARD_paciente"]);
unset($_SESSION["WIZARD_data"]);
unset($_SESSION["WIZARD_hora"]);
unset($_SESSION["WIZARD_start"]);

 echo '<script type="text/javascript">
          alert("Modo guiado encerrado.");
          location.href="'.$_SESSION["installAddress"].'dashboards/dashboard.php";
        </script>';
?>