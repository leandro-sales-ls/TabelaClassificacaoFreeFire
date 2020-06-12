<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassificacaoPartida extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'classificacao_partida';
    protected $primaryKey = 'id';

    const CREATED_AT = 'data_inclusao';
    const UPDATED_AT = 'data_ult_alteracao';

    protected $fillable = [
        'id_temporada_time','id_time','id_partida','id_posicao'
    ];

}
