<?php
date_default_timezone_set('America/Recife');

//Matar Session se não houver atividade por mais de 30 minutos
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    echo "<script>top.window.location = '".$_SESSION["installAddress"]."logout.php'</script>";
}
$_SESSION['LAST_ACTIVITY'] = time();

//Mudar periodicamente ID da Session para evitar ataques de Session Fixation
if (!isset($_SESSION['SESSION_TIMESTAMP'])) {
    $_SESSION['SESSION_TIMESTAMP'] = time();
} else if (time() - $_SESSION['SESSION_TIMESTAMP'] > 1800) {
    session_regenerate_id(true);
    $_SESSION['SESSION_TIMESTAMP'] = time();
}
?>