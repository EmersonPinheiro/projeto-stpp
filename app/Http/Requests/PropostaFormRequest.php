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
            /* Obra */
            'titulo'=>'required|min:3|max:100',
            'subtitulo'=>'required|max:100',
            'descricao'=>'required|min:3',
            'grande_area_obra'=>'required|min:3|string',
            'area_conhecimento_obra'=>'required|min:3|string',
            'subarea_obra'=>'nullable|min:3|string',
            'especialidade_obra'=>'nullable|min:3|string',

            /* Pessoa */
            'nome'=>'required|min:3|max:50',
            'sobrenome'=>'required|min:3|max:100',
            'CPF'=>'required|min:11|max:11',
            'rg'=>'required|max:14',
            'sexo'=>'required',
            'estado_civil'=>'required',

            /* Contato/Endereço */
            'email'=>'required|email|max:255',
            'telefone'=>'required|numeric',

            /* Instituicao/Area de conhecimento do autor */
            'instituicao'=>'required|min:3',
            'setor'=>'nullable|min:3|string',
            'departamento'=>'nullable|min:3|string',
            'grande_area_autor'=>'required|min:3|string',
            'area_conhecimento_autor'=>'required|min:3|string',
            'subarea_autor'=>'nullable|min:3|string',
            'especialidade_autor'=>'nullable|min:3|string',

            /* Arquivos */
            'documento_s_identificacao'=>'required|mimes:doc, docx, odt',
            'documento_c_identificacao'=>'required|mimes:doc, docx, odt',
            'imagens'=>'file|mimes:rar, zip',
        ];
    }
}
