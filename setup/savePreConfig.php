<?php
header ('Content-type: text/html; charset=UTF-8');
session_start();

$diretorioInstalacao = $_POST['diretorioInstalacao'];

if($diretorioInstalacao == "/"){
	$_SESSION['diretorioInstalacao'] = "/";
}else{
	$_SESSION['diretorioInstalacao'] = $diretorioInstalacao;
}

echo '<script type="text/javascript">
				location.href="passo1.php";
			</script>';

?>