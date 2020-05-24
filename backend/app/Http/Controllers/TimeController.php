<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Time;
use App\Repositories\TimeRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class TimeController extends Controller
{

    public function index()
    {
        // $times = new TimeRepository;
        // $times->findAll();

        $times = Time::all();

        return view('pages.time', [
            'times' => $times,
        ]);
    }

    public function store(Request $request)
    {
        try{ 
        
        $error = "";
        $data = $request->all();

        // var_dump($data);die;

        $time = new Time;
        $time->fill($data);
        
        $time->save();
    
        }catch(\Exception $e){
            $error='Erro ao salvar time' . $e;
        }  

        return view('pages.time-create', 
            [
                'error' => $error,
                'times'  => $time
            ]
        );
        // return response()->json([
        //     'error' => $error,
        //     'data'  => $time
        // ]);
    }
 
    public function edit($id)
    {
        $error = "";

        $repository = new TimeRepository; 
        $time = $repository->find($id); 

        if (!$time )
        {
            $error = "time não encontrado";  
        } 

        return response()->json([
            'error' => $error,
            'data'  => $time  
        ]);

    }

    public function update($id, Request $request)
    {
        $error = "";
        $data = $request->except(['_token']);

        $time = Time::find($id); 
        
        if (!$time)
        {
            $error = "Time não encontrado";  

        } else {

            $time->fill($data);

            try {  
                
                $time->save();
            
            }catch(\Exception $e){
                DB::rollback();
                $error='Erro ao editar Time' . $e;
            }  

        }
            
        return response()->json([
            'error' => $error,
            'data'  => $time
        ]);

    }

    // public function filter(Request $request)
    // {
    //     try { 
    //         $table=[];
    //         $error="";
    //         $repository = new TimeRepository;
    //         $data = $request->all();
    //         $Times = $repository->filter($data);
            
    //         foreach ($Times as $time)
    //         {
    //             $table[] = [
    //             'id_Time'            => $time->id_Time,
    //             'nom_colaborador'           => $time->nom_colaborador,
    //             'nom_unidade'               => $time->nom_unidade, 
    //             'nom_unidade_faturamento'   => $time->nom_unidade_faturamento, 
    //             'data_inicio_vigencia'      => date('d/m/Y',strtotime($time->data_inicio_vigencia)),
    //             'data_fim_vigencia'         => (isset ($time->data_fim_vigencia)? date('d/m/Y',strtotime($time->data_fim_vigencia)):''),
    //             'flg_situacao'              => $time->flg_situacao
    //             ];
    //         }

    //     }catch(\Exception $e){
    //         $error='Erro Pesquisa Beneficiário' . $e;
    //     }  
    //     return response()->json([
    //         'error' => $error,
    //         'data'  => $table
    //     ]);
      

    // }

    public function find($id)
    {
        $repository = new TimeRepository; 
        $time = $repository->find($id);
        $error = '';

        // $resultado_time = get_object_vars($time);
        
        if (!$time)
        {
            $error = "Time não encontrado";  
        } 
       
        return response()->json([
            'error' => $error,
            'data'  => $time
        ]);
    }

   /**
     *
     * @param  \App\Time  
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $error = "";
        $data = "";
         
        $repository = new TimeRepository; 
        $time = $repository->find($id); 
  
        if (!$time)
        {
            $error = "Time não encontrado";  

        } else {

            try { 
                $time->each->delete();

            }catch(\Exception $e){
                $error='Erro ao excluir Time' . $e;
            }  
    
        }

       return $this->index();

    }
    
  
}
