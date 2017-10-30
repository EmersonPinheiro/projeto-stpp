<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocSugestaoAlteracoes extends Model
{
  protected $table = 'Doc_Sugestao_Alteracoes';
  protected $primaryKey = 'cod_sug_alteracoes';
  protected $guarded = ['cod_sug_alteracoes'];

  public function proposta()
  {
    return $this->belongsTo('App\Models\Proposta', 'Proposta_cod_proposta');
  }
}
