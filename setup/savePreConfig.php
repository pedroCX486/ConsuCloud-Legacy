<?php
header ('Content-type: text/html; charset=UTF-8');
session_start();

$diretorioInstalacao = $_POST['diretorioInstalacao'];

if($diretorioInstalacao == "/"){
	$_SESSION['diretorioInstalacao'] = "/";
}else{
	$_SESSION['diretorioInstalacao'] = $diretorioInstalacao;
}

$fp = fopen('../componentes/installdir.php', 'w');
fwrite($fp, '<?php $installDir ="'.$diretorioInstalacao.'"; ?>');
fclose($fp);

echo '<script type="text/javascript">
				location.href="passo1.php";
			</script>';

?>