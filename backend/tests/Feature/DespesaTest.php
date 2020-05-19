<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

use Illuminate\Http\Request;

class DespesaTest extends TestCase
{
    /**
     * Despesa Test
     *
     * @return void
     */
 

    public function testListarDespeas()
    { 

        // Verificar todos os periodos quando não informa valores        
        $campoVazio = $this->getJson('/api/despesa-filter', [
            'id_beneficiario' => '',
            'id_periodo' =>'',
            'id_situacao_despesa'=>'',
                   
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => ''
            ]);
         
    }

    public function testExcluirDespesa()
    {
        $repository = new DespesaRepository;
        $model = $repository->getPorFlgExclui(1)->first();
        $teste = $this->getJson('/api/despesa-delete/'.$model->id_despesa);
        $teste
        ->assertStatus(200)
        ->assertJson([
            'error' => ''
        ]);

        $repository = new DespesaRepository;
        $model = $repository->getPorFlgExclui(0)->first();
        $teste = $this->getJson('/api/despesa-delete/'.$model->id_despesa);
        $teste
        ->assertStatus(200)
        ->assertJson([
            'error' => 'Exclusão para status da despesa não permitida.'
    
        ]);
 
    }
    public function testIncluirDespesa()
    { 

        $data = date('Y-m-d',strtotime("now")); 
        $beneficiarioRepository = new BeneficiarioRepository;
        $beneficiario = $beneficiarioRepository->findAtivos()->first();
        // Verificar se os campos podem ser inseridos vazio        
        $campoVazio = $this->postJson('/api/despesas', [
            'id_beneficiario' => $beneficiario->id_beneficiario,
            'id_tipo_documento' =>'',
            'data_expedicao'=>'',
            'num_documento' => '',
            'num_cnpj_cpf_fornecedor' =>'',
            'nom_fornecedor'=>'',
            'des_produto_motivo' => '',
            'val_despesa' =>'',
            'arq_integra_despesa'=>'',
            'nom_arquivo_integra_despesa' =>'',
            'usuario_inclusao'=>'teste',
            'versao'=>'0',
            'usuario_ult_alteracao'=>'teste',
            'id_pessoa_inclusao'=>'0',
            'id_pessoa_ult_alteracao'=>'0',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $campoVazio
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Tipo documento é obrigatório.'
            ]);

        $inclusao = $this->postJson('/api/despesas', [
            'id_beneficiario' => $beneficiario->id_beneficiario,
            'id_tipo_documento' =>'1',
            'data_expedicao'=>$data,
            'num_documento' => '100',
            'num_cnpj_cpf_fornecedor' =>'51310399085',
            'nom_fornecedor'=>'Teste',
            'des_produto_motivo' => 'produto teste',
            'val_despesa' =>'100.99',
            'arq_integra_despesa'=>'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',
            'nom_arquivo_integra_despesa' =>'images.png',
            'usuario_inclusao'=>'teste',
            'versao'=>'0',
            'usuario_ult_alteracao'=>'teste',
            'id_pessoa_inclusao'=>'0',
            'id_pessoa_ult_alteracao'=>'0',
            'oid_aplicacao_inclusao'=>'',
            'oid_aplicacao_ult_alteracao'=>''
        
        ]);

        $inclusao
            ->assertStatus(200)
            ->assertJson([
                'error' => ''
            ]);


   }


    public function testEditarDespesa()
    { 

        $data = date('Y-m-d',strtotime("now")); 

        $repository = new DespesaRepository;
        $model = $repository->getPorFlgEdita(0)->first();
        if ($model) 
        {

           $campoVazio = $this->putJson('/api/despesas/'.$model->id_despesa, [
                'id_tipo_documento' =>'1',
                'data_expedicao'=>$data,
                'num_documento' => '12',
                'num_cnpj_cpf_fornecedor' =>'51310399085',
                'nom_fornecedor'=>'Teste',
                'des_produto_motivo' => 'Teste',
                'val_despesa' =>'100.99',
                'arq_integra_despesa'=>'',
                'nom_arquivo_integra_despesa' =>'',
                'usuario_inclusao'=>'teste',
                'versao'=>'0',
                'usuario_ult_alteracao'=>'teste',
                'id_pessoa_inclusao'=>'0',
                'id_pessoa_ult_alteracao'=>'0',
                'oid_aplicacao_inclusao'=>'',
                'oid_aplicacao_ult_alteracao'=>''
            
            ]);

            $campoVazio
                ->assertStatus(200)
                ->assertJson([
                    'error' => 'Edição para status da despesa não permitida.'
                ]);
        }

        $model = $repository->getPorFlgEdita(1)->first();
        if ($model) 
        {
            $campoVazio = $this->putJson('/api/despesas/'.$model->id_despesa, [
                'id_tipo_documento' =>'',
                'data_expedicao'=>'',
                'num_documento' => '',
                'num_cnpj_cpf_fornecedor' =>'',
                'nom_fornecedor'=>'',
                'des_produto_motivo' => '',
                'val_despesa' =>'',
                'arq_integra_despesa'=>'',
                'nom_arquivo_integra_despesa' =>'',
                'usuario_inclusao'=>'teste',
                'versao'=>'0',
                'usuario_ult_alteracao'=>'teste',
                'id_pessoa_inclusao'=>'0',
                'id_pessoa_ult_alteracao'=>'0',
                'oid_aplicacao_inclusao'=>'',
                'oid_aplicacao_ult_alteracao'=>''
            
            ]);

            $campoVazio
                ->assertStatus(200)
                ->assertJson([
                    'error' => 'Tipo documento é obrigatório.'
                ]);

                $campoVazio = $this->putJson('/api/despesas/'.$model->id_despesa, [
                    'data_expedicao'=>$data,
                    'versao'=>'0',
                    'usuario_ult_alteracao'=>'teste',
                    'id_pessoa_ult_alteracao'=>'0',
                    'oid_aplicacao_inclusao'=>'',
                    'oid_aplicacao_ult_alteracao'=>''
                
                ]);
    
                $campoVazio
                    ->assertStatus(200)
                    ->assertJson([
                        'error' => ''
                    ]);                
        }

    }


}
