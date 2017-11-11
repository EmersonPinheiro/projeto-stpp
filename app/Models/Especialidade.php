<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
  protected $table = 'Especialidade';
  protected $primaryKey = 'cod_especialidade';
  protected $guarded = ['cod_especialidade'];
}
