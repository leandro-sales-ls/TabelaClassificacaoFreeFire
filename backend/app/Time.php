<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'time';
    protected $primaryKey = 'id';

    const CREATED_AT = 'data_inclusao';
    const UPDATED_AT = 'data_ult_alteracao';

    protected $fillable = [
        'logo','nome_time','nome_representante'
    ];

}
