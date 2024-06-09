<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EcoleRequest extends FormRequest
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
            "circonscription"=>'required|exists:circonscriptions,id',
            'nomE'=>'required|string',
            'groupe'=>'required|string|max:1',
        ];
    }
    public function messages()
    {
        return [
            "circonscription.required"=>"Veillez selectionnez une circonsciption",
            "circonscription.exists"=>"La circonscription n'existe pas",
            "nomE.required"=>"Quel est le nom de votre école ?",
            "groupe.required"=>"Quel est le nom de votre groupe ?",
            'groupe.max'=>"Un groupe a une seule lettre exemple : A",
        ];
    }
}