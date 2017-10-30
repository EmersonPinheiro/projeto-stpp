<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioAdmin extends Model
{
  protected $table = 'Usuario_Admin';
  protected $primaryKey = 'cod_adm';
  protected $guarded = ['cod_adm'];

  public function usuario()
  {
    return $this->belongsTo('App\Models\Usuario', 'Usuario_cod_usuario');
  }
  
  public function proposta()
  {
    return $this->hasMany('App\Models\Proposta', 'Proposta_cod_proposta');
  }
}
