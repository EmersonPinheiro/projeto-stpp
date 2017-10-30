<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = 'Telefone';
    protected $primaryKey = 'cod_telefone';
    protected $guarded = ['cod_telefone'];

    public function pessoa()
    {
      return $this->belongsTo('Pessoa', 'Pessoa_cod_pessoa');
    }
}
