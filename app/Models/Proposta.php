<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    protected $table = 'Proposta';
    protected $primaryKey = 'cod_proposta';
    protected $guarded = ['cod_proposta'];

    public function propositor()
    {
      return $this->belongsTo('App\Models\UsuarioPropositor', 'Usuario_Propositor_cod_propositor');
    }

    public function obra()
    {
      return $this->hasOne('App\Models\Obra', 'Proposta_cod_proposta');
    }

    public function doc_sugestao_alteracoes()
    {
      return $this->hasMany('App\Models\DocSugestaoAlteracoes', 'Proposta_cod_proposta');
    }

    public function oficio_alteracoes()
    {
      return $this->hasMany('App\Models\OficioAlteracoes', 'Proposta_cod_proposta');
    }

    public function parecer()
    {
      return $this->hasMany('App\Models\Parecer', 'Proposta_cod_proposta');
    }

    public function usuario_admin()
    {
      return $this->belongsTo('App\Models\UsuarioAdmin', 'Usuario_Admin_cod_admin');
    }


    //Proposta tecnico catalografia

    //Notificação


}
