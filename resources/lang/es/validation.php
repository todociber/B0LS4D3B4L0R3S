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
    "email"            => "El correo electrónico ingresado no es un correo válido",
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
    "numeric"          => ":attribute debe ser num�rico.",
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