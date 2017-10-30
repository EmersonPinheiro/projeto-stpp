<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Autor;

class Pessoa extends Model
{
  protected $table = 'Pessoa';
  protected $primaryKey = 'cod_pessoa';
  protected $guarded = ['cod_pessoa'];

  public function telefone()
  {
    return $this->hasMany('App\Models\Telefone', 'Pessoa_cod_pessoa');
  }

  public function email()
  {
    return $this->hasMany('App\Models\Email', 'Pessoa_cod_pessoa');
  }

  public function cidade()
  {
    return $this->belongsTo('App\Models\Cidade', 'Cidade_cod_cidade');
  }

  public function autor()
  {
    return $this->hasMany('App\Models\Autor', 'Pessoa_cod_pessoa');
  }

  public function usuario()
  {
    return $this->hasMany('App\Models\User', 'Pessoa_cod_pessoa');
  }

  public function tecnico_catalografia()
  {
    return $this->hasMany('App\Models\TecnicoCatalografia', 'Pessoa_cod_pessoa');
  }
}
