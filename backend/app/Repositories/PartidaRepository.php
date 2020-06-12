<?php

namespace App\Repositories;

use App\Partida;
use Illuminate\Database\Eloquent\Model;

class PartidaRepository 
{
	
	public function findAll()
	{
        return  Partida::all();
	}  
	
	public function find($id)
	{
        return  Partida::where('id', $id)->first();
	}  

	public function pesquisarPartidasTemporada($id)
	{
        return  Partida::where('id_temporada', $id)->get();
	}  
	
}