<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TemporadaTime extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'temporada_time';
    protected $primaryKey = 'id';

    const CREATED_AT = 'data_inclusao';
    const UPDATED_AT = 'data_ult_alteracao';

    protected $fillable = [
        'id_temporada','id_time'
    ];

}
