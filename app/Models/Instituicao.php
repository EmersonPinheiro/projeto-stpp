<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
  protected $table = 'Instituicao';
  protected $primaryKey = 'cod_instituicao';
  protected $guarded = ['cod_instituicao'];

  public function setor()
  {
    return $this->hasMany('App\Models\Setor', 'Instituicao_cod_instituicao');
  }
}
