<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            //
            "Son_mail"=>'required',
            "Son_pass"=>'required',
        ];
    }
    public function messages(): array{
        return [
            'Son_mail.required' => 'L\'adresse mail est obligatoire',
            'Son_mail.email' => 'L\'adresse mail est incorrect',
            'Son_pass.required' => 'Le mot de passe est requis',
        ];
    }
}