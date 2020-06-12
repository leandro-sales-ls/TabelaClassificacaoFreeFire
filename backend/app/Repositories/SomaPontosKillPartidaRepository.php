<?php

namespace App\Repositories;

use App\SomaPontosKillPartida;
use Illuminate\Database\Eloquent\Model;

class SomaPontosKillPartidaRepository 
{
	
	public function findAll()
	{
        return  SomaPontosKillPartida::all();
	}  
	
	public function find($id)
	{
        return  SomaPontosKillPartida::where('id_classificacao_partida', $id)->first();
	}  
	
}