<?php

namespace App\Repositories;

use App\Temporada;
use Illuminate\Database\Eloquent\Model;

class TemporadaRepository 
{
	
	public function findAll()
	{
        return  Temporada::all();
	}  
	
	public function find($id)
	{
        return  Temporada::where('id', $id)->first();
	}  
	
}