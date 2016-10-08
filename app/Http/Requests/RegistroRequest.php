<?php

namespace App\Http\Requests;

class RegistroRequest extends Request
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
            'nombre' => 'required',
            'apellido' => 'required',
            'dui' => 'required|unique:clientes,dui|numeric|integer|digits:9|min:0',
            'nit' => 'required|unique:clientes,nit|numeric|digits:14|min:0',
            'nacimiento' => 'required|date',
            'numeroCasa' => 'required|numeric|digits:8|min:0|integer',
            'numeroCelular' => 'required|numeric|digits:8|min:0|integer',
            'departamento' => 'required',
            'municipio' => 'required',
            'direccion' => 'required',
            'cedeval.*.cuenta' => 'required|unique:cedevals,cuenta|digits:10|min:0',
            'numeroafiliacion' => 'required|numeric|digits:5|integer|min:0',
            'email' => 'required|email|unique:usuarios,email',
        ];
    }
}
