<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
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
            "groupe"=>'required|exists:groupes,id',
            "classe"=>"required|string|in:CI,CP,CE1,CE2,CM1,CM2",
        ];
    }
    public function messages()
    {
        return [
            "groupe.exists"=>"le groupe choisi n'existe pas encore",
            'classe.required'=>'Quelle est votre classe',
            'classe.in'=>"Selcetionnez un groupe",
        ];
    }
}