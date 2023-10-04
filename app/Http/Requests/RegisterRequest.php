<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|alpha|string|min:3|max:25',
            'last_name' => 'required|alpha|string|min:2|max:25',
            'email' =>  'required|email|max:200|unique:users,email',
            'password' => 'required|min:8|max:15',
            'city' => 'required|max:100',
            'phone_number' => 'required|integer',
            'file_path' => 'required|mimes:pdf|max:8000',
        ];
    }
}
