<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vw_classificacao extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'vw_classificacao_soma';
    protected $primaryKey = 'id';

}
