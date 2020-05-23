create database competicao;

use competicao;

CREATE TABLE public."time"(
	id serial,
	logo text NOT NULL,
	nome_time varchar(100) NOT NULL,
	nome_representante varchar(100)
);
CREATE TABLE public."partida"(
	id serial,
	num_rodada int4 NOT NULL,
	id_temporada int4 NOT NULL
);
CREATE TABLE public."ponto_posicao"(
	id serial,
	posicao int4 NOT NULL,
	pontos_posicao int4 NOT NULL
);

create table ponto_kill (
id serial,
ponto_kill int,
num_kill int
);

ALTER TABLE public.time ADD data_inclusao date NULL;
ALTER TABLE public.time ADD data_ult_alteracao date NULL;

ALTER TABLE public.partida ADD data_inclusao date NULL;
ALTER TABLE public.partida ADD data_ult_alteracao date NULL;

ALTER TABLE public.ponto_posicao ADD data_inclusao date NULL;
ALTER TABLE public.ponto_posicao ADD data_ult_alteracao date NULL;

ALTER TABLE public.ponto_kill ADD data_inclusao date NULL;
ALTER TABLE public.ponto_kill ADD data_ult_alteracao date NULL;

