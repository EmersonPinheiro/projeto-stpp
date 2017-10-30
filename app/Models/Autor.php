<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pessoa;

class Autor extends Model
{
  protected $table = 'Autor';
  protected $primaryKey = 'cod_autor';
  protected $guarded = ['cod_autor'];

  public function pessoa()
  {
    return $this->belongsTo('App\Models\Pessoa', 'Pessoa_cod_pessoa');
  }

  public function departamento()
  {
    return $this->belongsTo('App\Models\Departamento', 'Departamento_cod_departamento');
  }

  public function obra()
  {
    return $this->hasMany('App\Models\Obra', 'Autor_cod_autor');
  }

  //Autor especialidade
}
