<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parecer extends Model
{
  protected $table = 'Parecer';
  protected $primaryKey = 'cod_parecer';
  protected $guarded = ['cod_parecer'];

  public function proposta()
  {
    return $this->belongsTo('App\Models\Proposta', 'Proposta_cod_proposta');
  }

  public function usuario_propositor()
  {
    return $this->belongsTo('App\Models\UsuarioPropositor', 'Usuario_cod_usuario');
  }
}
