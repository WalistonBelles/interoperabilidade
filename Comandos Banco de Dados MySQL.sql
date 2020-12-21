-- Cria a Tabela Procurado

CREATE TABLE IF NOT EXISTS `procurado` (
	`id` INT(11) NOT NULL auto_increment,
	`cpf` VARCHAR(255) NOT NULL,
	`nome` VARCHAR(255) NOT NULL,
	`desde` DATETIME NOT NULL,
	PRIMARY KEY  (`id`)
);

-- Cria tabela Paciente

CREATE TABLE IF NOT EXISTS `paciente` (
	`id` INT(11) NOT NULL auto_increment,
	`documento` VARCHAR(255) NOT NULL,
	`nome` VARCHAR(255) NOT NULL,
	`sexo` VARCHAR(255) NOT NULL,
	`nascimento` DATE NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`fone` VARCHAR(255) NOT NULL,
	`moradia` VARCHAR(255) NOT NULL,
	`copia` VARCHAR(255) NOT NULL,
	`datahora` TIMESTAMP NOT NULL,
	PRIMARY KEY  (`id`)
);

-- Cria Tabela Triagem

CREATE TABLE IF NOT EXISTS `triagem` (
	`id` INT(11) NOT NULL auto_increment,
	`paciente`INT(30),
	`celsius`INT(30),
	`bpm`INT(30),
	`pas`INT(30),
	`pad`INT(30),
	`historia` VARCHAR(255),
	`avaliacao`INT(30),
	`datahora`TIMESTAMP,
	PRIMARY KEY  (`id`)
);

-- Cria a Tabela Atendimento

CREATE TABLE IF NOT EXISTS `atendimento` (
	`id` INT(11) NOT NULL auto_increment,
	`triagem` INT(30),
	`diagnostico` VARCHAR(255),
	`medicamento` VARCHAR(255),
	`encaminhamento` VARCHAR(255),
	`datahora` TIMESTAMP,
	PRIMARY KEY  (`id`)
);