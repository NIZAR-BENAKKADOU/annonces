<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnnonceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "titre" => [
                "required",
                Rule::unique("annonces")->ignore($this->annonce)
            ],
            "description"=>"required|max:100",
            "type" => "in:Appartement,Maison,Villa,Magasin,Terrain",
            "ville"=>"required|alpha",
            "superficie"=>"required|numeric|min:20",
            "prix"=>"required|numeric|gt:0",
            "photo"=>"image|mimes:png,jpg,jpeg|max:8000"
        ];
    }
    public function messages(): array
    {

        return [
            "titre.required"=>'Le titre est obligatoire',
            "titre.unique"=>'Ce titre est déjà pris',

            'description.required'=>'La description est obligatoire',
            'description.max'=>'La description ne peut pas dépasser 100 caractères',

            "type.in" => "Le type peut prendre l'une des valeurs suivantes: Appartement, Maison, Villa, Magasin et Terrain",

            "ville.required" => "La ville est obligatoire",
            "ville.alpha" => "la ville ne peut contenir que des caractères alphabétiques",

            "superficie.required"=>"La superrficie est obligatoire",
            "superficie.numeric"=>"La superficie doit être un nombre",
            "superficie.min" => "La superficie minimale est 20",

            "prix.required"=>"Le prix est obligatoire",
            "prix.numeric"=>"Le prix doit être un nombre",
            "prix.gt"=>"Le prix doit être supérieur à zéro",

            "photo.image"=>"L'image choisie n'est pas une image valide",
            "photo.mimes"=>"L'extension de l'image doit être : png, jpg ou jpeg",
            "photo.max"=>"La taille de l'image ne doit pas dépasser 8 Mo"
        ];
    }
}
