<?php

namespace App\Repositories;

use App\PontoKill;
use Illuminate\Database\Eloquent\Model;

class PontoKillRepository 
{
	
	public function findAll()
	{
        return  PontoKill::all();
	}  
	
	public function find($id)
	{
        return  PontoKill::where('id', $id)->first();
	}  
	
}