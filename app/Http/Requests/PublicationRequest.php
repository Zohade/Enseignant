<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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
        if ($this->has('PostSoumission')) {
            return [
                'texte' => 'required|string',
                'photo' => 'image',
            ];
        } elseif ($this->has('DocumentSoumission')) {
            return [
                'type' => 'required|in:guide,fiche',
                'titre' => 'required|string',
                'document' => 'required|file|mimes:pdf,doc,docx',
                'description' => 'required_if:type,guide|string',
                'classe' => 'required|in:CI,CP,CE1,CE2,CM1,CM2',
                'matiere' => 'required_if:type,fiche|string',
                'SA' => 'string',
                'paid' => 'boolean',
                'priceDoc' => 'required_if:paid,true|numeric|min:0',
            ];
        }

    }
    public function messages():array
    {
        if($this->has('PostSoumission')){
            return [
                'texte.required'=>"Le champ de texte est vide",
                'texte.srting'=>"Le champ doit porter des chaînes de caractères",
                'photo.image'=>"Le format n'est pas pris en compte",
            ];
        }
        elseif($this->has('DocumentSoumission')){
            return [
                'type.required'=>"Selectionnez un type de document",
                'type.in'=>"Votre type n'est pas pris en compte",
                'titre.required'=>"Entrez le titre du document",
                'titre.string'=>"Seuls les caractères sont pris en compte",
                'document.required'=>"Choisissez un fichier",
                'document.file'=>"Choisissez un fichier",
                'document.mimes'=>"Le format n'est pas pris en charge",
                'description.required_if'=>"Donnez une description",
                'description.string'=>"La description doit être une chaine de caratères",
                'classe.required'=>"Donnez la classe",
                "classe.in"=>"Selectionnez une classe existante",
                'matiere.required_if'=>"Choisissez une matière",
                'matiere.string'=>"Seuls les caratères sont pris en compte",
                'SA.string'=>"Seuls les caratères sont pris en comte pour les SA",
                'priceDoc.required_if'=>"Entrez le prix du document",
                'priceDoc.numeric'=>"Le prix est un nombre",
                'priceDoc.min'=>"Entrez un prix supérieur à 0",
            ];
        }
    }
}