<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class TrainingRequest extends ApiRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'center_id'     => 'required|exists:centers,id',
            'training_name' => 'required|string|max:255',
            'training_date' => 'required',
        ];
    }

}
