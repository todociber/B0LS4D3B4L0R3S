<?php

namespace App\Http\Requests;

class BuscadorOrdenRequest extends Request
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
            'fechaInicial' => 'required|date',
            'fechaFinal' => 'required|date',
            'estadoOrden' => 'required|numeric|digits:1|integer|',
        ];
    }
}
