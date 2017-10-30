<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
  protected $table = 'Pais';
  protected $primaryKey = 'cod_pais';
  protected $guarded = ['cod_pais'];

  public function estado_provincia()
  {
    return $this->hasMany('App\Models\EstadoProvincia', 'Pais_cod_pais');
  }
}
