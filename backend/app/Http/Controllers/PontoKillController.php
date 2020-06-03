<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\pontoKill;
use App\Repositories\PontoKillRepository;

use App\Temporada;
use App\Repositories\TemporadaRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class PontoKillController extends Controller
{

    public function index()
    {
        $pontoKill = new PontoKillRepository;
        $pontoKill = $pontoKill->findAll();

        return view('pages.pontosKill.pontos', [
            'pontoKill' => $pontoKill,
        ]);

    }

    public function create()
    {
        $temporadas = new TemporadaRepository;
        $temporadas = $temporadas->findAll();

        return view('pages.pontosKill.ponto-kill-create', [
            'temporadas' => $temporadas
        ]);
    }

    public function store(Request $request)
    {
        try{ 
        
        $error = "";
        $data = $request->all();

        $pontoKill = new pontoKill;
        $pontoKill->fill($data);

        $temporadas = new TemporadaRepository;
        $temporadas = $temporadas->findAll();
        
        if ($pontoKill->save()) {
            $alert = [
                'status' => 'success', 
                'message' => 'Pontos por kill cadastrado com sucesso'
            ];
        }
    
        }catch(\Exception $e){
            $alert = [
                'status' => 'error', 
                'message' => 'Erro ao salvar pontos <br>'. substr($e->getMessage(), 0, 70)
            ];
        }  

        return view('pages.pontosKill.ponto-kill-create', 
            [
                'error' => $error,
                'temporadas' => $temporadas,
                'pontoKill'  => $pontoKill,
                'alert' => $alert
            ]
        );
    }
 
    public function edit($id)
    {
        $error = "";

        $repository = new PontoKillRepository; 
        $pontoKill = $repository->find($id); 

        if (!$pontoKill )
        {
            $error = "pontoKill não encontrado";  
        } 

        return view('pages.pontosKill.ponto-edit', [
            'pontoKill' => $pontoKill,
        ]);     

    }

    public function update($id, Request $request)
    {
        $error = "";
        $data = $request->except(['_token']);

        $pontoKill = pontoKill::find($id); 
        
        if (!$pontoKill)
        {
            $error = "pontoKill não encontrado";  

        } else {

            $pontoKill->fill($data);

            try {  
                
                if ($pontoKill->save()) { 
                    $alert = [
                        'status' => 'success', 
                        'message' => 'Pontos por kill editado com sucesso'
                    ];
                }
            
            }catch(\Exception $e){
                DB::rollback();
                $alert = [
                    'status' => 'error', 
                    'message' => 'Erro ao editar pontos! <br>'. substr($e->getMessage(), 0, 70)
                ];
            }  

        }

        $pontoKill = new PontoKillRepository;
        $pontoKill = $pontoKill->findAll();

        return view('pages.pontosKill.pontos', [
            'pontoKill' => $pontoKill,
            'alert'=> $alert
        ]);


    }

    public function find($id)
    {
        $repository = new PontoKillRepository; 
        $pontoKill = $repository->find($id);
        $error = '';
        
        if (!$pontoKill)
        {
            $error = "pontoKill não encontrado";  
        } 
       
        return response()->json([
            'error' => $error,
            'data'  => $pontoKill
        ]);
    }

   /**
     *
     * @param  \App\pontoKill  
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $error = "";
        $data = "";
         
        $repository = new PontoKillRepository; 
        $pontoKill = $repository->find($id); 
  
        if (!$pontoKill)
        {
            $error = "pontoKill não encontrado";  

        } else {

            try { 
                if ($pontoKill->delete()) {
                    $alert = [
                        'status' => 'success', 
                        'message' => 'Pontos por kill apagado com sucesso'
                    ];
                }

            }catch(\Exception $e){
                $alert = [
                    'status' => 'error', 
                    'message' => 'Erro ao editar pontos! <br>'. substr($e->getMessage(), 0, 70)
                ];
            }  
    
        }

        $pontoKill = new PontoKillRepository;
        $pontoKill = $pontoKill->findAll();

        return view('pages.pontosKill.pontos', [
            'pontoKill' => $pontoKill,
            'alert'=> $alert
        ]);

    }
    
  
}
