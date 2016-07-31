<?php

namespace App\Http\Requests;

class RequestUsuarioCasaCorredoraUpdate extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|unique:usuarios' . $id,
            'rolUsuario' => 'required|exists:roles,id'

        ];
    }
}
