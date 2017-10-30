<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'Material';
    protected $primaryKey = 'cod_material';
    protected $guarded = ['cod_material'];

    public function obra()
    {
      return $this->belongsTo('App\Models\Obra', 'Obra_cod_obra');
    }
}
