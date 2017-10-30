<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConviteParecerista extends Model
{
    protected $fillable = ['email', 'token', 'proposta'];
    protected $table = 'Convite_Parecerista';

}
