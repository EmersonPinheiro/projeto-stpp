<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialVersionFormRequest extends FormRequest
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
            'novo_documento_identificado'=>'required|file|mimes:doc,docx,odt',
            'novo_documento_nao_identificado'=>'required|file|mimes:doc,docx,odt',
            'novas_imagens'=>'nullable|file|mimes:rar,zip',
            'oficio'=>'required|file|mimes:pdf',
        ];
    }
}
