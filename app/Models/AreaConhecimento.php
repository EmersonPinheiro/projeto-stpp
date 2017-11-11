<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaConhecimento extends Model
{
  protected $table = 'Area_Conhecimento';
  protected $primaryKey = 'cod_area_conhec';
  protected $guarded = ['cod_area_conhec'];
}
