<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            "mot_de_passe"=>"required|min:8|confirmed"
        ];
    }
    public function messages(): array{
        return [
            "mot_de_passe.required" => "Entrez un nouveau mot de passe",
            "mot_de_passe.min" => "Le mot de passe doit avoir au moins 8 caractères",
            "mot_de_passe.confirmed" => "Confirmez avec le même mot de passe",
        ];
    }
}