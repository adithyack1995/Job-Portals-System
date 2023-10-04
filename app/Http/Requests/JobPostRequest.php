<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class JobPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:100',
            'description' => 'required|max:300',
            'company_name' => 'required|max:100',
            'location' => 'required|max:100',
            'salary' => 'required|integer|digits_between:1,5|gt:0',
            'closing_date' => 'sometimes|required|date|after:today',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseHelper::errorWithMessageAndStatus($validator->errors()->all(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
