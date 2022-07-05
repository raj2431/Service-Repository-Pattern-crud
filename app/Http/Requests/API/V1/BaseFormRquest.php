<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponse;

class BaseFormRquest extends FormRequest
{
    use ApiResponse;
    
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException($this->sendResponse($errors, "Unprocessable Entity", config('constants.api_status.validation')));
    }
}
