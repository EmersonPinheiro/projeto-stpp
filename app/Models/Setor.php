<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
  protected $table = 'Setor';
  protected $primaryKey = 'cod_setor';
  protected $guarded = ['cod_setor'];

  public function instituicao()
  {
    return $this->belongsTo('App\Models\Instituicao', 'Instituicao_cod_instituicao');
  }

  public function departamento()
  {
    return $this->hasMany('App\Models\Departamento', 'Setor_cod_setor');
  }
}
