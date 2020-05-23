<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PontoPosicao extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'ponto_posicao';
    protected $primaryKey = 'id';
  
    const CREATED_AT = 'data_inclusao';
    const UPDATED_AT = 'data_ult_alteracao';

    protected $fillable = [
       'pontos_posicao','posicao'
    ];
    
}

 

