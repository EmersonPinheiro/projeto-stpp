<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VinculoInstitucional extends Model
{
  protected $table = 'Vinculo_Institucional';
  protected $primaryKey = 'cod_vinculo';
  protected $guarded = ['cod_vinculo'];
}
