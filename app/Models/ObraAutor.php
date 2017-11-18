<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObraAutor extends Model
{
  protected $table = 'Obra_Autor';
  protected $fillable = ['Autor_cod_autor', 'Obra_cod_obra'];
}
