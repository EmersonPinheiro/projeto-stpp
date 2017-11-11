<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subarea extends Model
{
  protected $table = 'Subarea';
  protected $primaryKey = 'cod_subarea';
  protected $guarded = ['cod_subarea'];
}
