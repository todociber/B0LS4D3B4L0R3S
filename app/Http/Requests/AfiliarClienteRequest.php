<?php

namespace App\Http\Requests;

class AfiliarClienteRequest extends Request
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
            'numeroafiliacion' => 'required|numeric|digits:5|integer|min:0',
        ];
    }
}
