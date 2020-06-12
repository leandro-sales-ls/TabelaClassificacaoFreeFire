<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SomaPontosKillPartida extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'soma_pontos_kill_partida';
    protected $primaryKey = 'id';

    const CREATED_AT = 'data_inclusao';
    const UPDATED_AT = 'data_ult_alteracao';

    protected $fillable = [
        'id_classificacao_partida','soma_pontos_kill'
    ];

}
