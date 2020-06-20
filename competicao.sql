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
	posicao int NOT NULL,
	pontos_posicao int NOT NULL,
	id_temporada int NOT NULL
);

create table ponto_kill (
id serial,
ponto_kill int NOT NULL,
num_kill int NOT NULL,
id_temporada int NOT NULL
);

CREATE TABLE public."temporada"(
	id serial,
	nome_temporada varchar(150) NOT NULL,
	num_max_partida int4 NOT NULL
);

CREATE TABLE public."temporada"(
	id serial,
	nome_temporada varchar(150) NOT NULL,
	num_max_partida int4 NOT NULL
);

CREATE TABLE public."temporada_time"(
	id serial,
	id_temporada int4 NOT NULL,
	id_time int4 NOT null,
	data_inclusao date null,
	data_ult_alteracao date NULL
);

CREATE TABLE public."classificacao_partida"(
	id serial,
	id_temporada int4 NOT NULL,
	id_time int4 NOT null,
	id_partida int4 NOT null,
	id_posicao int4 NOT null,
	qtd_kill int4 NOT null,
	data_inclusao date null,
	data_ult_alteracao date NULL
);

CREATE TABLE public."soma_pontos_kill_partida"(
	id serial,
	id_classificacao_partida int4 NOT NULL,
	soma_pontos_kill int4 NOT NULL,
	data_inclusao date null,
	data_ult_alteracao date NULL
);


ALTER TABLE public.temporada ADD data_inclusao date NULL;
ALTER TABLE public.temporada ADD data_ult_alteracao date NULL;

ALTER TABLE public.time ADD data_inclusao date NULL;
ALTER TABLE public.time ADD data_ult_alteracao date NULL;

ALTER TABLE public.partida ADD data_inclusao date NULL;
ALTER TABLE public.partida ADD data_ult_alteracao date NULL;

ALTER TABLE public.ponto_posicao ADD data_inclusao date NULL;
ALTER TABLE public.ponto_posicao ADD data_ult_alteracao date NULL;

ALTER TABLE public.ponto_kill ADD data_inclusao date NULL;
ALTER TABLE public.ponto_kill ADD data_ult_alteracao date NULL;



create view VW_CLASSIFICACAO_SOMA as
select
id_temporada_time,
id_temporada,
id_time,
nome_time, 
sum (posicao) as posicao, 
sum(soma_pontos_kill) as soma_pontos_kill,
logo
from VW_CLASSIFICACAO
group by nome_time, id_temporada_time, id_temporada, id_time, logo
order by posicao asc, soma_pontos_kill desc;


create view VW_CLASSIFICACAO as
select 
cp.id,
cp.id_time,
tm.nome_time,
spkp.soma_pontos_kill,
cp.id_posicao,
pp.posicao,
tmp.nome_temporada,
cp.id_temporada_time,
cp.id_partida,
pt.num_rodada,
tmp.id as id_temporada,
tm.logo
FROM 
public.classificacao_partida as cp
join 
partida as pt
on cp.id_partida = pt.id 
join 
"time" as tm
on tm.id = cp.id_time 
join
temporada_time as tmpt
on tmpt.id = cp.id_temporada_time
join
temporada as tmp
on tmp.id = tmpt.id_temporada
join 
soma_pontos_kill_partida as spkp
on spkp.id_classificacao_partida = cp.id
join 
ponto_posicao as pp
on pp.id = cp.id_posicao;



