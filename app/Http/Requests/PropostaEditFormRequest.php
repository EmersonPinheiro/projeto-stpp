<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropostaEditFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      //TODO: Verificar permissions do usuário.

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
          'titulo'=>'required|min:3|max:100',
          'subtitulo'=>'required|max:100',
          'descricao'=>'required|min:3|max:100',
          'resumo'=>'required|min:3|max:100',
          'nome'=>'required|min:3|max:50',
          'sobrenome'=>'required|min:3|max:100',
          //existem mais campos
        ];
    }
}
