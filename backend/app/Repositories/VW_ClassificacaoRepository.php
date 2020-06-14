<?php

namespace App\Repositories;

use App\Vw_classificacao;
use Illuminate\Database\Eloquent\Model;

class VW_ClassificacaoRepository 
{
	
	public function findAll()
	{
        return  Vw_classificacao::all();
	}  
	
	public function find($id)
	{
		// return  Time::find
        return  Vw_classificacao::where('id', $id)->first();
	}  

	public function findTemporada($id)
	{
		// return  Time::find
        return  Vw_classificacao::where('id_temporada', $id)->get();
	}  
	
}