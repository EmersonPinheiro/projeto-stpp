<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoProvincia extends Model
{
  protected $table = 'Estado_provincia';
  protected $primaryKey = 'cod_est_prov';
  protected $guarded = ['cod_est_prov'];

  public function cidade()
  {
    return $this->hasMany('App\Models\Cidade', 'Estado_provincia_cod_est_prov');
  }

  public function pais()
  {
    return $this->belongsTo('App\Models\Pais', 'Pais_cod_pais');
  }
}
