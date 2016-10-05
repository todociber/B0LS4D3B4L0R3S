<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    "accepted"         => ":attribute debe ser aceptado.",
    "active_url"       => ":attribute no es una URL v�lida.",
    "after"            => ":attribute debe ser una fecha posterior a :date.",
    "alpha"            => ":attribute solo debe contener letras.",
    "alpha_dash"       => ":attribute solo debe contener letras, n�meros y guiones.",
    "alpha_num"        => ":attribute solo debe contener letras y n�meros.",
    "array"            => ":attribute debe ser un conjunto.",
    "before"           => ":attribute debe ser una fecha anterior a :date.",
    "between"          => [
        "numeric" => ":attribute tiene que estar entre :min - :max.",
        "file"    => ":attribute debe pesar entre :min - :max kilobytes.",
        "string"  => ":attribute tiene que tener entre :min - :max caracteres.",
        "array"   => ":attribute tiene que tener entre :min - :max �tems.",
    ],
    "boolean"          => "El campo :attribute debe tener un valor verdadero o falso.",
    "confirmed"        => "La confirmaci�n de :attribute no coincide.",
    "date"             => ":attribute no es una fecha v�lida.",
    "date_format"      => ":attribute no corresponde al formato :format.",
    "different"        => ":attribute y :other deben ser diferentes.",
    "digits"           => ":attribute debe tener :digits d�gitos.",
    "digits_between"   => ":attribute debe tener entre :min y :max d�gitos.",
    "email" => ":attribute no es un correo v�lido",
    "exists"           => ":attribute es inv�lido.",
    "filled"           => "El campo :attribute es obligatorio.",
    "image"            => ":attribute debe ser una imagen.",
    "in"               => ":attribute es inv�lido.",
    "integer"          => ":attribute debe ser un n�mero entero.",
    "ip"               => ":attribute debe ser una direcci�n IP v�lida.",
    'json'             => 'El campo :attribute debe tener una cadena JSON v�lida.',
    "max"              => [
        "numeric" => ":attribute no debe ser mayor a :max.",
        "file"    => ":attribute no debe ser mayor que :max kilobytes.",
        "string"  => ":attribute no debe ser mayor que :max caracteres.",
        "array"   => ":attribute no debe tener m�s de :max elementos.",
    ],
    "mimes"            => ":attribute debe ser un archivo con formato: :values.",
    "min"              => [
        "numeric" => "El tama�o de :attribute debe ser de al menos :min.",
        "file"    => "El tama�o de :attribute debe ser de al menos :min kilobytes.",
        "string"  => ":attribute debe contener al menos :min caracteres.",
        "array"   => ":attribute debe tener al menos :min elementos.",
    ],
    "not_in"           => ":attribute es inv�lido.",
    "numeric"          => ":attribute debe ser numérico.",
    "regex"            => "El formato de :attribute es inv�lido.",
    "required"         => "El campo :attribute es obligatorio.",
    "required_if"      => "El campo :attribute es obligatorio cuando :other es :value.",
    "required_with"    => "El campo :attribute es obligatorio cuando :values est� presente.",
    "required_with_all" => "El campo :attribute es obligatorio cuando :values est� presente.",
    "required_without" => "El campo :attribute es obligatorio cuando :values no est� presente.",
    "required_without_all" => "El campo :attribute es obligatorio cuando ninguno de :values est�n presentes.",
    "same"             => ":attribute y :other deben coincidir.",
    "size"             => [
        "numeric" => "El tama�o de :attribute debe ser :size.",
        "file"    => "El tama�o de :attribute debe ser :size kilobytes.",
        "string"  => ":attribute debe contener :size caracteres.",
        "array"   => ":attribute debe contener :size elementos.",
    ],
    "string"           => "El campo :attribute debe ser una cadena de caracteres.",
    "timezone"         => "El :attribute debe ser una zona v�lida.",
    "unique"           => ":attribute ya ha sido registrado.",
    "url"              => "El formato :attribute es inv�lido.",
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
        'email' => [
            'required' => 'El correo electrónico es requerido',
            'email' => 'Debe escribir un correo electrónico valido',
            'unique'=>'El correo electrónico ingresado ya se encuentra registrado'
        ],
        'password2' => [
            'required' => 'Debe escribir una contraseña',

        ],
        'password' => [
            'required' => 'Debe escribir una contraseña',

        ],
        'numeroafiliacion' => [
            'required' => 'El código de afiliación es requerido',
            'numeric' => 'Debe ingrear solo números para el codigod e afiliación',
            'digits' => 'Número de afiliación no debe ser menor o mayor a 5 digitos',
            'min' => 'Número de afiliación no debe ser negativo',
        ],
        'casaCorredora' => [
            'required' => 'Debe ingresar la casa corredora a la que desea afiliarse',

        ],
        'cedeval.*.cuenta' => [
            'required' => 'Debe ingresar al menos una cuenta cedeval',
            'numeric' => 'La cuenta cedeval solo debe llevar números',
            'unique' => 'Una o varias de las cuentas cedeval ingresadas ya se encuentran registradas',
            'digits' => 'Número de cuenta no debe ser menor o mayor a 10 digitos',
            'min' => 'Número de cuenta no debe ser un número negativo',
            'integer' => 'Número de cuenta debe ser número entero',
        ],
        'CuentaCedeval' => [
            'required' => 'Debe ingresar el número de cuenta',
            'numeric' => 'La cuenta cedeval solo debe llevar números',
            'unique' => 'Esta cuenta cedeval ya se encuentra registrada',
            'digits' => 'Número de cuenta no debe ser menor o mayor a 10 digitos',

        ],
        'direccion' => [
            'required' => 'Debe ingresar la dirección',
        ],
        'municipio' => [
            'required' => 'Debe elejir un municipio',
        ],
        'departamento' => [
            'required' => 'Debe elejir un departamento',
        ],
        'numeroCelular' => [
            'required' => 'Debe escribir un número celular',
            'numeric' => 'Debe escribir un número de celular valido',
            'max' => 'Numero celular no debe exceder de 8 digitos',
            'min' => 'Numero celular no debe ser menor a 8 digitos',
            'digits' => 'Número de celular no debe ser menor o mayor a 8 digitos',
        ],
        'numeroCasa' => [
            'required' => 'Debe escribir un número casa',
            'numeric' => 'Debe escribir un número de casa valido',
            'max' => 'Numero de casa no debe exceder de 8 digitos',//['numeric'=>'Numero de casa no debe exceder de 8 digitos'],
            'min' => 'Numero de casa no debe ser menor a 8 digitos',
            'digits' => 'Número de casa no debe ser menor o mayor a 8 digitos',
        ],
        'nacimiento' => [
            'required' => 'Debe seleccionar una fecha de nacimiento',
            'date' => 'Debe escribir una fecha de nacimiento valida',
        ],
        'nit' => [
            'required' => 'Debe escribir un número de NIT',
            'unique' => 'El número de nit ingresado, ya se encuentra registrado',
            'integer' => 'El NIT debe ser númerico',
            'max' => 'Numero de NIT no debe exceder de 14 digitos',
            'min' => 'Número de NIT   no debe ser menor a 14 digitos',
            'digits' => 'Número de NIT no debe ser menor o mayor a 14 digitos',
            
        ],
        'dui' => [
            'required' => 'Debe escribir un número de DUI',
            'unique' => 'El número de DUI ingresado, ya se encuentra registrado',
            'numeric' => 'Debe escribir un número de DUI valido',
            'max' => 'Numero de DUI no debe exceder de 9 digitos',
            'min' => 'Número de DUI  no debe ser menor a 9 digitos',
            'integer' => 'Número de DUI  no debe ser menor a 9 digitos',
            'digits' => 'Número de DUI  no debe ser menor o mayor a 9 digitos',

        ],
        'nombre' => [
            'required' => 'Debe escribir un nombre',
        ],
        'apellido' => [
            'required' => 'Debe escribir un apellido',
        ],
        'passwordActual' => [
            'required' => 'Debe escribir su contraseña actual',
        ],
        'newPassword' => [
            'required' => 'Debe escribir la nueva contraseña',
        ],
        'repitaPassword' => [
            'required' => 'Debe repetir la contraseña',
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