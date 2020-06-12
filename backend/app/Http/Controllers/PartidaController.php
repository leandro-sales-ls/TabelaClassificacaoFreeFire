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

        // dd($partida);

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
        
        $partida->save();
    
        }catch(\Exception $e){
            $error='Erro ao salvar partida' . $e;
        }  
        return view('pages.partidas.partida-create', 
            [
                'error' => $error,
                'partida'  => $partida
            ]
        );
    }
 
    public function edit($id)
    {
        $error = "";

        $repository = new PartidaRepository; 
        $partida = $repository->find($id); 

        if (!$partida )
        {
            $error = "partida não encontrado";  
        } 
        // var_dump($partida->id);die;
        return view('pages.partidas.partida-edit', [
            'partida' => $partida,
        ]);
    }

    public function update($id, Request $request)
    {
        $error = "";
        $data = $request->all();

        $partida = Partida::find($id); 

        if (!$partida)
        {
            $error = "partida não encontrado";  

        } else {

            $partida->fill($data);
            // dd($partida);
            try {  
                
                $partida->save();
            
            }catch(\Exception $e){
                DB::rollback();
                $error='Erro ao editar partida' . $e;
            }  

        }
            
        return $this->index();

    }

    public function find($id)
    {
        $repository = new PartidaRepository; 
        $partida = $repository->find($id);
        $error = '';
        
        if (!$partida)
        {
            $error = "partida não encontrado";  
        } 
       
        return response()->json([
            'error' => $error,
            'data'  => $partida
        ]);
    }

   /**
     *
     * @param  \App\partida  
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $error = "";
        $data = "";
         
        $repository = new PartidaRepository; 
        $partida = $repository->find($id); 
  
        if (!$partida)
        {
            $error = "partida não encontrado";  

        } else {

            try { 
                $partida->delete();

            }catch(\Exception $e){
                $error='Erro ao excluir partida' . $e;
            }  
    
        }

        return $this->index();

    }
    
  
}
