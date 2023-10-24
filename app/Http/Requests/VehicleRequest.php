<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
 * App\Http\requests\VehicleRequest
 *
 * @property int $id
 * @property string $name
 * @property string|null $brand
 * @property string|null $license_plate
 * @property string|null $type
 * @property int| $learner_id
 */
class VehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'brand' => 'max:50',
            'license_plate' => 'max:10',
            'type' => 'max:20'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom du véhicule est obligatoire.',
            'name.max' => 'Le nom du véhicule ne peut pas dépasser 50 caractères.',
            'brand.required' => 'La marque du véhicule est obligatoire.',
            'brand.max' => 'La marque du véhicule ne peut pas dépasser 50 caractères.',
            'license_plate.max' => 'La plaque d\'immatriculation ne peut pas dépasser 10 caractères.',
            'type.required' => 'Le type de véhicule est obligatoire.',
            'type.max' => 'Le type de véhicule ne peut pas dépasser 20 caractères.'
        ];
    }


}
