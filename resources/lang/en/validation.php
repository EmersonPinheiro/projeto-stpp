<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute deve ser aceito.',
    'active_url'           => ':attribute não é uma URL válida.',
    'after'                => ':attribute deve ser uma data após :date.',
    'after_or_equal'       => ':attribute deve ser uma data igual ou após :date.',
    'alpha'                => ':attribute só pode conter letras.',
    'alpha_dash'           => ':attribute só pode conter letras, números e traços.',
    'alpha_num'            => ':attribute só pode conter letras e números.',
    'array'                => ':attribute deve ser um vetor.',
    'before'               => ':attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => ':attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => ':attribute deve estar entre :min e :max.',
        'file'    => ':attribute deve estar entre :min e :max kilobytes.',
        'string'  => ':attribute deve estar entre :min e :max characters.',
        'array'   => ':attribute deve conter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser true ou false.',
    'confirmed'            => 'A confirmação :attribute não é correspondente.',
    'date'                 => ':attribute não é uma data válida.',
    'date_format'          => ':attribute não corresponde ao formato :format.',
    'different'            => ':attribute e :other devem ser diferentes.',
    'digits'               => ':attribute deve conter :digits digitos.',
    'digits_between'       => ':attribute deve ter entre :min e :max digitos.',
    'dimensions'           => ':attribute possui dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute contém um valor duplicado.',
    'email'                => ':attribute deve ser um endereçode e-mail válido.',
    'exists'               => ':attribute selecionado é inválido.',
    'file'                 => ':attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve conter um valor.',
    'image'                => ':attribute deve ser uma imagem.',
    'in'                   => ':attribute selecionado é invalido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => ':attribute deve ser um inteiro.',
    'ip'                   => ':attribute deve ser um endereço IP válido.',
    'ipv4'                 => ':attribute deve ser um enedereço IPv4 válido.',
    'ipv6'                 => ':attribute deve ser um enedereço IPv6 válido.',
    'json'                 => ':attribute deve ser uma string JSON válida.',
    'max'                  => [
        'numeric' => ':attribute não deve ser maior que :max.',
        'file'    => ':attribute não deve ser maior que :max kilobytes.',
        'string'  => ':attribute não deve ser maior que :max caracteres.',
        'array'   => ':attribute não deve conter mais de :max itens.',
    ],
    'mimes'                => ':attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => ':attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute deve ser pelo menos :min.',
        'file'    => ':attribute deve ser de pelo menos :min kilobytes.',
        'string'  => ':attribute deve ser de pelo menos :min caracteres.',
        'array'   => ':attribute deve conter pelo menos :min itens.',
    ],
    'not_in'               => ':attribute selecionado é invalido.',
    'numeric'              => ':attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório a não ser que :other está em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum de :values estão presentes.',
    'same'                 => ':attribute e :other devem corresponder.',
    'size'                 => [
        'numeric' => ':attribute deve ter tamanho :size.',
        'file'    => ':attribute deve ter tamanho :size kilobytes.',
        'string'  => ':attribute deve ter tamanho :size characters.',
        'array'   => ':attribute deve conter :size itens.',
    ],
    'string'               => ':attribute deve ser uma string.',
    'timezone'             => ':attribute deve ser uma zona válida.',
    'unique'               => ':attribute já existe.',
    'uploaded'             => ':attribute falhou ao carregar.',
    'url'                  => 'O formato :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
