<?php

namespace App\Repositories;

use App\TemporadaTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TemporadaTimeRepository 
{
	
	public function findAll()
	{
        return  TemporadaTime::all();
	}  
	
	public function find($id)
	{

		return $temporadaTime = DB::table('temporada_time')
            ->join('time', 'time.id', '=', 'temporada_time.id_time')
            ->join('temporada', 'temporada_time.id_temporada', '=', 'temporada.id')
			->select('temporada_time.id','time.logo', 'time.nome_time','time.nome_representante', 'temporada.nome_temporada')
			->where('id_temporada', $id)
			->get();
			
        //   TemporadaTime::where('id_temporada', $id)->get();
	}   

	public function findSingle($id)
	{			
          return TemporadaTime::where('id', $id)->first();
	}  
	
}