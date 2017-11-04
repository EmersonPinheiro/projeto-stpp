<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Autor;

class Obra extends Model
{
    protected $table = 'Obra';
    protected $primaryKey = 'cod_obra';
    protected $guarded = ['cod_obra'];

    public function proposta()
    {
      return $this->hasOne('App\Proposta', 'Proposta_cod_proposta');
    }

    public function autor()
    {
      return $this->belongsTo('App\Models\Autor', 'Autor_cod_autor');
    }

    public function material()
    {
      return $this->hasMany('App\Models\Material', 'Obra_cod_obra');
    }

    //obra_palavra_chave

}
