<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\BeneficiarioRepository;

class BeneficiarioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHabilitarBeneficiario()
    {
        /**
        * @description Habilitando beneficiario
        * @author Leandro Sales <leandro.sales@capgemini.com>
        */ 

        $beneficiario = $this->postJson('/api/beneficiario-create', [
            'id_membro_servidor'            => '1222',
            'id_unidade_solicitacao'        => '1',
            'id_unidade_faturamento'        => '3',
            'data_inicio_vigencia'          =>  date('Y-m-d'),
            'data_fim_vigencia'             =>  date('Y-m-d', strtotime('+20 days')),
            'versao'                        => '1',
            'usuario_ult_alteracao'         => 'usr',
            'id_pessoa_inclusao'            => '0',
            'id_pessoa_ult_atualizacao'     => '0',
            'tip_forma_pagamento'           => '1',
            'cod_banco'                     => '341',
            'cod_agencia'                   => '1122',
            'cod_digito_agencia'            => '',
            'num_conta_corrente'            => '34567',
            'cod_digito_conta_corrente'     => '8',
            'num_cartao_credito'            => '',
            'oid_aplicacao_inclusao'        => '',
            'oid_aplicacao_ult_alteracao'   => '',   
        
        ]);

        $beneficiario
            ->assertStatus(200)
            ->assertJson([
                'error' => ''
            ]);

        /**
        * @description Validar registro de usuario cadastrado com o mesmo id e 
        * unidade de solicitação no mesmo periodo
        */    
        $beneficiario = $this->postJson('/api/beneficiario-create', [
            'id_membro_servidor'            => '1222',
            'id_unidade_solicitacao'        => '1',
            'id_unidade_faturamento'        => '3',
            'data_inicio_vigencia'          =>  date('d/m/Y'),
            'data_fim_vigencia'             =>  date('d/m/Y', strtotime('+20 days')),
            'versao'                        => '1',
            'usuario_ult_alteracao'         => 'usr',
            'id_pessoa_inclusao'            => '0',
            'id_pessoa_ult_atualizacao'     => '0',
            'tip_forma_pagamento'           => '1',
            'cod_banco'                     => '341',
            'cod_agencia'                   => '1122',
            'cod_digito_agencia'            => '',
            'num_conta_corrente'            => '34567',
            'cod_digito_conta_corrente'     => '8',
            'num_cartao_credito'            => '',
            'oid_aplicacao_inclusao'        => '',
            'oid_aplicacao_ult_alteracao'   => '',   
        
        ]);

        $beneficiario
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Já existe outro beneficiário ativo nesse período e nessa unidade.'
            ]);

        
        /**
        * @description Validar registro beneficiarios sem preencher campos obrigatorios
        */    
        $beneficiario = $this->postJson('/api/beneficiario-create', [
            'id_membro_servidor'            => '',
            'id_unidade_solicitacao'        => '',
            'id_unidade_faturamento'        => '',
            'data_inicio_vigencia'          => '2020-02-05 00:00:00',
            'data_fim_vigencia'             => '2020-02-29 00:00:00',
            'versao'                        => '1',
            'usuario_ult_alteracao'         => 'usr',
            'id_pessoa_inclusao'            => '0',
            'id_pessoa_ult_atualizacao'     => '0',
            'tip_forma_pagamento'           => '1',
            'cod_banco'                     => '',
            'cod_agencia'                   => '',
            'cod_digito_agencia'            => '',
            'num_conta_corrente'            => '',
            'cod_digito_conta_corrente'     => '8',
            'num_cartao_credito'            => '',
            'oid_aplicacao_inclusao'        => '',
            'oid_aplicacao_ult_alteracao'   => '',   
        
        ]);

        $beneficiario
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Nome é obrigatório'
            ]);

        /**
        * @description Validar campos data fim e data inicio, 
        * se data fim é maior ou igual a data inicio.
        */    
        $beneficiario = $this->postJson('/api/beneficiario-create', [
            'id_membro_servidor'            => '1222',
            'id_unidade_solicitacao'        => '1',
            'id_unidade_faturamento'        => '3',
            'data_inicio_vigencia'          => '2023-02-05 00:00:00',
            'data_fim_vigencia'             => '2023-02-04 00:00:00',
            'versao'                        => '1',
            'usuario_ult_alteracao'         => 'usr',
            'id_pessoa_inclusao'            => '0',
            'id_pessoa_ult_atualizacao'     => '0',
            'tip_forma_pagamento'           => '1',
            'cod_banco'                     => '341',
            'cod_agencia'                   => '1122',
            'cod_digito_agencia'            => '',
            'num_conta_corrente'            => '34567',
            'cod_digito_conta_corrente'     => '8',
            'num_cartao_credito'            => '',
            'oid_aplicacao_inclusao'        => '',
            'oid_aplicacao_ult_alteracao'   => '',   
        
        ]);

        $beneficiario
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Data Fim menor que Data Início'
            ]);



        /**
        * @description Validar se o numero do cartão ja esta cadastrado
        */ 
        $beneficiario = $this->postJson('/api/beneficiario-create', [
            'id_membro_servidor'            => '1222',
            'id_unidade_solicitacao'        => '2',
            'id_unidade_faturamento'        => '5',
            'data_inicio_vigencia'          =>  date('d/m/Y'),
            'data_fim_vigencia'             =>  date('d/m/Y', strtotime('+20 days')),
            'versao'                        => '1',
            'usuario_ult_alteracao'         => 'usr',
            'id_pessoa_inclusao'            => '0',
            'id_pessoa_ult_atualizacao'     => '0',
            'tip_forma_pagamento'           => '',
            'cod_banco'                     => '',
            'cod_agencia'                   => '',
            'cod_digito_agencia'            => '',
            'num_conta_corrente'            => '',
            'cod_digito_conta_corrente'     => '',
            'num_cartao_credito'            => '1234567456123456',
            'oid_aplicacao_inclusao'        => '',
            'oid_aplicacao_ult_alteracao'   => '',   
        
        ]);

        $beneficiario
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Já existe outro beneficiário ativo com esse número de cartão.'
            ]);
  
            
    }

    public function testDesabilitarBeneficiario()
    {

        $beneficiarioRepository = new BeneficiarioRepository;
        $beneficiarioRepository->getPorLimit();
        /**
        * @description Validar data fim menor que data inicio
        */ 
        $beneficiario = $this->putJson('/api/beneficiario-update/'.$beneficiarioRepository, [
            'id_membro_servidor'            => '1222',
            'id_unidade_solicitacao'        => '2',
            'id_unidade_faturamento'        => '5',
            //'data_inicio_vigencia'          =>  date('d/m/Y'),
            'data_fim_vigencia'             =>  '01/01/2010',
            'versao'                        => '1',
            'usuario_ult_alteracao'         => 'usr',
            'id_pessoa_inclusao'            => '0',
            'id_pessoa_ult_atualizacao'     => '0',
            'tip_forma_pagamento'           => '',
            'cod_banco'                     => '',
            'cod_agencia'                   => '',
            'cod_digito_agencia'            => '',
            'num_conta_corrente'            => '',
            'cod_digito_conta_corrente'     => '',
            'num_cartao_credito'            => '1234567456123456',
            'oid_aplicacao_inclusao'        => '',
            'oid_aplicacao_ult_alteracao'   => '',   
        
        ]);

        $beneficiario
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Data Fim menor que Data Início'
            ]);

            /**
        * @description Validar data fim se é menor que data inicio
        */ 
    }

    public function testEditarBeneficiario()
    {

        $beneficiario
            ->assertStatus(200)
            ->assertJson([
                'errors' => true,
            ]);

        $beneficiarioRepository = new BeneficiarioRepository;
        $beneficiarioRepository->getPorLimit();
        /**
        * @description Validar edição do beneficiario passando campos nulos
        */ 
        $beneficiario = $this->getJson('/api/beneficiario-edit/'.$beneficiarioRepository, [
            'id_membro_servidor'            => '',
            'id_unidade_solicitacao'        => '2',
            'id_unidade_faturamento'        => '5',
            //'data_inicio_vigencia'          =>  date('d/m/Y'),
            'data_fim_vigencia'             =>  '',
            'versao'                        => '1',
            'usuario_ult_alteracao'         => 'usr',
            'id_pessoa_inclusao'            => '0',
            'id_pessoa_ult_atualizacao'     => '0',
            'tip_forma_pagamento'           => '',
            'cod_banco'                     => '',
            'cod_agencia'                   => '',
            'cod_digito_agencia'            => '',
            'num_conta_corrente'            => '',
            'cod_digito_conta_corrente'     => '',
            'num_cartao_credito'            => '',
            'oid_aplicacao_inclusao'        => '',
            'oid_aplicacao_ult_alteracao'   => '',   
        
        ]);

        $beneficiario
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Nome é obrigatório'
            ]);

        /**
        * @description Validar se o numero do cartão ja esta cadastrado
        */ 
        $beneficiario = $this->getJson('/api/beneficiario-edit/'.$beneficiarioRepository, [
            'id_membro_servidor'            => '1222',
            'id_unidade_solicitacao'        => '2',
            'id_unidade_faturamento'        => '5',
            'data_inicio_vigencia'          =>  date('Y-m-d'),
            'data_fim_vigencia'             =>  date('Y-m-d', strtotime('+20 days')),
            'versao'                        => '1',
            'usuario_ult_alteracao'         => 'usr',
            'id_pessoa_inclusao'            => '0',
            'id_pessoa_ult_atualizacao'     => '0',
            'tip_forma_pagamento'           => '',
            'cod_banco'                     => '',
            'cod_agencia'                   => '',
            'cod_digito_agencia'            => '',
            'num_conta_corrente'            => '',
            'cod_digito_conta_corrente'     => '',
            'num_cartao_credito'            => '1234567456123456',
            'oid_aplicacao_inclusao'        => '',
            'oid_aplicacao_ult_alteracao'   => '',   
        
        ]);

        $beneficiario
            ->assertStatus(200)
            ->assertJson([
                'error' => 'Já existe outro beneficiário ativo com esse número de cartão.'
            ]);

    }

}
