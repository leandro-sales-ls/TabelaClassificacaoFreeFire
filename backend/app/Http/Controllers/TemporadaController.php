<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temporada;
use App\Repositories\TemporadaRepository;

use App\Repositories\TimeRepository;

use App\TemporadaTime;
use App\Repositories\TemporadaTimeRepository;

use App\Partida;
use App\Repositories\PartidaRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class TemporadaController extends Controller
{

    public function index()
    {
        $repository = new TemporadaRepository;
        $temporada = $repository->findAll();

        return view('pages.temporadas.temporada', [
            'temporada' => $temporada,
        ]);

    }

    public function store(Request $request)
    {
        try{ 
        
        $error = "";
        $data = $request->all();

        $temporada = new Temporada;
        $temporada->fill($data);
        
        if ($temporada->save()) {

            $numMaxPartida = $temporada['num_max_partida'];

            $repository = new TemporadaRepository;
            $id = $repository->findSingleDescId();
            $id = $id->id;

            for($i = 1; $i <= $numMaxPartida; $i++){
                $data = array(
                    'num_rodada' => $i,
                    'id_temporada' => $id
                );
                $partida = new Partida;
                $partida->fill($data);
                $partida->save();
            }
           
            $alert = [
                'status' => 'success', 
                'message' => 'Temporada cadastrada com sucesso!'
            ];

        }
    
        }catch(\Exception $e){
            $alert = [
                'status' => 'error', 
                'message' => 'Erro ao salvar temporada! <br>'. substr($e->getMessage(), 0, 70)
            ];
        }  
        return view('pages.temporadas.temporada-create', 
            [
                'temporada'  => $temporada,
                'alert'=>$alert
            ]
        );
    }
 
    public function edit($id)
    {
        $error = "";

        $repository = new TemporadaRepository; 
        $temporada = $repository->find($id); 

        if (!$temporada )
        {
            $error = "temporada não encontrado";  
        } 
        // var_dump($temporada->id);die;
        return view('pages.temporadas.temporada-edit', [
            'temporada' => $temporada,
        ]);
    }

    public function update($id, Request $request)
    {
        $error = "";
        $data = $request->all();

        $temporada = temporada::find($id); 

        if (!$temporada)
        {
            $error = "temporada não encontrado";  

        } else {

            $temporada->fill($data);

            try {  
                
                if ($temporada->save()) {

                    $alert = [
                        'status' => 'success', 
                        'message' => 'Temporada editada com sucesso'
                    ];

                }
            
            }catch(\Exception $e){
                DB::rollback();
                $error='Erro ao editar temporada' . $e;

                $alert = [
                    'status' => 'error', 
                    'message' => 'Erro ao editar temporada <br>'. substr($e->getMessage(), 0, 70)
                ];
            }  

        }

        $repository = new TemporadaRepository;
        $temporada = $repository->findAll();
            
        return view('pages.temporadas.temporada', 
            [
                'temporada'  => $temporada,
                'alert'=>$alert
            ]
        );

    }

    public function find($id)
    {
        $repository = new TemporadaRepository; 
        $temporada = $repository->find($id);
        $error = '';
        
        if (!$temporada)
        {
            $error = "temporada não encontrado";  
        } 
       
        return response()->json([
            'error' => $error,
            'data'  => $temporada
        ]);
    }

   /**
     *
     * @param  \App\temporada  
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $error = "";
        $data = "";
         
        $repository = new TemporadaRepository; 
        $temporada = $repository->find($id); 
  
        if (!$temporada)
        {
            $error = "temporada não encontrado";  

        } else {

            try { 
                $temporada->delete();

            }catch(\Exception $e){
                $error='Erro ao excluir temporada' . $e;
            }  
    
        }

        return $this->index();

    }

    public function temporadaTime($id)
    {
        $error = "";

        $repository = new TemporadaRepository; 
        $temporada = $repository->find($id); 

        $times = new TimeRepository;
        $times = $times->findAll();

        $temporadaTime = new TemporadaTimeRepository;
        $temporadaTime = $temporadaTime->find($id);
        // var_dump($temporadaTime);die;

        return view('pages.temporadas.temporada-time', [
            'temporada' => $temporada,
            'times' => $times,
            'temporadaTime'=> $temporadaTime
        ]);

    }

    public function temporadaTimeAdd(Request $request)
    {
        try{ 
            
            $error = "";
            $data = $request->all();

            $temporada = new TemporadaTime;
            $temporada->fill($data);
            
            $temporada->save();

            return redirect()->action(
                'TemporadaController@temporadaTime', ['id' => $data["id_temporada"]]
            );
        
        }catch(\Exception $e){
            $error='Erro ao salvar temporada' . $e;
        }  
        

    }

    public function deleteTemporadaTime($id, $id_temporada)
    {
        $error = "";
        $data = "";
         
        $repository = new TemporadaTimeRepository; 
        $temporada = $repository->findSingle($id);
        
        if (!$temporada)
        {
            $error = "temporada não encontrado";  

        } else {

            try { 

                $temporada->delete();
               

            }catch(\Exception $e){
                $error='Erro ao excluir temporada' . $e;
                
            }  
            
            return redirect()->action(
                'TemporadaController@temporadaTime', ['id' => $id_temporada]
            );
        }

        

    }
    
  
}
