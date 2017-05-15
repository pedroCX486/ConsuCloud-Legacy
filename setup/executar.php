<?php
header('Content-type: text/html; charset=UTF-8');

//Buscar dados para conexão
require "../assets/dblogin.php";

$mysqli = new mysqli($serverAddr, $username, $pwd, $db);

if ($mysqli->connect_errno) {
	
	$mysqli = new mysqli($serverAddr, $username, $pwd, "mysql");
	$query = $mysqli->query("CREATE DATABASE $db CHARACTER SET utf8 COLLATE utf8_unicode_ci;");
	echo $mysqli->error;
	if($query){echo '<script type="text/javascript">location.href="executar.php";</script>';}
	
  printf("Connect failed: %s\n", $mysqli->connect_error);
}

/* change character set to utf8 */
if (!$mysqli->set_charset("utf8")) {
    //printf("Error loading character set utf8: %s\n", $mysqli->error);
    $mysqli->error;
    exit();
} else {
    //printf("Current character set: %s\n", $mysqli->character_set_name());
    $mysqli->character_set_name();
}

$query1 = $mysqli->query("CREATE TABLE `configs` (
	`nomeConsultorio` VARCHAR(150) NOT NULL COLLATE 'utf8_unicode_ci',
	`telefone` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`logotipo` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_logradouro` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_numero` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_complemento` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_bairro` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cidade` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cep` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_estado` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`nomeConsultorio`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;");

$query2 = $mysqli->query("CREATE TABLE `usuarios` (
	`crm` VARCHAR(20) NOT NULL,
	`tipoUsuario` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`nomeComp` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`areaAtuacao` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`nomeCurto` VARCHAR(25) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`dataNasc` DATE NULL DEFAULT NULL,
	`telFixo` VARCHAR(11) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`telCel` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`numIdRG` VARCHAR(20) NULL DEFAULT NULL,
	`RG_UFEXP` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_logradouro` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_numero` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_complemento` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_bairro` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cidade` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cep` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_estado` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`login` VARCHAR(30) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`senha` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`contaAtiva` VARCHAR(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`crm`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;");
  
$query3 = $mysqli->query("CREATE TABLE `pacientes` (
	`numIdRG` VARCHAR(20) NOT NULL,
	`nomeComp` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`dataNasc` DATE NULL DEFAULT NULL,
	`telFixo` VARCHAR(11) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`telCel` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`RG_UFEXP` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_logradouro` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_numero` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_complemento` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_bairro` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cidade` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cep` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_estado` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`numIdRG`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;");

$query4 = $mysqli->query("CREATE TABLE `consultas` (
	`idConsulta` INT(11) NOT NULL AUTO_INCREMENT,
	`medico` VARCHAR(20) NULL DEFAULT NULL,
	`paciente` VARCHAR(20) NULL DEFAULT NULL,
	`dataConsulta` DATE NULL DEFAULT NULL,
	`horaConsulta` TIME NULL DEFAULT NULL,
	`planoConsulta` VARCHAR(20) NULL DEFAULT NULL,
	`carteiraPlano` VARCHAR(20) NULL DEFAULT NULL,
	`tipoConsulta` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`confirmaConsulta` VARCHAR(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`idConsulta`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;");

$query5 = $mysqli->query("CREATE TABLE `planos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nomePlano` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`infoPlano` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`telFixo` VARCHAR(11) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_logradouro` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_numero` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_complemento` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_bairro` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cidade` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cep` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_estado` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;");

$query6 = $mysqli->query("CREATE TABLE `prontuarios` (
	`medico` VARCHAR(20) NULL DEFAULT NULL,
	`paciente` VARCHAR(20) NULL DEFAULT NULL,
	`dataProntuario` DATE NULL DEFAULT NULL,
	`prontuario` LONGTEXT NULL COLLATE 'utf8_unicode_ci',
	`idProntuario` INT(11) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`idProntuario`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;");

$query7 = $mysqli->query("CREATE TABLE `exames` (
	`medico` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`paciente` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`dataExame` DATE NULL DEFAULT NULL,
	`descExame` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`arqsExame` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`nomeExame` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`idExame` INT(11) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`idExame`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;");

if($query7){
  echo '<script type="text/javascript">
					location.href="passo1.php";
					</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>