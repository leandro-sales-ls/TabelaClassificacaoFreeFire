<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;
use App\Repositories\TimeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TimeController extends Controller
{

    /**
     * Lista Beneficiario.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repository = new TimeRepository;
        return $repository->findAll();

    }
    /**
     * Incluir Beneficiário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{ 
        
        $error = "";
        $data = $request->all();

        $time = new Time;
        $time->fill($data);
        
        $time->save();

            // try { 
            // $time->save();
            // }catch(\Exception $e){
            //     DB::rollback();
            //     $error='Erro ao salvar Time' . $e;
            // } 
       
    
        }catch(\Exception $e){
            $error='Erro ao salvar Time' . $e;
        }  
        return response()->json([
            'error' => $error,
            'data'  => $time
        ]);
    }

     
    public function edit($id)
    {
        $error = "";

        $repository = new BeneficiarioRepository; 
        $beneficiario = $repository->find($id); 

        if (!$beneficiario )
        {
            $error = "Beneficiário não encontrado";  
        } 

        return response()->json([
            'error' => $error,
            'data'  => $beneficiario  
        ]);

    }

    
    public function update($id, Request $request)
    {
        $error = "";
        $data = $request->all();

        $repository = new BeneficiarioRepository; 
        $beneficiario = $repository->find($id); 
   
        if (!$beneficiario)
        {
            $error = "Beneficiário não encontrado";  

        } else {

            $beneficiario->fill($data);
       
            if (isset($beneficiario->data_fim_vigencia))
            {
                $dataFim =Carbon::parse($beneficiario->data_fim_vigencia);
                $beneficiario->data_fim_vigencia = $dataFim->format('Y-m-d');
            }

            $msg = $this->validaBeneficiario($beneficiario);
            if (empty($msg))
            {
                $msg = $this->validaPeriodoUpdate($beneficiario);
            }
            if (empty($msg) && $beneficiario->tip_forma_pagamento == 2 && 
                !empty($beneficiario->num_cartao_credito))
            { 
                $msg = $this->validaCartao($beneficiario);
                
            }
            if ( !empty($msg) )
            { 
                $error=$msg;
            } else {

                if (isset($beneficiario->data_fim_vigencia))
                {
                    if ($beneficiario->data_fim_vigencia < Carbon::today()->format('Y-m-d'))
                    { 
                        $beneficiario->flg_situacao = '0';
                    }else{
                        $beneficiario->flg_situacao = '1';
                    } 
                } else {
                    $beneficiario->flg_situacao = '1';
                }
                if ($beneficiario->tip_forma_pagamento == 1 ) {
                    $beneficiario->num_cartao_credito = null;
                }else{
                    $beneficiario->id_banco = null;
                    $beneficiario->cod_agencia = null;
                    $beneficiario->cod_digito_agencia = null;
                    $beneficiario->num_conta_corrente = null;
                    $beneficiario->cod_digito_conta_corrente = null;
                }
  
                try { 
                    $beneficiario->save();
             
                }catch(\Exception $e){
                    DB::rollback();
                    $error='Erro ao salvar Beneficiário' . $e;
                }  
            }   
           
        }

        return response()->json([
            'error' => $error,
            'data'  => $beneficiario
        ]);

    }

    public function filter(Request $request)
    {
        try { 
            $table=[];
            $error="";
            $repository = new BeneficiarioRepository;
            $data = $request->all();
            $beneficiarios = $repository->filter($data);
            
            foreach ($beneficiarios as $beneficiario)
            {
                $table[] = [
                'id_beneficiario'            => $beneficiario->id_beneficiario,
                'nom_colaborador'           => $beneficiario->nom_colaborador,
                'nom_unidade'               => $beneficiario->nom_unidade, 
                'nom_unidade_faturamento'   => $beneficiario->nom_unidade_faturamento, 
                'data_inicio_vigencia'      => date('d/m/Y',strtotime($beneficiario->data_inicio_vigencia)),
                'data_fim_vigencia'         => (isset ($beneficiario->data_fim_vigencia)? date('d/m/Y',strtotime($beneficiario->data_fim_vigencia)):''),
                'flg_situacao'              => $beneficiario->flg_situacao
                ];
            }

        }catch(\Exception $e){
            $error='Erro Pesquisa Beneficiário' . $e;
        }  
        return response()->json([
            'error' => $error,
            'data'  => $table
        ]);
      

    }
  
    public function delete($id)
    {
        $error = "";
        $data = "";
         
        $repository = new BeneficiarioRepository; 
        $beneficiario = $repository->find($id); 
  
        if (!$beneficiario)
        {
            $error = "Beneficiário não encontrado";  

        } else {
            $msg = $this->verificaVinculo($beneficiario);  
            if ( !empty($msg) )
            { 
                $error=$msg;
            } else {

                try { 
                    $beneficiario->delete();

                }catch(\Exception $e){
                    $error='Erro ao excluir Beneficiário' . $e;
                }  
        
            }
        }
        return response()->json([
            'error' => $error,
            'data'  => $data
        ]);

    }
     /**
     * Verifica vinculo com Delegado e Despesas
     */
  
}
