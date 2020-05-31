<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'temporada';
    protected $primaryKey = 'id';
  
    const CREATED_AT = 'data_inclusao';
    const UPDATED_AT = 'data_ult_alteracao';

    protected $fillable = [
       'nome_temporada','num_max_partida'
    ];
    
}

 

