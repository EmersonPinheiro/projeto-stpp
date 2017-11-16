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
      //TODO: Verificar permisser do usuário.

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
            'titulo'=>'required|min:2|max:100',
            'subtitulo'=>'required|min:2|max:100',
            'descricao'=>'required|min:2|max:10000',
            'grande_area_obra'=>'required|min:2|max:100',
            'area_conhecimento_obra'=>'required|min:2|max:100',
            'subarea_obra'=>'nullable|min:2|max:100',
            'especialidade_obra'=>'nullable|min:2|max:100',

            'nome'=>'required|min:1|max:50',
            'sobrenome'=>'required|min:1|max:100',
            'sexo'=>'required',
            'cpf'=>'required|digits:11',
            'rg'=>'required|digits_between:6,14',
            'estado_civil'=>'required',
            'email'=>'nullable|max:100|email',
            'telefone'=>'required|digits_between:6,14',
            'telefone_secundario'=>'nullable|digits_between:6,14',
            'instituicao'=>'required|min:2|max:100',
            'sigla'=>'nullable|min:2|max:20',
            'vinculo'=>'nullable|min:2|max:200',
            'grande_area_autor'=>'required|min:2|max:100',
            'area_conhecimento_autor'=>'required|min:2|max:100',
            'subarea_autor'=>'nullable|min:2|max:100',
            'especialidade_autor'=>'nullable|min:2|max:100',

            'documento_s_identificacao'=>'required|mimes:doc, docx, odt',
            'documento_c_identificacao'=>'required|mimes:doc, docx, odt',
            'imagens'=>'nullable|file|mimes:rar, zip',
        ];
    }
}
