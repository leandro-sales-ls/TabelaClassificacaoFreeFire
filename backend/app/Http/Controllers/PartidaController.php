<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Partida;
use App\Repositories\PartidaRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class PartidaController extends Controller
{

    public function index()
    {
        $repository = new PartidaRepository;
        $partida = $repository->findAll();

        return view('pages.partidas.partida', [
            'partida' => $partida,
        ]);

    }

    public function store(Request $request)
    {
        try{ 
        
        $error = "";
        $data = $request->all();

        $partida = new Partida;
        $partida->fill($data);

        // var_dump($partida);die;
        
        $partida->save();
    
        }catch(\Exception $e){
            $error='Erro ao salvar Partida' . $e;
        }  
        return view('pages.partidas.partida-create', 
            [
                'error' => $error,
                'times'  => $partida
            ]
        );
        // return response()->json([
        //     'error' => $error,
        //     'data'  => $partida
        // ]);
    }
 
    public function edit($id)
    {
        $error = "";

        $repository = new PartidaRepository; 
        $partida = $repository->find($id); 

        if (!$partida )
        {
            $error = "Partida não encontrado";  
        } 

        return response()->json([
            'error' => $error,
            'data'  => $partida  
        ]);

    }

    public function update($id, Request $request)
    {
        $error = "";
        $data = $request->except(['_token']);

        $Partida = Partida::find($id); 
        
        if (!$Partida)
        {
            $error = "Partida não encontrado";  

        } else {

            $Partida->fill($data);

            try {  
                
                $Partida->save();
            
            }catch(\Exception $e){
                DB::rollback();
                $error='Erro ao editar Partida' . $e;
            }  

        }
            
        return $this->index();
        // return response()->json([
        //     'error' => $error,
        //     'data'  => $Partida
        // ]);

    }

    public function find($id)
    {
        $repository = new PartidaRepository; 
        $Partida = $repository->find($id);
        $error = '';
        
        if (!$Partida)
        {
            $error = "Partida não encontrado";  
        } 
       
        return response()->json([
            'error' => $error,
            'data'  => $Partida
        ]);
    }

   /**
     *
     * @param  \App\Partida  
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $error = "";
        $data = "";
         
        $repository = new PartidaRepository; 
        $Partida = $repository->find($id); 
  
        if (!$Partida)
        {
            $error = "Partida não encontrado";  

        } else {

            try { 
                $Partida->each->delete();

            }catch(\Exception $e){
                $error='Erro ao excluir Partida' . $e;
            }  
    
        }

        return $this->index();
        // return response()->json([
        //     'error' => $error,
        //     'data'  => $data
        // ]);

    }
    
  
}
