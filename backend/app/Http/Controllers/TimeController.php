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
        $times = new TimeRepository;
        $times = $times->findAll();

        return view('pages.times.time', [
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

        return view('pages.times.time-create', 
            [
                'error' => $error,
                'times'  => $time
            ]
        );
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

        // var_dump($time->id);die;

        return view('pages.times.time-edit', [
            'time' => $time,
        ]);

    }

    public function update($id, Request $request)
    {
        $error = "";
        $data = $request->all();

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

        return $this->index();

    }

    public function find($id)
    {
        $repository = new TimeRepository; 
        $time = $repository->find($id);
        $error = '';
        
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
