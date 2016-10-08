<?php

namespace App\Http\Requests;

class BuscarClienteRequest extends Request
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
            'dui' => 'required|numeric|integer|digits:9|min:0',
        ];
    }
}
