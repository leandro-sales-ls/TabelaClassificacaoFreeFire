<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PontoKill;
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
        return $repository->findAll();

    }

    public function store(Request $request)
    {
        try{ 
        
        $error = "";
        $data = $request->all();

        $PontoKill = new PontoKill;
        $PontoKill->fill($data);
        
        $PontoKill->save();
    
        }catch(\Exception $e){
            $error='Erro ao salvar PontoKill' . $e;
        }  
        return response()->json([
            'error' => $error,
            'data'  => $PontoKill
        ]);
    }
 
    public function edit($id)
    {
        $error = "";

        $repository = new PontoKillRepository; 
        $PontoKill = $repository->find($id); 

        if (!$PontoKill )
        {
            $error = "PontoKill não encontrado";  
        } 

        return response()->json([
            'error' => $error,
            'data'  => $PontoKill  
        ]);

    }

    public function update($id, Request $request)
    {
        $error = "";
        $data = $request->except(['_token']);

        $PontoKill = PontoKill::find($id); 
        
        if (!$PontoKill)
        {
            $error = "PontoKill não encontrado";  

        } else {

            $PontoKill->fill($data);

            try {  
                
                $PontoKill->save();
            
            }catch(\Exception $e){
                DB::rollback();
                $error='Erro ao editar PontoKill' . $e;
            }  

        }
            
        return response()->json([
            'error' => $error,
            'data'  => $PontoKill
        ]);

    }

    public function find($id)
    {
        $repository = new PontoKillRepository; 
        $PontoKill = $repository->find($id);
        $error = '';

        // $resultado_time = get_object_vars($PontoKill);
        
        if (!$PontoKill)
        {
            $error = "PontoKill não encontrado";  
        } 
       
        return response()->json([
            'error' => $error,
            'data'  => $PontoKill
        ]);
    }

   /**
     *
     * @param  \App\PontoKill  
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $error = "";
        $data = "";
         
        $repository = new PontoKillRepository; 
        $PontoKill = $repository->find($id); 
  
        if (!$PontoKill)
        {
            $error = "PontoKill não encontrado";  

        } else {

            try { 
                $PontoKill->each->delete();

            }catch(\Exception $e){
                $error='Erro ao excluir PontoKill' . $e;
            }  
    
        }
        return response()->json([
            'error' => $error,
            'data'  => $data
        ]);

    }
    
  
}
