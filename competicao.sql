create database competicao;

use competicao;

CREATE TABLE public."time"(
	id int4 NOT NULL,
	logo text NOT NULL,
	nome_time varchar(100) NOT NULL,
	nome_representante varchar(100)
);
CREATE TABLE public."rodada"(
	id int4 NOT NULL,
	num_rodada integer
);
CREATE TABLE public."ponto"(
	id int4 NOT NULL,
	id_temporada int4 NOT NULL,
	pontos_posicao varchar(100) NOT NULL,
	pontos_kill varchar(100)
);
