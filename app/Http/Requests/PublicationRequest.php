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
    public function rules():array
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
                'description' => 'required|string',
                'classe' => 'required|in:CI,CP,CE1,CE2,CM1,CM2',
                'matiere' => 'required_if:type,fiche|nullable|string',
                'SA' => 'required_if:type,fiche|string|nullable',
                'paid' => 'boolean',
                'priceDoc' => 'required_if:paid,true|nullable|numeric|min:0',
            ];
        }elseif($this->has('FormationSoumission')){
            return [
                'titreForm'=>'required|string',
                'auteur'=>'required|in:Vous,Ministere,Circonscription',
                'desc'=>'required|string',
                'DateDebut'=>'required|date',
                'DateFin'=>'nullable|date',
                'paid'=>'boolean',
                'priceFor'=>'required_if:paid,true|nullable|numeric|min:0',
            ];
        }

    }
    public function messages()
    {
        if($this->has('PostSoumission')){
            return [
                'texte.required'=>"Le champ de texte est vide",
                'texte.srting'=>"Le champ doit porter des chaînes de caractères",
                'photo.image'=>"Le format  de la photo n'est pas pris en compte",
            ];
        }
        elseif($this->has('DocumentSoumission')){
            return [
                'type.required' => "Sélectionnez un type de document",
                'type.in' => "Votre type n'est pas pris en compte",
                'titre.required' => "Entrez le titre du document",
                'titre.string' => "Seuls les caractères sont pris en compte",
                'document.required' => "Choisissez un fichier",
                'document.file' => "Choisissez un fichier",
                'document.mimes' => "Le format n'est pas pris en charge",
                'description.required' => "Donnez une description",
                'description.string' => "La description doit être une chaîne de caractères",
                'classe.required' => "Donnez la classe",
                'classe.in' => "Sélectionnez une classe existante",
                'matiere.required_if' => "Choisissez une matière",
                'matiere.string' => "Seuls les caractères sont pris en compte pour la matière",
                'SA.string' => "Seuls les caractères sont pris en compte pour les SA",
                'priceDoc.required_if' => "Entrez le prix du document",
                'priceDoc.numeric' => "Le prix doit être un nombre",
                'priceDoc.min' => "Entrez un prix supérieur ou égal à 0",
            ];
        }
        elseif($this->has("FormationSoumission")){
            return [
                'titreForm.required'=>'Donnez un titre à votre formation',
                'titreForm.string'=>'Le titre doit être un texte',
                'auteur.required'=>'Qui est l\'auteur de votre formation',
                'auteur.in'=>'Choisissez un auteur valide',
                'desc.required'=>'Donnez une description à votre formation',
                'DateDebut.required'=>'Donnez la date de début de votre formation',
                'DateDebut.date'=>"Seul le format date est pris en compte",
                'DateFin.date'=>'Seul le format date est pris en compte',
                'priceFor.required_if' => "Entrez le prix de la formation",
                'priceFor.numeric' => "Le prix doit être un nombre",
                'priceFor.min' => "Entrez un prix supérieur ou égal à 0",
            ];
        }
    }
}
