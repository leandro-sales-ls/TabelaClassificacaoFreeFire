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
        'id','logo','nome_time','nome_representante'
    ];
      
    // public function unidadeFaturamento() 
    // {
    //     return $this->belongsTo(UnidadeFaturamento::class,'id_unidade_faturamento');
    // }   

  
    // public function delegados()
    // {
    //     return $this->hasMany(Delegado::class,'id_beneficiario');
    // }

    // public function despesas()
    // {
    //     return $this->hasMany(Despesa::class,'id_beneficiario');
    // }
    
}

 

