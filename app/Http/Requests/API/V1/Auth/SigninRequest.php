<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Http\Requests\API\V1\BaseFormRquest;

class SigninRequest extends BaseFormRquest
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
            "email" =>  "required",
            "password" =>  "required"
        ];
    }
}
