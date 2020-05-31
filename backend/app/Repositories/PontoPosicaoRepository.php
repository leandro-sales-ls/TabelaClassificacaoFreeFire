<?php

namespace App\Repositories;

use App\PontoPosicao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PontoPosicaoRepository 
{
	
	public function findAll()
	{
        return $ponto_posicao = DB::table('ponto_posicao')
		->join('temporada', 'temporada.id', '=', 'ponto_posicao.id_temporada')
		->select('ponto_posicao.id','ponto_posicao.pontos_posicao', 'ponto_posicao.posicao','temporada.nome_temporada')
		->get();
	}  
	
	public function find($id)
	{
        return  PontoPosicao::where('id', $id)->first();
	}  
	
}