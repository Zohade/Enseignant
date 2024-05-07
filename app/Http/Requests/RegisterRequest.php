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
            "nom"=>"required|alpha_num",
            "prenom"=>"required|alpha_num",
            "mail"=>"required|email|unique:users,email",
            "phone_number"=>"required|regex:/^[4569][0-9]{7}$/",
            "password"=>"required|confirmed|min:8",
            "departement"=>"required|exists:departements,id",
            "ville"=>"required|exists:villes,id",
            "arrondissement"=>"required|exists:arrondissements,id",
            "grade"=> "required",
        ];
    }
    public function messages(): array{
        return [
            "nom.required"=> "Entrez votre nom",
            "prenom.required"=> "Entrez votre prénom",
            "mail.required"=>"Entrez votre adresse mail",
            "mail.email"=> "Votre mail n'est pas valide",
            "mail.unique"=> "Il y a déjà un compte avec cette adresse mail",
            "phone_number.required"=> "Entrez votre numéro de téléphone",
            "phone_number.regex"=>"le numéro de téléphone n'est pas valide",
            "password.required"=>"Entrez un mot de passe",
            "password.confirmed"=>"Confirmez le mot de passe avec le même mot de passe",
            "password.min"=>"Le mot de passe doit avoir au minimum 8 caractères",
            "departement.required"=>"Selectionnez votre département",
            "departement.exists"=>"Choisisez votre departement",
            "ville.required"=>"Selectionnez votre ville",
            "ville.exists"=>"Choisisez votre ville",
            "arrondissement.required"=>"Selectionnez votre arrondissement",
            "arrondissement.exists"=>"Choisisez votre arrondissement",
            "grade.required"=>"Choisissez votre grade",
        ] ;
    }
}