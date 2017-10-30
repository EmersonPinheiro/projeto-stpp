<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
  protected $table = 'Cidade';
  protected $primaryKey = 'cod_cidade';
  protected $guarded = ['cod_cidade'];

  public function pessoa()
  {
    return $this->hasMany('App\Models\Pessoa', 'Pessoa_cod_pessoa');
  }

  public function estado_provincia()
  {
    return $this->belongsTo('App\Models\EstadoProvincia', 'Estado_provincia_cod_est_prov');
  }
}
