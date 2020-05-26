<?php

namespace App\Repositories;

use App\PontoPosicao;
use Illuminate\Database\Eloquent\Model;

class PontoPosicaoRepository 
{
	
	public function findAll()
	{
        return  PontoPosicao::all();
	}  
	
	public function find($id)
	{
        return  PontoPosicao::where('id', $id)->first();
	}  
	
}