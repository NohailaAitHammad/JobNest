<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PropositionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "titre" => ['sometimes', 'string', 'max:255'],
            "description" => ['sometimes', "string", "max:255"],
            "type" => ['sometimes', "in:stage,emploi,alternance"],
            "duree" => ['sometimes', 'string', 'max:255']
        ];
    }
}
