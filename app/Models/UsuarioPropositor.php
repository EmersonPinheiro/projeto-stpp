<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioPropositor extends Model
{
    protected $table = 'Usuario_Propositor';
    protected $primaryKey = 'cod_propositor';
    protected $guarded = ['cod_propositor'];

    public function usuario()
    {
      return $this->belongsTo('App\Models\User', 'Usuario_cod_usuario');
    }

    public function proposta()
    {
      return $this->hasMany('App\Models\Proposta', 'Usuario_Propositor_cod_propositor');
    }
}
