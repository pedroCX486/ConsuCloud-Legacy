ConsuCloud - CODENAME BOLO DE ROLO // (C) 2018 OrangeMayhem Softworks

Configurações PHP Recomendadas:  
upload_max_filesize: 60M, max_file_uploads: 10, post_max_size: 128M  
  
Senha dos Deploys:  
C0Sult8r10sp8wnom4yhemsoftw8ks  
  
Backdoor para Debugging/Teste: (DESATIVADO/ABANDONADO)  
Login: Debug  
Senha: c0sult8r10s  
  
Cloud9 IDE  
PHPmyAdmin: https://consucloud-gafanhotz.c9users.io/  
  
________________________________________


*BANCO:*

CREATE DATABASE consucloud CHARACTER SET utf8 COLLATE utf8_unicode_ci;

________________________________________

CREATE TABLE `usuarios` (
	`idUsuario` INT(11) NOT NULL AUTO_INCREMENT,
	`crm` VARCHAR(20) NOT NULL,
	`areaAtuacao` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`tipoUsuario` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`nomeCompleto` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`nomeCurto` VARCHAR(25) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`dataNasc` DATE NULL DEFAULT NULL,
	`telFixo` VARCHAR(11) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`telCel` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`RG` VARCHAR(20) NOT NULL,
	`RGUFEXP` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
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
	PRIMARY KEY (`idUsuario`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
________________________________________

CREATE TABLE `pacientes` (
	`idPaciente` INT(11) NOT NULL AUTO_INCREMENT,
	`nomePaciente` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`dataNasc` DATE NULL DEFAULT NULL,
	`telFixo` VARCHAR(11) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`telCel` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`RG` VARCHAR(20) NOT NULL,
	`RGUFEXP` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_logradouro` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_numero` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_complemento` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_bairro` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cidade` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_cep` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`endereco_estado` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`idPaciente`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
________________________________________

CREATE TABLE `configs` (
	`idConsultorio` INT(11) NOT NULL AUTO_INCREMENT,
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
	`version` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`idConsultorio`)
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
	`idPlano` INT(11) NOT NULL AUTO_INCREMENT,
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
	PRIMARY KEY (`idPlano`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;
________________________________________

CREATE TABLE `prontuarios` (
	`idProntuario` INT(11) NOT NULL AUTO_INCREMENT,
	`medico` VARCHAR(20) NULL DEFAULT NULL,
	`paciente` VARCHAR(20) NULL DEFAULT NULL,
	`dataProntuario` DATE NULL DEFAULT NULL,
	`horaProntuario` TIME NULL DEFAULT NULL,
	`prontuario` LONGTEXT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`idProntuario`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
________________________________________

CREATE TABLE `exames` (
	`idExame` INT(11) NOT NULL AUTO_INCREMENT,
	`medico` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`paciente` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`dataExame` DATE NULL DEFAULT NULL,
	`nomeExame` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`descExame` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`arqsExame` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`idExame`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
________________________________________

CREATE TABLE `logs` (
	`idLog` INT(11) NOT NULL AUTO_INCREMENT,
	`log` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`usuario` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`ip` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`dataLog` DATE NULL DEFAULT NULL,
	`horaLog` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`idLog`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
________________________________________

CREATE TABLE `receitas` (
	`idReceita` INT(11) NOT NULL AUTO_INCREMENT,
	`nomeReceita` VARCHAR(250) NULL DEFAULT NULL,
	`tipoReceita` VARCHAR(100) NULL DEFAULT NULL,
	`medico` VARCHAR(20) NULL DEFAULT NULL,
	`paciente` VARCHAR(20) NULL DEFAULT NULL,
	`dataReceita` DATE NULL DEFAULT NULL,
	`horaReceita` TIME NULL DEFAULT NULL,
	`receita` LONGTEXT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`idReceita`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
________________________________________