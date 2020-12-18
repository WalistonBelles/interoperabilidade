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
	`paciente`INT(30) NOT NULL,
	`celsius`INT(30) NOT NULL,
	`bpm`INT(30) NOT NULL,
	`pas`INT(30) NOT NULL,
	`pad`INT(30) NOT NULL,
	`historia` VARCHAR(255) NOT NULL,
	`avaliacao`INT(30) NOT NULL,
	`datahora`TIMESTAMP NOT NULL,
	PRIMARY KEY  (`id`)
);