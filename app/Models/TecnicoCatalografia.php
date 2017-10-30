<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TecnicoCatalografia extends Model
{

  protected $table = 'Tecnico_Catalografia';
  protected $primaryKey = 'cod_tec_catalog';
  protected $guarded = ['cod_tec_catalog'];

  public function pessoa()
  {
    return $this->belongsTo('App\Models\Pessoa', 'Pessoa_cod_pessoa');
  }

  //pŕoposta tecnico catalografia
}
