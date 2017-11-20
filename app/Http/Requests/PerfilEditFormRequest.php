<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilEditFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'nome'=>'required|min:1|max:50',
          'sobrenome'=>'required|min:1|max:100',
          'sexo'=>'required',
          'cpf'=>'required|digits:11',
          'rg'=>'required|digits_between:6,14',
          'estado_civil'=>'required',
          'telefone'=>'required|digits_between:6,14',
          'telefone_secundario'=>'nullable|digits_between:6,14',
          'instituicao'=>'required|min:2|max:100',
          'sigla'=>'nullable|min:2|max:20',
          'vinculo'=>'nullable|min:2|max:200',
          'email_contato'=>'required|email',
          'email_acesso'=>'required|email',
          //'password'=>'required'
        ];
    }
}
