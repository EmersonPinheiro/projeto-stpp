<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioParecerista extends Model
{
  protected $table = 'Usuario_Parecerista';
  protected $primaryKey = 'cod_parecerista';
  protected $guarded = ['cod_parecerista'];

  public function usuario()
  {
    return $this->belongsTo('App\Models\Usuario', 'Usuario_cod_usuario');
  }

  public function departamento()
  {
    return $this->belongsTo('App\Models\Departamento', 'Departamento_cod_departamento');
  }

  public function parecer()
  {
    return $this->hasMany('App\Models\Parecer', 'Usuario_Parecerista_cod_parecerista');
  }

  //usuario parecerista especialidade
  
}
