<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrandeArea extends Model
{
  protected $table = 'Grande_Area';
  protected $primaryKey = 'cod_grande_area';
  protected $guarded = ['cod_grande_area'];
}
