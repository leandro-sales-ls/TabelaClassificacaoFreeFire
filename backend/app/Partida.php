<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'partida';
    protected $primaryKey = 'id';
  
    const CREATED_AT = 'data_inclusao';
    const UPDATED_AT = 'data_ult_alteracao';

    protected $fillable = [
       'num_rodada','id_temporada'
    ];
    
}

 

