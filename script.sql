create database consequence;

use consequence;

create table perguntas(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	descricao varchar(255),
	nivel int,
	ativo tinyint
);

create table consequencias(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	descricao varchar(255),
	nivel int
);

create table jogador(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome varchar(255),
	id_usuario int
);

create table pontuacao(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	consequencias int,
	perguntas int,
	jogador int
);

create table usuario(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome varchar(255),
	email varchar(255),
	senha varchar(255),
	admin tinyint
);

create table partida(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	descricao varchar(255) NOT NULL,
	nivel int,
	id_usuario int
);

create table partida_jogador(
	id_jogador int,
	id_partida int
);
