<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FilterCandidatsRequest extends FormRequest
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
            "ville" => ["sometimes", "string", "max:255"],

            "status" => ["sometimes", "in:active,banni"],

            "competences" => ["sometimes", "array"],
            "competences.*" => ["exists:competences,id"],

            "niveau" => ["sometimes", "string", "max:255"],
        ];
    }
}
