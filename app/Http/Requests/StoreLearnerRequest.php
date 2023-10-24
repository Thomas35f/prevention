<?php

namespace App\Http\Requests;

use App\Models\Subclient;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StoreLearner",
 *     type="object",
 *     required={"mail", "subclient_id"},
 *
 *     @OA\Property(ref="#/components/schemas/Learner"),
 * )
 */
class StoreLearnerRequest extends ApiRequest
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
            "lastname"=>["string","max:39"],
            "firstname" => ["string","max:39"],
            "email" => ["required", "email:rfc","max:100", "unique:".User::class.",email"],
            "phone" => ["string", "max:10"],
            "address" => ["string", "max:100"],
            "zip_code" => ["string", "max:5"],
            "town" => ["string", "max:39"],
            'subclient_id'=>['string', "exists:".Subclient::class.',id']
        ];
    }
}
