<?php

namespace App\Http\Requests;

class RequestUsuarioCasaCorredora extends Request
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
            'nombre'=>'required',
            'apellido'=>'required',
            'correo'=>'required|unique:usuarios',
            'rolUsuario' => 'required|exists:roles,id'

        ];
    }
}
