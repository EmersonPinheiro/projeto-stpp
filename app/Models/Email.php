<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
  protected $table = 'Email';
  protected $primaryKey = 'cod_email';
  protected $guarded = ['cod_email'];

  public function pessoa()
  {
    return $this->belongsTo('App\Models\Pessoa', 'Pessoa_cod_pessoa');
  }
}
