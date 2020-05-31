<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PontoPosicao;
use App\Repositories\PontoPosicaoRepository;

use App\Temporada;
use App\Repositories\TemporadaRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class PontoPosicaoController extends Controller
{

    public function index()
    {
        $repository = new PontoPosicaoRepository;
        $pontoPosicao = $repository->findAll();

        return view('pages.pontosPosicao.pontos', [
            'pontoPosicao' => $pontoPosicao,
        ]);

    }

    public function create()
    {
        $temporadas = new TemporadaRepository;
        $temporadas = $temporadas->findAll();

        return view('pages.pontosPosicao.ponto-posicao-create', [
            'temporadas' => $temporadas
        ]);
    }

    public function store(Request $request)
    {
        try{ 
        
        $error = "";
        $data = $request->all();

        $pontoPosicao = new PontoPosicao;
        $pontoPosicao->fill($data);
        
        $pontoPosicao->save();

        $temporadas = new TemporadaRepository;
        $temporadas = $temporadas->findAll();
    
        }catch(\Exception $e){
            $error='Erro ao salvar pontoPosicao' . $e;
        }  

        return view('pages.pontosPosicao.ponto-posicao-create', 
            [
                'error' => $error,
                'pontoPosicao'  => $pontoPosicao,
                'temporadas' => $temporadas,
            ]
        );
    }
 
    public function edit($id)
    {
        $error = "";

        $repository = new PontoPosicaoRepository; 
        $pontoPosicao = $repository->find($id); 

        if (!$pontoPosicao )
        {
            $error = "pontoPosicao não encontrado";  
        } 

        return view('pages.pontosPosicao.ponto-edit', [
            'pontoPosicao' => $pontoPosicao,
        ]);    

    }

    public function update($id, Request $request)
    {
        $error = "";
        $data = $request->except(['_token']);

        $pontoPosicao = PontoPosicao::find($id); 
        
        if (!$pontoPosicao)
        {
            $error = "pontoPosicao não encontrado";  

        } else {

            $pontoPosicao->fill($data);

            try {  
                
                $pontoPosicao->save();
            
            }catch(\Exception $e){
                DB::rollback();
                $error='Erro ao editar pontoPosicao' . $e;
            }  

        }

        return $this->index();

    }

    public function find($id)
    {
        $repository = new PontoPosicaoRepository; 
        $pontoPosicao = $repository->find($id);
        $error = '';

        // $resultado_time = get_object_vars($pontoPosicao);
        
        if (!$pontoPosicao)
        {
            $error = "pontoPosicao não encontrado";  
        } 
       
        return response()->json([
            'error' => $error,
            'data'  => $pontoPosicao
        ]);
    }

   /**
     *
     * @param  \App\PontoPosicao  
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $error = "";
        $data = "";
         
        $repository = new PontoPosicaoRepository; 
        $pontoPosicao = $repository->find($id); 
  
        if (!$pontoPosicao)
        {
            $error = "pontoPosicao não encontrado";  

        } else {

            try { 
                $pontoPosicao->delete();

            }catch(\Exception $e){
                $error='Erro ao excluir pontoPosicao' . $e;
            }  
    
        }
        return $this->index();

    }
    
  
}
