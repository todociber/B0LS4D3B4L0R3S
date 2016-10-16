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
            'nombre' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'apellido' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'dui' => 'required|unique:clientes,dui|size:9|regex:/^([0-9])+$/i',
            'nit' => 'required|unique:clientes,nit|size:14|regex:/^([0-9])+$/i',
            'nacimiento' => 'required|date',
            'numeroCasa' => 'required|numeric|digits:8|min:0|integer',
            'numeroCelular' => 'required|numeric|digits:8|min:0|integer',
            'departamento' => 'required|exists:departamentos,id',
            'municipio' => 'required|exists:municipios,id',
            'direccion' => 'required',
            'cedeval.*.cuenta' => 'required|unique:cedevals,cuenta|size:10|regex:/^([0-9])+$/i',
            'numeroafiliacion' => 'required|size:5|regex:/^([0-9])+$/i',
            'email' => 'required|email|unique:usuarios,email',
        ];
    }
}
