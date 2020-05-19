<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Repositories\PeriodoRepository;

use Illuminate\Http\Request;

class PeriodoTest extends TestCase
{
    /**
     * Periodo Test
     *
     * @return void
     */

    public function testCriarPeriodo()
    { 

    
        // Verificar se os campos podem ser inseridos vazio        
        $campoVazio = $this->postJson('/api/periodo-create', [
            'des_periodo' => '',
            'data_inicio_periodo' =>'',
            'data_fim_periodo'=>'',
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Nome é obrigatório'
            ]);

         $dataMaior = date('Y-m-d',strtotime("now" . "+1 days")); 

        //Verificar se data fim pode ser maior que data inicio    
        $dataFimMaior = $this->postJson('/api/periodo-create', [
            'des_periodo' => 'nomePeriodoExemplo',
            'data_inicio_periodo' =>$dataMaior,
            'data_fim_periodo'=>date('Y-m-d'), 
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $dataFimMaior
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Data Fim menor que Data Início'
            ]);

         $dataMenor = date('Y-m-d',strtotime("now" . "-1 days")); 
        //Verificar se data fim pode ser menor que hoje    
        $dataFimMenorHoje = $this->postJson('/api/periodo-create', [
            'des_periodo' => 'nomePeriodoExemplo',
            'data_inicio_periodo' =>$dataMenor,
            'data_fim_periodo'=>$dataMenor,
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $dataFimMenorHoje
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Data Fim menor que Data Atual',
            ]);

            //criando
            $periodo = $this->postJson('/api/periodo-create', [
                'des_periodo' => 'TestePeriodo',
                'data_inicio_periodo' =>date('Y-m-d'),
                'data_fim_periodo'=>date('Y-m-d'),
                'usuario_inclusao'=>'usuario',
                'versao'=>'1',
                'usuario_ult_alteracao'=>'usuario',
                'id_pessoa_inclusao'=>'1',
                'id_pessoa_ult_alteracao'=>'1',
                'oid_aplicacao_inclusao'=>'',
                'oid_aplicacao_ult_alteracao'=>''
            
            ]);
    
            $periodo
                ->assertStatus(200)
                ->assertJson([
                    'error' => ''
                ]);
    

        //Verificar se data fim ou data inicio possui interseção com outro periodo cadastrado.  
        $existeOutroPeriodo = $this->postJson('/api/periodo-create', [
            'des_periodo' => 'TestePeriodo',
            'data_inicio_periodo' =>date('Y-m-d'),
            'data_fim_periodo'=>date('Y-m-d'),
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $existeOutroPeriodo
            ->assertStatus(200)
            ->assertJson([
                'error' => 'As datas de início e de fim não podem pertencer a outro periodo.',
            ]);
           
    }

    public function testEditarPeriodo()
    { 

        $periodoRepository = new PeriodoReposiyory;
        $periodo = $periodoRepository->getPorLimit();

        // Verificar se os campos podem ser inseridos vazio        
        $campoVazio = $this->putJson('/api/periodo-edit/'.$periodo, [
            'des_periodo' => '',
            'data_inicio_periodo' =>'',
            'data_fim_periodo'=>'',
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Nome é obrigatório'
            ]);

        $dataMaior = date('Y-m-d',strtotime("now" . "+1 days")); 
        //Verificar se data fim pode ser menor que data inicio    
        $dataFimMaior = $this->putJson('/api/periodo-edit/'.$periodo, [
            'des_periodo' => 'nomePeriodoExemplo',
            'data_inicio_periodo' => $dataMaior,
            'data_fim_periodo'=>date('Y-m-d'),
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $dataFimMaior
            ->assertStatus(200)
            ->assertJson([
                'error' => 'A data fim tem que ser maior ou igual a data início.'
            ]);
         $dataMenor = date('Y-m-d',strtotime("now" . "-1 days")); 
        //Verificar se data fim pode ser menor que hoje    
        $dataFimMenorHoje = $this->putJson('/api/periodo-edit/'.$periodo, [
            'des_periodo' => 'nomePeriodoExemplo',
            'data_inicio_periodo' =>$dataMenor,
            'data_fim_periodo'=>$dataMenor,
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $dataFimMenorHoje
            ->assertStatus(200)
            ->assertJson([
                'error' => 'A data fim tem que ser maior ou igual ao dia de hoje.',
            ]);

        //Verificar se data fim ou data inicio possui interseção com outro periodo cadastrado.  
        $existeOutroPeriodo = $this->putJson('/api/periodo-edit/'.$periodo, [
            'des_periodo' => 'TestePeriodo',
            'data_inicio_periodo' =>date('Y-m-d'),
            'data_fim_periodo'=>date('Y-m-d'),
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $existeOutroPeriodo
            ->assertStatus(200)
            ->assertJson([
                'error' => 'As datas de início e de fim não podem pertencer a outro periodo.',
            ]);
         
         
    }

    public function testListarPeriodo()
    { 

        // Verificar todos os periodos quando não informa valores        
        $campoVazio = $this->getJson('/api/periodo-filter', [
            'des_periodo' => '',
            'data_inicio_periodo' =>'',
            'data_fim_periodo'=>'',
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => ''
            ]);
         
    }

    public function testExcluirPeriodo()
    { 

        $periodoRepository = new PeriodoReposiyory;
        $periodo = $periodoRepository->getPorLimit();

        $teste = $this->getJson('/api/periodo-delete/'.$periodo);
        $teste
            ->assertStatus(200)
            ->assertJson([
                'error' => ''
        ]);
    } 

    


}
