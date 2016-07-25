<?php

namespace App\Http\Requests;

class RequestRechazoAfiliazion extends Request
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
            'motivoDeRechazo' => 'required|max:500|min:10',
        ];
    }
}
