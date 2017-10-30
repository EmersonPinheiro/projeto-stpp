<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
  protected $table = 'Departamento';
  protected $primaryKey = 'cod_departamento';
  protected $guarded = ['cod_departamento'];

  public function setor()
  {
    return $this->belongsTo('App\Models\Setor', 'Setor_cod_setor');
  }

  //Usuario parecerista

  public function autor()
  {
    return $this->hasMany('App\Models\Autor', 'Departamento_cod_departamento');
  }
}
