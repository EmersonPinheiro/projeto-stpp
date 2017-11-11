<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutorEspecialidade extends Model
{
  protected $table = 'Autor_Especialidade';
  protected $fillable = ['Autor_cod_autor', 'Especialidade_cod_especialidade'];
}
