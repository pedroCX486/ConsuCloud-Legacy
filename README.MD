ConsuCloud - CODENAME RAPADURA // (C) 2017 OrangeMayhem Softworks

Configurações PHP Recomendadas:  
upload_max_filesize: 60M, max_file_uploads: 10, post_max_size: 128M  

Backdoor para Debugging/Teste:  
Login: Debug  
Senha: c0sult8r10s  

Amazon DB:  
Endereço: aa131vdfh1jei3u.colf9ctxyudu.us-west-2.rds.amazonaws.com  
Login: Consucl0udom4yh3  
Senha: C0Sult8r10sp8wnom4yhemsoftw8ks  
________________________________________

*TODO:*


________________________________________

*BANCO:*

CREATE DATABASE consucloud CHARACTER SET utf8 COLLATE utf8_unicode_ci;

________________________________________

CREATE TABLE `usuarios` (
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
;
________________________________________

CREATE TABLE `pacientes` (
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
;
________________________________________

CREATE TABLE `configs` (
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
;
________________________________________

CREATE TABLE `consultas` (
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
;
________________________________________

CREATE TABLE `planos` (
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
;
________________________________________

CREATE TABLE `prontuarios` (
	`medico` VARCHAR(20) NULL DEFAULT NULL,
	`paciente` VARCHAR(20) NULL DEFAULT NULL,
	`dataProntuario` DATE NULL DEFAULT NULL,
	`prontuario` LONGTEXT NULL COLLATE 'utf8_unicode_ci',
	`idProntuario` INT(11) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`idProntuario`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
________________________________________

CREATE TABLE `exames` (
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
;
________________________________________
