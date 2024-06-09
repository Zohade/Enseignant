<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupeRequest extends FormRequest
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
            "ecole"=>'required|exists:ecoles,id',
            "groupe"=>"required|string|max:1",
        ];
    }
    public function messages()
    {
        return [
            "ecole.exists"=>"l'école choisie n'existe pas encore",
            'groupe.required'=>'Quesl est votre groupe',
            'groupe.max'=>"Un groupe doit avoir un seul caractère. Ex :A",
        ];
    }
}