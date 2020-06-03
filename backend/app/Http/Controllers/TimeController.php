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

        // var_dump($times);die;

        return view('pages.times.time', [
            'times' => $times
        ]);
    }

    public function store(Request $request)
    {
        try{
        $data = $request->all();

        $time = new Time;
        $time->fill($data);

        if($time->save()){

            $alert = [
                'status' => 'success', 
                'message' => 'Time cadastrado com sucesso!'
            ];
        }

        }catch(\Exception $e){

            $alert = [
                'status' => 'error', 
                'message' => 'Erro ao salvar time! <br>'. substr($e->getMessage(), 0, 70)
            ];
            
        }

        return view('pages.times.time-create',
            [
                'times'  => $time,
                'alert' => $alert
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

                if ($time->save()) {
                    $alert = [
                        'status' => 'success', 
                        'message' => 'Time editado com sucesso!'
                    ];
                }

            }catch(\Exception $e){
                DB::rollback();

                $alert = [
                    'status' => 'error', 
                    'message' => 'Erro ao editar time! <br>'. substr($e->getMessage(), 0, 70)
                ];

            }

        }

        $times = new TimeRepository;
        $times = $times->findAll();

        return view('pages.times.time', [
            'times' => $times,
            'alert' => $alert
        ]);

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
                if ($time->delete()) {

                    $alert = [
                        'status' => 'success', 
                        'message' => 'Time excluido com sucesso!'
                    ];
                }

            } catch(\Exception $e){

                // $error='Erro ao excluir Time' . $e;

                $alert = [
                    'status' => 'error', 
                    'message' => 'Erro ao excluir time! <br>'. substr($e->getMessage(), 0, 70)
                ];

            }
        }

        $times = new TimeRepository;
        $times = $times->findAll();
        
        return view('pages.times.time', [
            'times' => $times,
            'alert' => $alert
        ]);

    }


}
