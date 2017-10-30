<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OficioAlteracoes extends Model
{
  protected $table = 'Oficio_Alteracoes';
  protected $primaryKey = 'cod_oficio';
  protected $guarded = ['cod_oficio'];

  public function proposta()
  {
    return $this->belongsTo('App\Models\Proposta', 'Proposta_cod_proposta');
  }
}
