<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CirconscriptionRequest extends FormRequest
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
            'ville'=>'required|exists:villes,id',
            'nomC'=>'required|string',
            'role'=>'required|in:collaborateur,chef',
            'nomChef' => 'required_if:role,collaborateur|string|max:255|nullable',
            'numChef' => ['required_if:role,collaborateur', 'regex:/^[4569][0-9]{7}$/','nullable'],
        ];
    }
    public function messages():array{
        return [
            'ville.required'=>'Sélectionnez une ville',
            'ville.exists'=>"La ville n'existe pas ",
            'nomC.required'=>'Quel est le nom de la circonscription ?',
            'nomC.string'=>'Entrez le nom de la circonscription',
            'role.required'=>'Quel est votre poste ?',
            'role.in'=>"quel est votre poste ?",
            'nomChef.required_if'=>"Quel est le nom du chef ?",
            'numChef.required_if'=>'Quel est le numéro de téléphone du chef ?',
            'numChef.regex'=>"Le format du numéro n'est pas pris en compte",
        ];
    }
}