<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PontoKill extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'ponto_kill';
    protected $primaryKey = 'id';
  
    const CREATED_AT = 'data_inclusao';
    const UPDATED_AT = 'data_ult_alteracao';

    protected $fillable = [
        'id_temporada','ponto_kill','num_kill'
    ];
    
}

 

