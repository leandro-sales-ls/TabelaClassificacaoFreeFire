<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Repositories\UnidadeFaturamentoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Http\Request;

class UnidadeFaturamentoTest extends TestCase
{
    /**
     * UnidadeFaturamento Test
     *
     * @return void
     */

    public function testUnidadeFaturamentoCamposObrigatorios()
    { 
        // Verificar nom_unidade_faturamento        
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento' => null,
            'num_unidade_faturamento' => '1',
            'id_comarca'  => '341',
            'id_centro_custo'  => '1',
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
                'error' => 'Nome é obrigatório'
            ]);


        // Verificar num_unidade_faturamento        
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento' => 'Teste Unidade Faturamento',
            'num_unidade_faturamento' => null,
            'id_comarca'  => '341',
            'id_centro_custo'  => '1',
            'data_inicio_vigencia' =>date('Y-m-d'),
            'data_fim_vigencia'=>'',
            'usuario_inclusao'=>'usuario teste',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
         
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Número é obrigatório'
            ]);

        // Verificar id_comarca        
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento' => 'Teste Unidade Faturamento',
            'num_unidade_faturamento' => '1',
            'id_comarca'  => null,
            'id_centro_custo'  => '1',
            'data_inicio_vigencia' =>date('Y-m-d'),
            'data_fim_vigencia'=>'',
            'usuario_inclusao'=>'usuario teste',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
       
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Comarca é obrigatória'
            ]);

         // Verificar id_centro_custo   
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento' => 'Teste Unidade Faturamento',
            'num_unidade_faturamento' => '1',
            'id_comarca'  => '341',
            'id_centro_custo'  => null,
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_fim_vigencia'=>'',
            'usuario_inclusao'=>'usuario teste',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
          
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Centro de Custo é obrigatório'
            ]);  

        // Verificar data_inicio_vigencia   
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento' => 'Teste Unidade Faturamento',
            'num_unidade_faturamento' => '1',
            'id_comarca'  => '341',
            'id_centro_custo'  => '1',
            'data_inicio_vigencia' => null,
            'data_fim_vigencia'=>'',
            'usuario_inclusao'=>'usuario teste',
            'versao'=>'1',
            'usuario_ult_alteracao'=>'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
           
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Data Início é obrigatória'
            ]);  
            
            
        // Verificar usuario_ult_alteracao   
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento' => 'Teste Unidade Faturamento',
            'num_unidade_faturamento' => '1',
            'id_comarca'  => '341',
            'id_centro_custo'  => '1',
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_fim_vigencia'=>'',
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=> null,
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            

        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Usuário última alteração é obrigatório'
            ]);   

        // Verificar id_pessoa_ult_alteracao   
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento' => 'Teste Unidade Faturamento',
            'num_unidade_faturamento' => '1',
            'id_comarca'  => '341',
            'id_centro_custo'  => '1',
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_fim_vigencia'=>'',
            'usuario_inclusao'=>'usuario',
            'versao'=>'1',
            'usuario_ult_alteracao'=> 'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>null,
            

        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Id pessoa última alteração é obrigatório'
            ]);  

        // Verificar versao   
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento' => 'Teste Unidade Faturamento',
            'num_unidade_faturamento' => '1',
            'id_comarca'  => '341',
            'id_centro_custo'  => '1',
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_fim_vigencia'=>'',
            'usuario_inclusao'=>'usuario',
            'versao'=> null,
            'usuario_ult_alteracao'=> 'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            

        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Versão é obrigatória'
            ]);  

        // Verificar usuario_inclusao   
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento' => 'Teste Unidade Faturamento',
            'num_unidade_faturamento' => '1',
            'id_comarca'  => '341',
            'id_centro_custo'  => '1',
            'data_inicio_vigencia' => date('Y-m-d'),
            'data_fim_vigencia'=>'',
            'usuario_inclusao'=>null,
            'versao'=> '1',
            'usuario_ult_alteracao'=> 'usuario teste',
            'id_pessoa_inclusao'=>'1',
            'id_pessoa_ult_alteracao'=>'1',
            

        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Usuário inclusão é obrigatório'
            ]);  

         
     
        // Verificar id_pessoa_inclusao   
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento'   => 'Teste Unidade Faturamento',
            'num_unidade_faturamento'   => '1',
            'id_comarca'                => '341',
            'id_centro_custo'           => '1',
            'data_inicio_vigencia'      => date('Y-m-d'),
            'data_fim_vigencia'         => null, 
            'usuario_inclusao'          =>'usuario teste',
            'versao'                    => '1',
            'usuario_ult_alteracao'     => 'usuario teste',
            'id_pessoa_inclusao'        =>null,
            'id_pessoa_ult_alteracao'   =>'1',
            

        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Id pessoa inclusão é obrigatório'
            ]);  


          

         // Verificar periodo  
        $dataMaior = date('Y-m-d',strtotime("now" . "+1 days")); 
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento'   => 'Teste Unidade Faturamento',
            'num_unidade_faturamento'   => '1',
            'id_comarca'                => '341',
            'id_centro_custo'           => '1',
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
        

        $dataMenor = date('Y-m-d',strtotime("now" . "-1 days")); 
        $campoVazio = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento'   => 'Teste Unidade Faturamento',
            'num_unidade_faturamento'   => '1',
            'id_comarca'                => '341',
            'id_centro_custo'           => '1',
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
                'error' => 'A data fim tem que ser maior ou igual ao dia de hoje.'
            ]);              

    }


    public function testCriarUnidadeFaturamento()
    { 
        //create
        $unidade = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento'   => 'Teste Unidade Faturamento',
            'num_unidade_faturamento'   => '1',
            'id_comarca'                => '341',
            'id_centro_custo'           => '1',
            'data_inicio_vigencia'      => date('Y-m-d'),
            'data_fim_vigencia'         => null, 
            'usuario_inclusao'          =>'usuario teste',
            'versao'                    => '1',
            'usuario_ult_alteracao'     => 'usuario teste',
            'id_pessoa_inclusao'        => '1',
            'id_pessoa_ult_alteracao'   => '1',
        
        ]);

        $unidade
            ->assertStatus(200)
            ->assertJson([
                'error' => ''
            ]);

            // mesmo nome
            $unidade = $this->postJson('/api/unidade-faturamento-create', [
                'nom_unidade_faturamento'   => 'Teste Unidade Faturamento',
                'num_unidade_faturamento'   => '2',
                'id_comarca'                => '341',
                'id_centro_custo'           => '1',
                'data_inicio_vigencia'      => date('Y-m-d'),
                'data_fim_vigencia'         => null, 
                'usuario_inclusao'          =>'usuario teste',
                'versao'                    => '1',
                'usuario_ult_alteracao'     => 'usuario teste',
                'id_pessoa_inclusao'        => '1',
                'id_pessoa_ult_alteracao'   => '1',
            
            ]);
    
            $unidade
                ->assertStatus(200)
                ->assertJson([
                    'error' => 'Nome já cadastrado em outra Unidade de Faturamento.'
                ]);
        
        //mesmo número
        $unidade = $this->postJson('/api/unidade-faturamento-create', [
            'nom_unidade_faturamento'   => 'Teste Unidade Faturamento 2',
            'num_unidade_faturamento'   => '1',
            'id_comarca'                => '341',
            'id_centro_custo'           => '1',
            'data_inicio_vigencia'      => date('Y-m-d'),
            'data_fim_vigencia'         => null, 
            'usuario_inclusao'          =>'usuario teste',
            'versao'                    => '1',
            'usuario_ult_alteracao'     => 'usuario teste',
            'id_pessoa_inclusao'        => '1',
            'id_pessoa_ult_alteracao'   => '1',
        
        ]);

        $unidade
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Número já cadastrado em outra Unidade de Faturamento.'
            ]);
    
    }
    public function testEditarUnidadeFaturamento()
    {
        $unidadeRepository = new UnidadeFaturamentoRepository;
        $unidade = $unidadeRepository->getPorNome('Teste Unidade Faturamento')->first();
        $teste = $this->putJson('/api/unidade-faturamento-update/'.$unidade->id_unidade_faturamento, [
            'nom_unidade_faturamento'   => 'Teste Unidade Faturamento Alterado',
            'id_comarca'                => '341',
            'id_centro_custo'           => '1',
            'data_fim_vigencia'         => null, 
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

    public function testDesabilitarUnidadeFaturamento()
    {
        $unidadeRepository = new UnidadeFaturamentoRepository;
        $unidade = $unidadeRepository->getPorNome('Teste Unidade Faturamento Alterado')->first();
        $teste = $this->putJson('/api/unidade-faturamento-update/'.$unidade->id_unidade_faturamento, [
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
    public function testExcluirUnidadeFaturamento()
    {
        $unidadeRepository = new UnidadeFaturamentoRepository;
        $unidade = $unidadeRepository->getPorNome('Teste Unidade Faturamento Alterado')->first();
        $teste = $this->getJson('/api/unidade-faturamento-delete/'.$unidade->id_unidade_faturamento);
        $teste
        ->assertStatus(200)
        ->assertJson([
            'error' => ''
        ]);
    }
    

}
