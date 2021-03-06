<?php

namespace App\Http\Requests;

class RequestOrdenAutorizador extends Request
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
            'AgenteCorredor' => 'required|exists:usuarios,id',
            'Comision' => 'required|min:0.01|max:100|numeric'
        ];
    }
}
