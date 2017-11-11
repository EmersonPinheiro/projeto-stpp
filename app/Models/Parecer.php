<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Parecer extends Model
{
  protected $table = 'Parecer';
  protected $primaryKey = 'cod_parecer';
  protected $guarded = ['cod_parecer'];
  protected $dates = ['prazo_envio'];

  public function proposta()
  {
    return $this->belongsTo('App\Models\Proposta', 'Proposta_cod_proposta');
  }

  public function usuario_propositor()
  {
    return $this->belongsTo('App\Models\UsuarioPropositor', 'Usuario_cod_usuario');
  }

  public function getPrazoRestanteAttribute()
  {
    $today = Carbon::now('America/Sao_Paulo');

    if ($today->gt($this->prazo_envio)) {
      $prazoRestante = 0;
    }
    else{
      $prazoRestante = ($this->prazo_envio)->diffInDays($today);
    }

    return $prazoRestante;
  }

  public function getEnvioAttribute()
  {
    if ($this->url_documento != null) {
      return true;
    }
    else {
      return false;
    }
  }
}
