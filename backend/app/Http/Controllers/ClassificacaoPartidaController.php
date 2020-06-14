<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Time;
use App\Repositories\TimeRepository;

use App\Temporada;
use App\Repositories\TemporadaRepository;

use App\TemporadaTime;
use App\Repositories\TemporadaTimeRepository;

use App\Partida;
use App\Repositories\PartidaRepository;

use App\PontoPosicao;
use App\Repositories\PontoPosicaoRepository;

use App\pontoKill;
use App\Repositories\PontoKillRepository;

use App\SomaPontosKillPartida;
use App\Repositories\SomaPontosKillPartidaRepository;

use App\ClassificacaoPartida;
use App\Repositories\ClassificacaoPartidaRepository;

use App\Vw_classificacao;
use App\Repositories\VW_ClassificacaoRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class ClassificacaoPartidaController extends Controller
{

    public function index()
    {
        $temporadas = new TemporadaRepository;
        $temporadas = $temporadas->findAll();

        return view('pages.classificacaoPartida.classificacao', [
            'temporadas' => $temporadas
        ]);
    }

    public function classificacaoPartida(Request $request) {

        $data = $request->all(); 

        if (empty($data['id_temporada'])){

            $temporadas = new TemporadaRepository;
            $temporadas = $temporadas->findAll();

            $alert = [
                'status' => 'error', 
                'message' => 'A temporada deve ser informada'
            ];

            return view('pages.classificacaoPartida.classificacao', [
            'temporadas' => $temporadas, 
            'alert' => $alert
            ]);
        }
        
        $temporadas = new TemporadaRepository;
        $temporadas = $temporadas->find($data['id_temporada']);
        
        $partida = new PartidaRepository;
        $partida = $partida->pesquisarPartidasTemporada($data['id_temporada']);

        return view('pages.classificacaoPartida.classificacao-partida', [
            'partidas' => $partida,
            'temporada' => $temporadas
        ]);
    }

    public function classificacaoTimes(Request $request) {

        $data = $request->all(); 
        
        $temporadas = new TemporadaRepository;
        $temporadas = $temporadas->find($data['id_temporada']);

        if (empty($data['id_partida']) ){

            $alert = [
                'status' => 'error', 
                'message' => 'A rodada deve ser informada'
            ];

            $partida = new PartidaRepository;
            $partida = $partida->pesquisarPartidasTemporada($temporadas->id);

            return view('pages.classificacaoPartida.classificacao-partida', [
            'temporada' => $temporadas, 
            'partidas' => $partida,
            'alert' => $alert
            ]);

        }
        
        
        $partida = new PartidaRepository;
        $partida = $partida->find($data['id_partida']);

        $repository = new PontoPosicaoRepository;
        $pontoPosicao = $repository->findAll();

        $txtpontoPosicao = '';

        $temporadaTime = new TemporadaTimeRepository;
        $temporadaTime = $temporadaTime->find($data['id_temporada']);

        $qtd_kill = array();

        for ($i=0; $i<=50; $i++) {
            array_push($qtd_kill, $i);
        }

        return view('pages.classificacaoPartida.classificacao-partida-times', [
            'partidas' => $partida,
            'temporada' => $temporadas,
            'temporadaTime' => $temporadaTime,
            'pontoPosicao' => $pontoPosicao,
            'txtpontoPosicao' => $txtpontoPosicao,
            'qtd_kill' => $qtd_kill
        ]);
    }

    public function storeClassificacaoTimes(Request $request){

        $data = $request->all(); 

        $this->validarCampos($data);

        $temporadaTime = new TemporadaTimeRepository;
        $temporadaTime = $temporadaTime->findSingle($data['id_temporada_time']);

        $data['id_time'] = $temporadaTime->id_time;
        $data['id_temporada'] = $temporadaTime->id_temporada;

        $pontosKill = new PontoKillRepository;
        if ($pontosKill = $pontosKill->findSingleAsc()) {

            $data['soma_pontos_kill'] =  $data['qtd_kill'] * $pontosKill->ponto_kill;
            
        }else{
            return 'temporada_time n encontrado';
        }
        

        try{

            $ExisteClassificaPartida = new ClassificacaoPartidaRepository;
            $ExisteClassificaPartida =  $ExisteClassificaPartida->existeCadastrado(
                $data['id_temporada_time'],  $data['id_partida']
            );

            if (!$ExisteClassificaPartida) {

                $classificacaoPartida = new ClassificacaoPartida;
                $classificacaoPartida->fill($data);

                if ($classificacaoPartida->save()) {

                    $buscarId = new ClassificacaoPartidaRepository;
                    $buscarId = $buscarId->buscarId($data);

                    $data['id_classificacao_partida'] = $buscarId->id;

                    $verificarExiste = new SomaPontosKillPartidaRepository;
                    $verificarExiste =  $verificarExiste->find($data['id_classificacao_partida']);

                   

                    if (!$verificarExiste) {

                        $somaPontosKillPartida = new SomaPontosKillPartida;
                        $somaPontosKillPartida->fill($data);

                        if ($somaPontosKillPartida->save()) {

                            $alert = [
                                'status' => 'success', 
                                'message' => 'Cadastro da pontuação do time realizado com sucesso'
                            ];

                        }

                    } else {

                        $alert = [
                            'status' => 'error', 
                            'message' => 'Este time já esta cadastrado nesta rodada/temporada'
                        ];
                    }

                }
  
            } else {
                $alert = [
                    'status' => 'error', 
                    'message' => 'Este time já esta cadastrado nesta rodada/temporada'
                ];
            }


            $temporadas = new TemporadaRepository;
            $temporadas = $temporadas->find($data['id_temporada']);
            
            $partida = new PartidaRepository;
            $partida = $partida->find($data['id_partida']);

            $pontoPosicao = $data['pontoPosicao'];
            $pontoPosicao = json_decode($pontoPosicao);
            $pontoPosicao = (object)$pontoPosicao;

            $temporadaTime = new TemporadaTimeRepository;
            $temporadaTime = $temporadaTime->find($data['id_temporada']);

            $y = 0;
            $posicaoLivre = array();
            
            foreach ($pontoPosicao as $posicao){

                if ($posicao->id == $data['id_posicao']) { 
                    unset($posicao);
                }else{
                    array_push($posicaoLivre, $posicao);
                }
                $y ++;  
            }
                
            $txtpontoPosicao = json_encode($posicaoLivre);

            $qtd_kill = array();

            for ($i=0; $i<=50; $i++) {
                array_push($qtd_kill, $i);
            }

   
        }catch(\Exception $e){

            $alert = [
                'status' => 'error', 
                'message' => 'Erro ao salvar a classificação dos times na partida! <br>'. substr($e->getMessage(), 0, 70)
            ];
            
        }

        return view('pages.classificacaoPartida.classificacao-partida-times', [
            'partidas' => $partida,
            'temporada' => $temporadas,
            'temporadaTime' => $temporadaTime,
            'pontoPosicao' => $posicaoLivre,
            'qtd_kill' => $qtd_kill,
            'txtpontoPosicao' => $txtpontoPosicao,
            'alert'=>$alert
        ]);



        
        

    }

    public function validarCampos($data) {

        $temporadas = new TemporadaRepository;
        $temporadas = $temporadas->findAll();

        $alert = [
            'status' => 'error', 
            'message' => 'erro campo vazio'
        ];

        if (empty($data['qtd_kill'])) {
            return view('pages.classificacaoPartida.classificacao', [
                'temporadas' => $temporadas,
                'alert'=> $alert
            ]);
        }
        if (empty($data['id_posicao'])) {
            return view('pages.classificacaoPartida.classificacao', [
                'temporadas' => $temporadas,
                'alert'=> $alert
            ]);
        }
        if (empty($data['id_temporada_time'])) {
            return view('pages.classificacaoPartida.classificacao', [
                'temporadas' => $temporadas,
                'alert'=> $alert
            ]);
        }
        if (empty($data['id_partida'])) {
            return view('pages.classificacaoPartida.classificacao', [
                'temporadas' => $temporadas,
                'alert'=> $alert
            ]);
        }

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

    public function Classificacao() {

        $temporadas = new TemporadaRepository;
        $temporadas = $temporadas->findAll();

        $classificacao = new VW_ClassificacaoRepository;
        $id = '11';
        $classificacao = $classificacao->findTemporada($id);

        return view('pages.classificacaoTemporada.classificacao-temporada', [
            'temporadas' => $temporadas,
            'classificacao' => $classificacao
        ]);
    }


}
