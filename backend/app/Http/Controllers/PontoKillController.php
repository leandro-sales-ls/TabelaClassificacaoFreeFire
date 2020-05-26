<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\pontoKill;
use App\Repositories\PontoKillRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class PontoKillController extends Controller
{

    public function index()
    {
        $repository = new PontoKillRepository;
        $pontoKill = $repository->findAll();

        return view('pages.pontosKill.pontos', [
            'pontoKill' => $pontoKill,
        ]);

    }

    public function store(Request $request)
    {
        try{ 
        
        $error = "";
        $data = $request->all();

        $pontoKill = new pontoKill;
        $pontoKill->fill($data);
        
        $pontoKill->save();
    
        }catch(\Exception $e){
            $error='Erro ao salvar pontoKill' . $e;
        }  

        return view('pages.pontosKill.ponto-kill-create', 
            [
                'error' => $error,
                'pontoKill'  => $pontoKill
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
                
                $pontoKill->save();
            
            }catch(\Exception $e){
                DB::rollback();
                $error='Erro ao editar pontoKill' . $e;
            }  

        }
        return $this->index();

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
                $pontoKill->delete();

            }catch(\Exception $e){
                $error='Erro ao excluir pontoKill' . $e;
            }  
    
        }
        return $this->index();

    }
    
  
}
