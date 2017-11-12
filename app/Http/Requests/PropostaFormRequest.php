<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropostaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      //TODO: Verificar permission do usuário.

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
            'descricao'=>'required|min:3',
            'nome'=>'required|min:3|max:50',
            'sobrenome'=>'required|min:3|max:100',
            'CPF'=>'required|min:11|max:11',
            'rg'=>'required|max:14',
            'sexo'=>'required',
            'estado_civil'=>'required',
            'instituicao'=>'required|min:3',
            'setor'=>'required|min:3|string',
            'departamento'=>'required|min:3',
            'area_de_conhecimento'=>'required|min:3',
            'email'=>'required|email|max:255',
            'telefone'=>'required|numeric',
            'logradouro'=>'required'
            'bairro'=>'required',
            'cidade'=>'required|min:3',
            'estado'=>'required|min:3',
            'pais'=>'required|min:3',
            'documento'=>'required|mimes:doc, docx, odt',
            'imagens'=>'file|mimes:rar, zip',
        ];
    }
}
