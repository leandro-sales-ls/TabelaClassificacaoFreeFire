<?php

namespace App\Repositories;

use App\PontoKill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PontoKillRepository 
{
	
	public function findAll()
	{
		// return $ponto_kill = DB::table('ponto_kill')
		// ->join('temporada', 'temporada.id', '=', 'ponto_kill.id_temporada')
		// ->select('ponto_kill.id','ponto_kill.num_kill', 'ponto_kill.ponto_kill','temporada.nome_temporada')
		// ->get();
		return  PontoKill::all();
	}  
	
	public function find($id)
	{
        return  PontoKill::where('id', $id)->first();
	} 
	
	public function findSingleAsc(){
		return  PontoKill::all()->first();
	}


	
}