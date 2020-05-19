<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Repositories\DelegadoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Http\Request;

class DelegadoTest extends TestCase
{
    /**
     * Delegado Test
     *
     * @return void
     */

    public function testStore()
    { 
        // Verificar id_beneficiario        
        $campoVazio = $this->postJson('/api/delegado-create', [
            'id_beneficiario'=>null,
            'id_colaborador_delegado'=>1,
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_fim_vigencia'=>null,
            'usuario_inclusao'=>'usuario teste',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Beneficiário é obrigatório'
            ]);


        // Verificar id_colaborador_delegado        
        $campoVazio = $this->postJson('/api/delegado-create', [
            'id_beneficiario'=>1,
            'id_colaborador_delegado'=>null,
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_fim_vigencia'=>null,
            'usuario_inclusao'=>'usuario teste',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
         
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Delegado é obrigatório'
            ]);

        // Verificar id_comarca        
        $campoVazio = $this->postJson('/api/delegado-create', [
            'id_beneficiario'=>1,
            'id_colaborador_delegado'=>2,
            'data_inicio_vigencia' => null,
            'data_fim_vigencia'=>null,
            'usuario_inclusao'=>'usuario teste',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''      
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Data Início é obrigatória'
            ]);
             

         // Verificar periodo  
        $dataMaior = date('Y-m-d',strtotime("now" . "+1 days")); 
        $campoVazio = $this->postJson('/api/delegado-create', [
            'id_beneficiario'=>1,
            'id_colaborador_delegado'=>2,
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_inicio_vigencia'      => $dataMaior,
            'data_fim_vigencia'         => date('Y-m-d'), 
            'usuario_inclusao'          =>'usuario teste',
            'versao'                    => '1',
            'usuario_ult_alteracao'     => 'usuario teste',
            'id_pessoa_inclusao'        => '1',
            'id_pessoa_ult_alteracao'   => '1',
            

        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Data Fim menor que Data Início'
            ]);  
        

        $dataMenor = date('Y-m-d',strtotime("now" . "+1 days")); 
        $campoVazio = $this->postJson('/api/delegado-create', [
            'id_beneficiario'=>1,
            'id_colaborador_delegado'=>2,
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_inicio_vigencia'      => $dataMenor,
            'data_fim_vigencia'         => $dataMenor, 
            'usuario_inclusao'          =>'usuario teste',
            'versao'                    => '1',
            'usuario_ult_alteracao'     => 'usuario teste',
            'id_pessoa_inclusao'        => '1',
            'id_pessoa_ult_alteracao'   => '1',
            

        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Data Início maior que Data Atual'
            ]);


        $dataMenor = date('Y-m-d',strtotime("now" . "-1 days")); 
        $campoVazio = $this->postJson('/api/delegado-create', [
            'id_beneficiario'=>1,
            'id_colaborador_delegado'=>2,
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_inicio_vigencia'      => $dataMenor,
            'data_fim_vigencia'         => $dataMenor, 
            'usuario_inclusao'          =>'usuario teste',
            'versao'                    => '1',
            'usuario_ult_alteracao'     => 'usuario teste',
            'id_pessoa_inclusao'        => '1',
            'id_pessoa_ult_alteracao'   => '1',
            

        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Data Fim menor que Data Atual'
            ]);


            
        //create
        $delegado = $this->postJson('/api/delegado-create', [
            'id_beneficiario'=>1,
            'id_colaborador_delegado'=>2,
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_inicio_vigencia'      => date('Y-m-d'),
            'data_fim_vigencia'         => null, 
            'usuario_inclusao'          =>'usuario teste',
            'versao'                    => '1',
            'usuario_ult_alteracao'     => 'usuario teste',
            'id_pessoa_inclusao'        => '1',
            'id_pessoa_ult_alteracao'   => '1',
        
        ]);

        $delegado
            ->assertStatus(200)
            ->assertJson([
                'error' => ''
            ]);

        // mesmo delegado no mesmo periodo
        $delegado = $this->postJson('/api/delegado-create', [
            'id_beneficiario'=>1,
            'id_colaborador_delegado'=>2,
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_inicio_vigencia'      => date('Y-m-d'),
            'data_fim_vigencia'         => null, 
            'usuario_inclusao'          =>'usuario teste',
            'versao'                    => '1',
            'usuario_ult_alteracao'     => 'usuario teste',
            'id_pessoa_inclusao'        => '1',
            'id_pessoa_ult_alteracao'   => '1',
        
        ]);

        $delegado
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Já existe outro delegado ativo nesse período e para esse beneficiário.'
            ]);

    }

    public function testExcluirDelegado()
    {
        $delegadoRepository = new DelegadoRepository;
        $delegado = $delegadoRepository->findAtivos()->first();
        $teste = $this->putJson('/api/delegado-delete/'.$delegado->id_delegado);

        $teste
        ->assertStatus(200)
        ->assertJson([
            'error' => ''
        ]);
    }

    public function testDesabilitarDelegado()
    {
        $delegadoRepository = new DelegadoRepository;
        $delegado = $delegadoRepository->findAtivos()->first();
        $teste = $this->putJson('/api/delegado-update/'.$delegado->id_delegado, [
            'data_fim_vigencia'         => date('Y-m-d'), 
            'versao'                    => '1',
            'usuario_ult_alteracao'     => 'usuario teste',
            'id_pessoa_ult_alteracao'   => '1',
        ]);

        $teste
        ->assertStatus(200)
        ->assertJson([
            'error' => ''
        ]);
    }

}
