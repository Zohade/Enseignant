<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteRequest extends FormRequest
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
    $rules = [];

    if ($this->has('complete')) {
        $rules = [
            'ville' => 'required|exists:villes,id',
            'circonscription' => 'required|exists:circonscriptions,id',
        ];

        if (session('user')['grade'] != "cpins") {
            $rules = array_merge($rules, [
                'ecole' => 'required|exists:ecoles,id',
                'groupe' => 'required|exists:groupes,id',
            ]);

            if (session('user')['grade'] == "instituteur") {
                $rules['classe'] = 'required|exists:classes,id';
            }
        }
    }

    return $rules;
}

}