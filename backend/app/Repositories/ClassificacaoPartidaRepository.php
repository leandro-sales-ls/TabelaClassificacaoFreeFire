<?php

namespace App\Repositories;

use App\ClassificacaoPartida;
use Illuminate\Database\Eloquent\Model;

class ClassificacaoPartidaRepository 
{
	
	public function findAll()
	{
        return  ClassificacaoPartida::all();
	}  
	
	public function find($id)
	{
        return  ClassificacaoPartida::where('id', $id)->first();
	}  

	public function buscarId($data)
	{
		return  ClassificacaoPartida::where('id_temporada_time', $data['id_temporada_time'])
		->where('id_time',  $data['id_time'])
		->where('id_partida', $data['id_partida'])
		->where('id_posicao',  $data['id_posicao'])->first();
		
	}  

	public function existeCadastrado($id)
	{
        return  ClassificacaoPartida::where('id_temporada_time', $id)->first();
	} 

	
	
}